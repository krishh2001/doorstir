

@section('title', 'Forgot Password')

@section('content')
<div class="container mt-5">
    <h2>Forgot Password</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('forgot.sendOtp') }}">
        @csrf

        <div class="mb-3">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Send OTP</button>
    </form>
</div>
@endsection
