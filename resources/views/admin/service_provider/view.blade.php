@extends('admin.layouts.admin')

@section('content')
    <div class="user-create-wrapper">
        <h2>View Service Provider</h2>

        <div class="form-group">
            <label>Provider Name</label>
            <p class="form-value">{{ $provider->name }}</p>
        </div>

        <div class="form-group">
            <label>Service</label>
            <p class="form-value">{{ $provider->service }}</p>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <p class="form-value">{{ $provider->phone }}</p>
        </div>

        <div class="form-group">
            <label>Email</label>
            <p class="form-value">{{ $provider->email }}</p>
        </div>

        <p class="form-value">
            @if($provider->status)
                <span style="color: green; font-weight: bold;">Active</span>
            @else
                <span style="color: red; font-weight: bold;">Inactive</span>
            @endif
        </p>
    </div>

        <br>
        <a href="{{ route('admin.service_provider.index') }}" class="btn-back">Back to List</a>
    </div>
@endsection
