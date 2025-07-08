@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Edit Service</h2>
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" name="name" id="name" value="{{ $service->name }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $service->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" name="price" id="price" step="0.01" min="0"
                    value="{{ $service->price }}" required>
            </div>

            <button type="submit" class="btn-submit">Update Service</button>
            <a href="{{ route('admin.services.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
