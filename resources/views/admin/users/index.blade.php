@extends('admin.layouts.admin')

@section('content')

    <div class="user-dashboard">
        <div class="search-create-row">
             <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8" stroke-width="2" stroke="#888"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke="#888" />
                </svg>
                <input type="text" placeholder="Search">
            </div>
            <a href="{{ route('admin.users.create') }}" class="user-create-btn">+ Create</a>
        </div>

        <div class="user-table-wrapper">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="status-toggle" data-user-id="{{ $user->id }}"
                                        {{ $user->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.view', $user->id) }}" class="btn-view">View</a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Edit</a>
                                <button type="button" class="btn-delete"
                                    onclick="openUserDeleteModal({{ $user->id }})">Delete</button>
                            </td>
                        </tr>
                     @empty
                        <tr>
                            <td colspan="8" style="text-align: center;">No User found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="user-delete-modal-overlay" id="userDeleteModal">
        <div class="user-delete-modal">
            <button class="user-delete-close" onclick="closeUserDeleteModal()">×</button>
            <div class="user-delete-modal-header">Confirm Deletion</div>
            <p style="text-align: center;">Are you sure you want to delete this user?</p>
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

    <script>
        // Open delete modal
        function openUserDeleteModal(userId) {
            const form = document.getElementById('userDeleteForm');
            form.action = "{{ url('admin/users') }}/" + userId;
            document.getElementById('userDeleteModal').classList.add('show');
        }

        // Close delete modal
        function closeUserDeleteModal() {
            document.getElementById('userDeleteModal').classList.remove('show');
        }

        // Close modal when clicking outside
        document.addEventListener("DOMContentLoaded", function() {
            const modalOverlay = document.getElementById('userDeleteModal');
            modalOverlay.addEventListener('click', function(e) {
                if (e.target === modalOverlay) {
                    closeUserDeleteModal();
                }
            });

            // Handle status toggle
            document.querySelectorAll('.status-toggle').forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const userId = this.dataset.userId;
                    const status = this.checked ? 1 : 0;

                    fetch(`{{ url('admin/users') }}/${userId}/toggle-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                alert("Status update failed.");
                                this.checked = !this.checked; // revert
                            }
                        })
                        .catch(() => {
                            alert("Error updating status.");
                            this.checked = !this.checked; // revert
                        });
                });
            });
        });
    </script>
@endsection
