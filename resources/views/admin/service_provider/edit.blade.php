@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Edit Service Provider</h2>

        <form action="{{ route('admin.service_provider.update', $provider->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Provider Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $provider->name) }}" placeholder="Enter provider name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $provider->email) }}" placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $provider->phone) }}" placeholder="Enter phone number" required>
            </div>

            <div class="form-group">
                <label for="service">Service Type</label>
                <input type="text" name="service" id="service" value="{{ old('service', $provider->service) }}" placeholder="Enter service type" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label><br>
                <label class="switch">
                    <input type="checkbox" name="status" value="1" {{ $provider->status ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <button type="submit" class="btn-submit">Update Provider</button>
            <a href="{{ route('admin.service_provider.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
