@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Edit User</h2>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label><br>
                <label class="switch">
                    <input type="checkbox" name="status" value="1" {{ $user->status ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>

            <button type="submit" class="btn-submit">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
