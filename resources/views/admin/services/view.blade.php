@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Service</h2>

        <div class="form-group">
            <label>Service Name</label>
            <p class="form-value">{{ $service->name }}</p>
        </div>

        <div class="form-group">
            <label>Category</label>
            <p class="form-value">{{ $service->category->name ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
            <label>Price ($)</label>
            <p class="form-value">${{ number_format($service->price, 2) }}</p>
        </div>

        <br>
        <a href="{{ route('admin.services.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
