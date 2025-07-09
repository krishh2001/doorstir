@extends('admin.layouts.admin')

@section('title', 'Category Management')

@section('content')

<div class="smj-category-page">
    <div class="smj-page-header">
        <h1 class="smj-page-title">Manage Categories</h1>
    </div>

    <!-- Create Category Form -->
    <form action="{{ route('admin.categories.store') }}" method="POST" class="smj-category-form">
        @csrf
        <input type="text" name="name" placeholder="Enter category name" required class="smj-form-input">
        <button type="submit" class="smj-btn smj-btn-primary">Create Category</button>
    </form>

    <!-- Category List -->
   <div class="user-table-wrapper">
            <table class="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <button class="btn-edit" onclick="openEditModal('{{ $category->id }}', '{{ $category->name }}')">Edit</button>
                        <button class="btn-delete" onclick="openDeleteModal('{{ $category->id }}')">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div class="smj-modal-overlay" id="editModal">
    <div class="smj-modal">
        <div class="smj-modal-header">
            <h3 class="smj-modal-title">Edit Category</h3>
            <button class="smj-modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST" class="smj-modal-body">
            @csrf
            @method('PUT')
            <input type="text" name="name" id="editCategoryName" required class="smj-form-input">
        </form>
        <div class="smj-modal-footer">
            <button type="button" onclick="closeModal('editModal')" class="smj-btn smj-btn-secondary">Cancel</button>
            <button type="submit" form="editForm" class="smj-btn smj-btn-primary">Update Category</button>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="smj-modal-overlay" id="deleteModal">
    <div class="smj-modal">
        <div class="smj-modal-header">
            <h3 class="smj-modal-title">Confirm Deletion</h3>
            <button class="smj-modal-close" onclick="closeModal('deleteModal')">&times;</button>
        </div>
        <div class="smj-modal-body">
            <p>Are you sure you want to delete this category?</p>
        </div>
        <form id="deleteForm" method="POST" class="smj-modal-footer">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeModal('deleteModal')" class="smj-btn smj-btn-secondary">Cancel</button>
            <button type="submit" class="smj-btn smj-btn-delete">Yes, Delete </button>
        </form>
    </div>
</div>


<script>
    function openEditModal(id, name) {
        const form = document.getElementById('editForm');
        document.getElementById('editCategoryName').value = name;
        form.action = "{{ url('admin/categories') }}/" + id;
        document.getElementById('editModal').classList.add('active');
    }

    function openDeleteModal(id) {
        const form = document.getElementById('deleteForm');
        form.action = "{{ url('admin/categories') }}/" + id;
        document.getElementById('deleteModal').classList.add('active');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    // Close modal when clicking outside
    document.querySelectorAll('.smj-modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            // Close only if clicked directly on the overlay, not on modal content
            if (e.target === modal) {
                closeModal(modal.id);
            }
        });
    });
</script>

@endsection