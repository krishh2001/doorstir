@extends('admin.layouts.admin')

@section('content')
    <div class="dashboard">
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div class="card-details">
                    <h3>1,245</h3>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="card-details">
                    <h3>342</h3>
                    <p>Orders</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-money-bill"></i></div>
                <div class="card-details">
                    <h3>$12,480</h3>
                    <p>Revenue</p>
                </div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-headset"></i></div>
                <div class="card-details">
                    <h3>57</h3>
                    <p>Support Tickets</p>
                </div>
            </div>
        </div>
    </div>
@endsection
