@extends('auth.layout')
@section('content')
<div class="login-panel">

    <img src="{{ asset('images/mtdc-logo.png') }}" class="login-logo">

    <h1 class="login-title">Data Management System</h1>
    <div class="login-separator"></div>
    <h2 class="login-subtitle">Create New Password</h2>

    @if ($errors->any())
        <div class="error-box">
        {{ $errors->first() }}
        </div>
    @endif


    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ $email }}" required>

        <label>New Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button class="login-btn" type="submit">Reset Password</button>
    </form>

    <a href="{{ route('login') }}" class="reset-link">Back to Login</a>
    
</div>
@endsection
