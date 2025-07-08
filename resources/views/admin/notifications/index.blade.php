@extends('admin.layouts.admin')

@section('title', 'Notifications')

@section('content')
<style>
    .smj-notification-page {
        padding: 2rem;
        background-color: #f8f9fa;
        min-height: calc(100vh - 60px);
    }

    .smj-notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .smj-notification-header h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .smj-mark-all {
        background-color: #4f46e5;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .smj-mark-all:hover {
        background-color: #4338ca;
        transform: translateY(-1px);
    }

    .smj-notification-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .smj-notification-card {
        display: flex;
        background-color: #fff;
        padding: 1.25rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
    }

    .smj-notification-card:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .smj-notification-card.unread {
        background-color: #f8fafc;
        border-left-color: #4f46e5;
    }

    .smj-notification-icon {
        font-size: 1.25rem;
        margin-right: 1rem;
        color: #4f46e5;
        display: flex;
        align-items: flex-start;
        padding-top: 0.25rem;
    }

    .smj-notification-content {
        flex: 1;
    }

    .smj-notification-title {
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 0.5rem;
        color: #1a202c;
    }

    .smj-notification-message {
        font-size: 0.875rem;
        margin: 0;
        color: #4a5568;
        line-height: 1.5;
    }

    .smj-notification-time {
        font-size: 0.75rem;
        color: #718096;
        margin-top: 0.75rem;
        display: block;
    }

    .smj-notification-status {
        margin-left: 1rem;
        display: flex;
        align-items: center;
    }

    .smj-status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #fff;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .smj-status-badge.read {
        background-color: #38a169;
    }

    .smj-status-badge.unread {
        background-color: #e53e3e;
    }

    .smj-status-badge.unread:hover {
        background-color: #c53030;
        transform: scale(1.05);
    }

    .smj-no-notifications {
        text-align: center;
        padding: 3rem;
        color: #718096;
        font-size: 1rem;
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .smj-no-notifications i {
        font-size: 2rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
        display: block;
    }
</style>

<div class="smj-notification-page">
    <div class="smj-notification-header">
        <h2>Notifications</h2>
        @if($notifications->whereNull('read_at')->count())
            <a href="{{ route('admin.notifications.markAll') }}" class="smj-mark-all">
                <i class="fas fa-check-circle"></i> Mark All as Read
            </a>
        @endif
    </div>

    <div class="smj-notification-list">
        @forelse($notifications as $notification)
            <div class="smj-notification-card {{ $notification->read_at ? '' : 'unread' }}">
                <div class="smj-notification-icon">
                    @switch($notification->type)
                        @case('user') <i class="fas fa-user-plus"></i> @break
                        @case('order') <i class="fas fa-shopping-bag"></i> @break
                        @case('support') <i class="fas fa-headset"></i> @break
                        @case('payment') <i class="fas fa-credit-card"></i> @break
                        @default <i class="fas fa-bell"></i>
                    @endswitch
                </div>
                <div class="smj-notification-content">
                    <h4 class="smj-notification-title">{{ $notification->title }}</h4>
                    <p class="smj-notification-message">{{ $notification->message }}</p>
                    <span class="smj-notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                </div>
                <div class="smj-notification-status">
                    @if($notification->read_at)
                        <span class="smj-status-badge read">Read</span>
                    @else
                        <a href="{{ route('admin.notifications.markAsRead', $notification->id) }}" class="smj-status-badge unread">Mark as Read</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="smj-no-notifications">
                <i class="far fa-bell-slash"></i>
                <p>No notifications available</p>
            </div>
        @endforelse
    </div>
</div>
@endsection