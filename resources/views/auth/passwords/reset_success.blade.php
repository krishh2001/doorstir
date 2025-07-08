

@section('title', 'Password Reset Success')

@section('content')
<div class="container mt-5 text-center">
    <h2>Password Reset Successfully</h2>

    @if(session('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif

    <a href="{{ route('login') }}" class="btn btn-primary mt-4">Go to Login</a>
</div>
@endsection
