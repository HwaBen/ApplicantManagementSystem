@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
    <span>/</span>
    <a href="{{ route('users.index') }}">User Management</a>
    <span>/</span>
    <strong>Add New Account</strong>
</div>

<h2 class="page-title">Add New Account</h2>

<div class="form-wrapper">

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name"
                value="{{ old('name') }}"
                class="{{ $errors->has('name') ? 'input-error' : '' }}">
            @error('name') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" required>
                <option value="">-- Select Role --</option>
                <option value="super_admin" {{ old('role')=='super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role')=='user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="">-- Select Status --</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                    Active
                </option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
            @error('status')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div class="form-actions">
            <a href="{{ route('users.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-create">Create Account</button>
        </div>
    </form>

</div>

@endsection
