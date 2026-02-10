@extends('auth.layout')
@section('content')
<div class="login-panel">

    <img src="{{ asset('images/mtdc-logo.png') }}" class="login-logo">

    <h1 class="login-title">Data Management System</h1>
    <div class="login-separator"></div>
    <h2 class="login-subtitle">Reset Password</h2>

    @if(session('status'))
        <div class="error-box">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label>Email Address</label>
        <input type="email" name="email" required>
        <button class="login-btn" type="submit">Send Reset Link</button>
    </form>

    <a href="{{ route('login') }}" class="reset-link">Back to Login</a>
</div>
@endsection
