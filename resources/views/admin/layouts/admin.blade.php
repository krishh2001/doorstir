<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>

    <!-- FontAwesome & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/deletemodal.css') }}">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/popup.js') }}"></script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <ul class="nav-links">
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fas fa-user-group"></i> Users
                </a>
            </li>
            <li class="{{ request()->is('admin/service_provider*') ? 'active' : '' }}">
                <a href="{{ route('admin.service_provider.index') }}">
                    <i class="fas fa-briefcase"></i> Service Provider
                </a>
            </li>
            <li class="{{ request()->is('admin/stream_order*') ? 'active' : '' }}">
                <a href="{{ route('admin.stream_order.index') }}">
                    <i class="fas fa-video"></i> Stream Order
                </a>
            </li>
            <li class="{{ request()->is('admin/streamList*') ? 'active' : '' }}">
                <a href="{{ route('admin.streamList') }}">
                    <i class="fas fa-video"></i> Stream
                </a>
            </li>

            <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-layer-group"></i> Categories
                </a>
            </li>
            <li class="{{ request()->is('admin/services*') ? 'active' : '' }}">
                <a href="{{ route('admin.services.index') }}">
                    <i class="fas fa-tools"></i> Services
                </a>
            </li>
            <li class="{{ request()->is('admin/supports*') ? 'active' : '' }}">
                <a href="{{ route('admin.supports.index') }}">
                    <i class="fas fa-headset"></i> Support
                </a>
            </li>
        </ul>

    </div>

    <!-- Navbar -->
    <div class="navbar">
        <!-- ✅ Notification Icon with Dynamic Unread Count -->
        @php
            $unreadCount = \App\Models\Notification::whereNull('read_at')->count();
        @endphp
        <div class="notification-icon" style="position: relative; margin-right: 20px;">
            <a href="{{ route('admin.notifications.index') }}" title="View Notifications"
                style="color: inherit; position: relative;">
                <i class="fas fa-bell fa-lg"></i>
                @if ($unreadCount > 0)
                    <span
                        style="
                        position: absolute;
                        top: -6px;
                        right: -8px;
                        background-color: red;
                        color: white;
                        font-size: 11px;
                        padding: 2px 6px;
                        border-radius: 50%;
                        font-weight: bold;
                        min-width: 20px;
                        text-align: center;
                    ">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>
        </div>

        <!-- Profile Dropdown -->
        <div class="profile-menu" id="profileMenu">
            <div class="profile-icon">
                <i class="fas fa-user-circle"></i> {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="profile-dropdown">
                <form method="POST" action="{{ route('admin.logout') }}" class="dropdown-item logout-form">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @include('admin.include.alert')
        @yield('content')
    </div>

    <!-- JS -->
    <script>
        const profileMenu = document.getElementById('profileMenu');
        profileMenu.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('open');
        });

        document.addEventListener('click', (e) => {
            if (!profileMenu.contains(e.target)) {
                profileMenu.classList.remove('open');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
