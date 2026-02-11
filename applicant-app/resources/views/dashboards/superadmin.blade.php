@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <strong>Dashboard</strong>
</div>

<h1 class="page-title">Super Admin Dashboard</h1>

<div class="dashboard-cards">

    <div class="dashboard-card">
        <h3>User Management</h3>
        <p>Create and manage user accounts.</p>
        <a href="{{ route('users.index') }}" class="btn-primary">
            Manage User Accounts
        </a>
    </div>

    <div class="dashboard-card">
        <h3>Participants Data</h3>
        <p>View and manage participant records.</p>
        <a href="{{ route('participants.search') }}" class="btn-primary">
            Participant Search
        </a>
    </div>

    <div class="dashboard-card">
        <h3>Applicants Data</h3>
        <p>View and manage applicant records.</p>
        <a href="{{ route('applicants.search') }}" class="btn-primary">
            Applicant Search
        </a>
    </div>

    <div class="dashboard-card">
        <h3>Analytics & Charts</h3>
        <p>View system statistics and visual reports.</p>
        <a href="{{ route('applicants.charts') }}" class="btn-primary">
            View Charts
        </a>
    </div>

</div>

@endsection
