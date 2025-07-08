@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Ticket</h2>

        <div class="form-group">
            <label>User Name</label>
            <p class="form-value">John Doe</p>
        </div>

        <div class="form-group">
            <label>Email</label>
            <p class="form-value">john@example.com</p>
        </div>

        <div class="form-group">
            <label>Subject</label>
            <p class="form-value">Login Issue</p>
        </div>
        <div class="form-group">
            <label>Message</label>
            <p class="form-value">Unable to reset password and login .</p>
        </div>
        <div class="form-group">
            <label>Date</label>
            <p class="form-value">2025-06-18</p>
        </div>

        <br>
        <a href="{{ route('admin.supports.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
