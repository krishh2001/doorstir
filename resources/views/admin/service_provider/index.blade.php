@extends('admin.layouts.admin')

@section('content')
    <style>
        .user-table td:last-child {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            justify-content: center;
            min-width: 120px;
        }

        .btn-view, .btn-edit, .btn-delete {
            display: inline-block;
            width: 100px;
            height: 35px;
            text-align: center;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>

    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888" />
                </svg>
                <input type="text" placeholder="Search">
            </div>
            <a href="{{ route('admin.service_provider.create') }}" class="user-create-btn">+ Create</a>
        </div>

        <div class="user-table-wrapper">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Provider Name</th>
                        <th>Service</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($providers as $index => $provider)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->service }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" {{ $provider->status ? 'checked' : '' }}
                                        onchange="toggleProviderStatus({{ $provider->id }}, this)">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('admin.service_provider.view', $provider->id) }}" class="btn-view">View</a>
                                <a href="{{ route('admin.service_provider.edit', $provider->id) }}" class="btn-edit">Edit</a>
                                <button type="button" class="btn-delete"
                                    onclick="openProviderDeleteModal({{ $provider->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center;">No service providers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="user-delete-modal-overlay" id="userDeleteModal">
        <div class="user-delete-modal">
            <button class="user-delete-close" onclick="closeProviderDeleteModal()">×</button>
            <div class="user-delete-modal-header">Confirm Deletion</div>
            <p style="text-align: center;">Are you sure you want to delete this provider?</p>
            <form method="POST" id="providerDeleteForm">
                @csrf
                @method('DELETE')
                <div class="user-delete-modal-actions">
                    <button type="button" class="user-delete-cancel-btn" onclick="closeProviderDeleteModal()">Cancel</button>
                    <button type="submit" class="user-delete-confirm-btn">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
       function openProviderDeleteModal(providerId) {
    const form = document.getElementById('providerDeleteForm');
    form.action = `{{ url('admin/service_provider') }}/${providerId}`;
    document.getElementById('userDeleteModal').classList.add('show');
}


        function closeProviderDeleteModal() {
            document.getElementById('userDeleteModal').classList.remove('show');
        }

        function toggleProviderStatus(id, checkbox) {
            fetch(`/doorstir/admin/service_provider/${id}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (!response.ok) throw new Error("Failed to toggle status");
                return response.json();
            })
            .then(data => {
                console.log('Status updated:', data.message);
            })
            .catch(error => {
                alert("Error toggling status.");
                checkbox.checked = !checkbox.checked;
            });
        }

        // Close modal on overlay click
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('userDeleteModal');
            overlay.addEventListener('click', e => {
                if (e.target === overlay) closeProviderDeleteModal();
            });
        });
    </script>
@endsection
