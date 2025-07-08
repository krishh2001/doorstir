<!-- resources/views/emails/otp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>OTP</title>
</head>
<body>
    <p>Dear user,</p>
    <p>Your OTP for resetting the password is:</p>
    <h2>{{ $otp }}</h2>
    <p>This code will expire in 10 minutes.</p>
</body>
</html>
