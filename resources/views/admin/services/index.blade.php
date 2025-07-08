@extends('admin.layouts.admin')

@section('content')
    <div class="user-dashboard">
        <div class="search-create-row">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888" />
                </svg>
                <input type="text" placeholder="Search services">
            </div>
            <a href="{{ route('admin.services.create') }}" class="user-create-btn">+ Create</a>
        </div>

        <div class="user-table-wrapper">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Service Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $index => $service)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->category->name ?? 'N/A' }}</td>
                            <td>${{ number_format($service->price, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.services.view', $service->id) }}" class="btn-view">View</a>
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn-edit">Edit</a>
                                <button type="button" class="btn-delete"
                                    onclick="openUserDeleteModal({{ $service->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No services found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="user-delete-modal-overlay" id="userDeleteModal" style="display: none;">
        <div class="user-delete-modal">
            <button class="user-delete-close" onclick="closeUserDeleteModal()">×</button>
            <div class="user-delete-modal-header">Confirm Deletion</div>
            <p style="text-align: center;">Are you sure you want to delete this service?</p>
            <form method="POST" id="userDeleteForm">
                @csrf
                @method('DELETE')
                <div class="user-delete-modal-actions">
                    <button type="button" class="user-delete-cancel-btn" onclick="closeUserDeleteModal()">Cancel</button>
                    <button type="submit" class="user-delete-confirm-btn">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JS for Delete Modal --}}
    <script>
        function openUserDeleteModal(serviceId) {
            const modal = document.getElementById('userDeleteModal');
            const form = document.getElementById('userDeleteForm');
            form.action = `{{ url('admin/services') }}/${serviceId}`;
            modal.style.display = 'flex';
        }

        function closeUserDeleteModal() {
            document.getElementById('userDeleteModal').style.display = 'none';
        }

        // ✅ Close modal when clicking outside of modal content
        document.addEventListener('click', function(event) {
            const modalOverlay = document.getElementById('userDeleteModal');
            const modalContent = document.querySelector('.user-delete-modal');

            if (
                modalOverlay.style.display === 'flex' &&
                modalOverlay.contains(event.target) &&
                !modalContent.contains(event.target)
            ) {
                closeUserDeleteModal();
            }
        });
    </script>
@endsection
