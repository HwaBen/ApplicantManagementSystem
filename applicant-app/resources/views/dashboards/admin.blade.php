@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <strong>Dashboard</strong>
</div>

<h1 class="page-title">Admin Dashboard</h1>

<div class="dashboard-cards">
    <div class="dashboard-card">
        <h3>Participants</h3>
        <p>View participant records</p>
        <a href="{{ route('participants.search') }}" class="btn-primary">View</a>
    </div>
</div>

@endsection
