<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="login-body">

<div class="login-panel">
    <img src="{{ asset('images/mtdc-logo.png') }}" class="login-logo">

    <h2 class="login-title">Data Management System</h2>
    <div class="login-separator"></div>
    <p class="login-subtitle">Login</p>

    @if (session('status'))
    <div class="success-box">
        {{ session('status') }}
    </div>
    @endif

    @if ($errors->any())
        <div class="error-box">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="login-btn">Sign In</button>

        <a href="{{ route('password.request') }}" class="reset-link">Forgot Password</a>

    </form>
</div>

</body>
</html>
