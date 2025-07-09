@extends('admin.layouts.admin')

@section('title', 'Category Management')

@section('content')
<style>
    .smj-category-page {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .smj-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .smj-page-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .smj-category-form {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .smj-form-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        font-size: 0.9375rem;
        transition: all 0.2s ease;
    }

    .smj-form-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .smj-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-weight: 500;
        font-size: 0.9375rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .smj-btn-primary {
        background-color: #4f46e5;
        color: white;
    }

    .smj-btn-primary:hover {
        background-color: #4338ca;
        transform: translateY(-1px);
    }

    .smj-card {
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .smj-category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .smj-category-item {
        display: flex;
        align-items: center;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #edf2f7;
        transition: background-color 0.2s ease;
    }

    .smj-category-item:hover {
        background-color: #f8fafc;
    }

    .smj-category-name {
        flex: 1;
        font-size: 1rem;
        color: #2d3748;
        margin: 0;
    }

    .smj-action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .smj-btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }

    .smj-btn-edit {
        background-color: #3b82f6;
        color: white;
    }

    .smj-btn-edit:hover {
        background-color: #2563eb;
    }

    .smj-btn-delete {
        background-color: #ef4444;
        color: white;
    }

    .smj-btn-delete:hover {
        background-color: #dc2626;
    }

    /* Modal Styles */
  /* Fade animation for modals */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply the modern modal look to existing modal structure */
.smj-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center; 
}

/* Show modal using 'active' class */
.smj-modal-overlay.active {
    display: flex;
}

/* Modal box styling */
.smj-modal {
    background: #fff;
    padding: 30px;
    width: 90%;
    max-width: 450px;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.4s ease;
    text-align: center;
}

/* Close button (X) */
.smj-modal-close {
    position: absolute;
    top: 10px;
    right: 15px;
    background: transparent;
    border: none;
    font-size: 22px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
}

/* Modal title/header */
.smj-modal-title {
    font-size: 20px;
    font-weight: 600;
    color: #a00000;
    margin-bottom: 12px;
}

/* Modal content text */
.smj-modal-body p {
    font-size: 15px;
    color: #333;
}

/* Modal action buttons */
.smj-modal-footer {
    margin-top: 24px;
    display: flex;
    justify-content: center;
    gap: 15px;
}

/* Buttons inside modal */
.smj-btn-secondary,
.smj-btn-delete {
    padding: 10px 20px;
    font-weight: bold;
    border-radius: 6px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}

.smj-btn-secondary {
    background-color: #ccc;
    color: #333;
}

.smj-btn-secondary:hover {
    background-color: #999;
}

.smj-btn-delete {
    background: linear-gradient(135deg, #c82333, #85000d);
    color: white;
}

.smj-btn-delete:hover {
    background-color: #b30000;
}

/* Edit Modal improvements */
#editModal .smj-modal {
    background: #fff;
    padding: 30px;
    max-width: 500px;
    width: 90%;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.4s ease;
    position: relative;
    text-align: left;
}

/* Modal header */
#editModal .smj-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
}

#editModal .smj-modal-title {
    font-size: 20px;
    font-weight: 600;
    color: #1f2937;
}

/* Close button */
#editModal .smj-modal-close {
    font-size: 22px;
    background: transparent;
    border: none;
    color: #555;
    cursor: pointer;
}

/* Body */
#editModal .smj-modal-body {
    padding: 20px 0;
    margin-bottom:-20px;
}

#editModal .smj-form-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 15px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

/* Footer */
#editModal .smj-modal-footer {
    display: flex;
    justify-content: flex-end;
  
}

/* Buttons */
#editModal .smj-btn-primary {
    background: linear-gradient(135deg, #2563eb, #1e3a8a);
    color: white;
    border: none;
}

#editModal .smj-btn-primary:hover {
    background-color: #1e40af;
}

#editModal .smj-btn-secondary {
    background-color: #e5e7eb;
    color: #374151;
}

#editModal .smj-btn-secondary:hover {
    background-color: #d1d5db;
}


</style>

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