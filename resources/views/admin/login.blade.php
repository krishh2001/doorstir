<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}"> 
</head>

<body>
    <!-- Loader -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="dot-loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Login Box -->
    <div class="login-wrapper">
        <div class="login-box">
            <div class="logo-container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
</div> 

            <form method="POST" action="{{ route('admin.login.submit') }}" onsubmit="showLoader()">
                @csrf
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email" />

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password" />

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script>
        function showLoader() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }
    </script>
</body>

</html>
