@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Create New Service</h2>
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" name="name" id="name" placeholder="Enter service name" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="number" name="price" id="price" placeholder="Enter price" step="0.01" min="0" required>
        </div>

        <button type="submit" class="btn-submit">Create Service</button>
        <a href="{{ route('admin.services.index') }}" class="btn-back">Back</a>
    </form>
</div>
@endsection
