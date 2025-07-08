@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Create New Service Provider</h2>
        <form action="{{ route('admin.service_provider.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Provider Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter phone number" required>
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="service">Service Type</label>
                <input type="text" name="service" id="service" value="{{ old('service') }}" placeholder="Enter service type" required>
                @error('service')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status:</label><br>
                <label class="switch">
                    <input type="checkbox" name="status" value="1" checked>
                    <span class="slider round"></span>
                </label>
            </div>

            <button type="submit" class="btn-submit">Create Provider</button>
            <a href="{{ route('admin.service_provider.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
