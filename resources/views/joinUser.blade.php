@extends('admin.layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Stream</title>
    <link rel="stylesheet" href="{{ asset('agoraVideo/main.css') }}">
</head>
<body>

    {{-- Join & Copy Link Buttons --}}
    <button id="join-btn2">Join Stream</button>
    <button id="join-btns" onclick="copyLink()">Copy link</button>

    {{-- Meeting Stream Area --}}
    <div id="stream-wrapper" style="height: 100%; display: block">
        <div id="video-streams"></div>

        {{-- Stream Controls --}}
        <div id="stream-controls">
            <button id="leave-btn">Leave Stream</button>
            <button id="mic-btn">Mic On</button>
            <button id="camera-btn">Camera On</button>
            <button id="rec-btn">Rec Off</button>
        </div>
    </div>

    {{-- Hidden inputs for Agora setup --}}
    <input id="appid" type="hidden" value="{{ $meeting->app_id }}" readonly>
    <input id="token" type="hidden" value="{{ $meeting->token }}" readonly>
    <input id="channel" type="hidden" value="{{ $meeting->channel }}" readonly>
    <input id="urlid" type="hidden" value="{{ $meeting->urlShort ?? $meeting->url }}" readonly>

    {{-- Additional metadata if needed --}}
    <input id="timer" type="hidden" value="">
    <input id="user_meeting" type="hidden" value="{{ $meeting->id }}">
    <input id="user_permission" type="hidden" value="{{ $user_permission ?? '' }}">

    {{-- JS Scripts --}}
    <script>
        function copyLink() {
            const link = document.getElementById('urlid').value;
            navigator.clipboard.writeText(link).then(() => {
                alert("Link copied: " + link);
            });
        }
    </script>

    {{-- Load Agora script and your meeting JS --}}
    <script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
    <script src="{{ asset('agoraVideo/stream.js') }}"></script>

</body>
</html>
@endsection