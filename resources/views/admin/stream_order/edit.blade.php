@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>Edit Coupon</h2>
        <form action="#" method="POST">
            <!-- Static example; replace action with route when dynamic -->

            <div class="form-group">
                <label for="code">Coupon Code</label>
                <input type="text" name="code" id="code" value="NEWUSER50" placeholder="Enter coupon code" required>
            </div>

            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" name="discount" id="discount" value="50" placeholder="Enter discount" min="1" max="100" required>
            </div>

            <div class="form-group">
                <label for="usage_limit">Usage Limit</label>
                <input type="number" name="usage_limit" id="usage_limit" value="100" placeholder="Enter usage limit" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" value="2025-12-31" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active" selected>Active</option>
                    <option value="expired">Expired</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Update Coupon</button>
            <a href="{{ route('admin.stream_order.index') }}" class="btn-back">Back</a>
        </form>
    </div>
@endsection
