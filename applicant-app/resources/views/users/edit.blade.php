@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
    <span>/</span>
    <a href="{{ route('users.index') }}">User Management</a>
    <span>/</span>
    <strong>Edit Account</strong>
</div>

<h2 class="page-title">Edit User Account</h2>

<div class="form-wrapper">

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" required>
                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
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
            <a href="{{ route('users.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-create">Update Account</button>
        </div>
    </form>

</div>

@endsection
