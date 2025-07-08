@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Coupon</h2>

        <div class="form-group">
            <label>Coupon Code</label>
            <p class="form-value">NEWUSER50</p>
        </div>

        <div class="form-group">
            <label>Discount</label>
            <p class="form-value">50%</p>
        </div>

        <div class="form-group">
            <label>Usage Limit</label>
            <p class="form-value">100</p>
        </div>

        <div class="form-group">
            <label>Used</label>
            <p class="form-value">45</p>
        </div>

        <div class="form-group">
            <label>Expiry Date</label>
            <p class="form-value">2025-12-31</p>
        </div>

        <div class="form-group">
            <label>Status</label>
            <p class="form-value">Active</p>
        </div>

        <br>
        <a href="{{ route('admin.stream_order.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
