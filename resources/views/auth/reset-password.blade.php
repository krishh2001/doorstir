

@section('title', 'Reset Password')

@section('content')
<div class="container mt-5">
    <h2>Reset Password</h2>

    <form method="POST" action="{{ route('forgot.resetPassword') }}">
        @csrf

        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="otp" value="{{ $otp }}">

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Reset Password</button>
    </form>
</div>
@endsection
