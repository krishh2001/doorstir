{{-- resources/views/admin/users/create.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="user-create-wrapper">
    <h2>Create New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_name">Full Name</label>
            <input type="text" name="name" id="user_name" placeholder="Enter full name" autocomplete="name" required>
        </div>

        <div class="form-group">
            <label for="user_email">Email Address</label>
            <input type="email" name="email" id="user_email" placeholder="Enter email address" autocomplete="email" required>
        </div>

        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" name="password" id="user_password" placeholder="Create a password" autocomplete="new-password" required>
        </div>

        <div class="form-group">
            <label for="user_status">Status:</label><br>
            <label class="switch">
                <input type="checkbox" name="status" id="user_status" value="1" checked>
                <span class="slider round"></span>
            </label>
        </div>

        <button type="submit" class="btn-submit">Create User</button>
        <a href="{{ route('admin.users.index') }}" class="btn-back">Back</a>
    </form>
</div>
@endsection
