@extends('layouts.app')

@section('content')

<h2 class="page-title">Profile Information</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-wrapper">

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label>New Password (optional)</label>
            <input type="password" name="password">
        </div>

        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation">
        </div>

        <div class="form-actions">
            <a href="{{ auth()->user()->dashboardRoute() }}"
               class="btn-cancel">
                Cancel
            </a>

            <button type="submit" class="btn-create">
                Update Profile
            </button>
        </div>
    </form>

</div>

@endsection
