@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
    <span>/</span>
    <strong>User Management</strong>
</div>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0px;">
    
<h2 class="page-title">User Management</h2>

</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="tabs mb-4">
    <a href="{{ route('users.index', ['tab' => 'users']) }}"
       class="tab-btn {{ request('tab', 'users') === 'users' ? 'active' : '' }}">
        Users
    </a>

    <a href="{{ route('users.index', ['tab' => 'logs']) }}"
       class="tab-btn {{ request('tab') === 'logs' ? 'active' : '' }}">
        Log History
    </a>
</div>


{{-- === USERS TAB === --}}
<div id="users-tab"
     class="tab-content {{ request('tab', 'users') === 'users' ? 'active' : 'hidden' }}">


    <a href="{{ route('users.create') }}"
       class="btn-create btn-right"
       title="Add New Account">
        <i class="fa fa-user-plus"></i>
        <span style="margin-left:6px;">Add Account</span>
    </a>


    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Account Last Login</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse($users as $index => $user)
                <tr>
                    {{-- No --}}
                    <td class="table-center">
                        {{ $users->firstItem() + $index }}
                    </td>

                    {{-- Name --}}
                    <td class="table-name">
                        {{ $user->name }}
                    </td>

                    {{-- Email --}}
                    <td class="table-name">
                        {{ $user->email }}
                    </td>

                    {{-- Role --}}
                    <td class="table-center">
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </td>

                    {{-- Created At --}}
                    <td class="table-center">
                        {{ $user->created_at->format('d-m-Y') }}
                    </td>

                    {{-- Account Last Login --}}
                    <td class="table-center">
                        {{ $user->last_login
                            ? $user->last_login->timezone(config('app.timezone'))->format('d-m-Y H:i:s')
                            : 'Never'
                        }}
                    </td>

                    {{-- Status --}}
                    <td class="table-center">
                        @if($user->status === 'active')
                            <span class="status-active">Active</span>
                        @else
                            <span class="status-inactive">Inactive</span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="table-center">
                        <div class="action-group">

                            @if(
                                $user->role !== 'super_admin'
                                || auth()->id() === $user->id
                            )
                                <a href="{{ route('users.edit', $user->id) }}"
                                class="btn-icon btn-edit"
                                title="Edit Account">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            @endif

                            {{-- Delete --}}
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('users.destroy', $user->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this account?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete"
                                            title="Delete Account">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="table-center">
                        No user accounts found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->appends(request()->except('users_page'))->links() }}
</div>

{{-- === LOG HISTORY TAB === --}}
<div id="logs-tab"
     class="tab-content {{ request('tab') === 'logs' ? 'active' : 'hidden' }}">

    <div class="search-wrapper">

        <form method="GET" action="{{ route('users.index') }}">
            <input type="hidden" name="tab" value="logs">

            {{-- MAIN SEARCH BAR --}}
            <div class="search-top">
                <input type="text"
                    name="log_keyword"
                    class="search-input"
                    value="{{ request('log_keyword') }}"
                    placeholder="Search name, email, action...">

                <button type="button"
                        class="more-filter-btn"
                        onclick="toggleFilters()">
                    More Options ▾
                </button>

                <button type="submit" class="search-btn btn-secondary">
                    Search
                </button>

                <a href="{{ route('users.index', ['tab' => 'logs']) }}"
                    class="btn-danger"
                    style="text-decoration:none; padding:8px 12px; border-radius:6px;">
                    Reset
                </a>
            </div>

            {{-- FILTER PANEL --}}
            <div id="filter-panel"
                class="filter-panel"
                style="display:none; margin-top:12px;">

                {{-- ACTION FILTER --}}
                <div class="filter-group">
                    <div class="filter-title" onclick="toggleDropdown('action-drop')">
                        Action <span>▾</span>
                    </div>

                    <div id="action-drop" class="filter-dropdown multi-select">
                        <div class="multi-list">
                            <label><input type="checkbox" name="action[]" value="created"> Created</label>
                            <label><input type="checkbox" name="action[]" value="updated"> Updated</label>
                            <label><input type="checkbox" name="action[]" value="deleted"> Deleted</label>
                        </div>
                    </div>
                </div>

                {{-- PERFORMED BY FILTER --}}
                <div class="filter-group">
                    <div class="filter-title" onclick="toggleDropdown('performed-drop')">
                        Performed By <span>▾</span>
                    </div>

                    <div id="performed-drop" class="filter-dropdown">
                        <select name="performed_by" class="filter-select">
                            <option value="">All</option>
                            @foreach($performedUsers as $user)
                                <option value="{{ $user->id }}"
                                    {{ request('performed_by') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- DATE RANGE --}}
                <div class="filter-group">
                    <div class="filter-title" onclick="toggleDropdown('date-drop')">
                        Date Range <span>▾</span>
                    </div>

                    <div id="date-drop" class="filter-dropdown">
                        <label>From</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}">

                        <label>To</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}">
                    </div>
                </div>

            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Action</th>
                <th>Performed By</th>
                <th>Affected User</th>
                <th>Details</th>
            </tr>
        </thead>

        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('d M Y H:i') }}</td>

                    <td>
                        <span class="badge badge-{{ $log->action }}">
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>

                    <td>
                        @php
                            $performedByName = $log->details['performed_by_name'] ?? null;
                        @endphp

                        @if ($performedByName)
                            {{ $performedByName }}
                            @if (!$log->performedBy)
                                <span class="text-muted">(Deleted User)</span>
                            @endif

                        @elseif ($log->performedBy)
                            {{ $log->performedBy->name }}

                        @else
                            <em class="text-muted">Unknown User</em>
                        @endif
                    </td>

                    <td>
                        @if($log->user && $log->user->name)
                            {{ $log->user->name }}

                        @elseif(!empty($log->details['name']))
                            {{ $log->details['name'] }}

                        @elseif(!empty($log->details['email']))
                            {{ $log->details['email'] }}

                        @else
                            <em class="text-muted">Deleted User</em>
                        @endif
                    </td>

                    <td class="log-details-cell">

                        {{-- CREATED --}}
                        @if($log->action === 'created')
                            <strong>Created User</strong>
                            <ul class="log-detail-list">
                                <li><strong>Name:</strong> {{ $log->details['name'] ?? '-' }}</li>
                                <li><strong>Email:</strong> {{ $log->details['email'] ?? '-' }}</li>
                                <li><strong>Role:</strong> {{ ucfirst($log->details['role'] ?? '-') }}</li>
                                <li><strong>Status:</strong> {{ ucfirst($log->details['status'] ?? '-') }}</li>
                            </ul>

                        {{-- UPDATED --}}
                        @elseif($log->action === 'updated')
                            <strong>Updated User</strong>

                            @php
                                $changes = false;
                            @endphp

                            <ul class="log-change-list">

                                {{-- FIELD CHANGES --}}
                                @foreach(($log->details['before'] ?? []) as $key => $oldValue)
                                    @php
                                        $newValue = $log->details['after'][$key] ?? null;
                                    @endphp

                                    @if($newValue !== null && $newValue !== $oldValue)
                                        @php $changes = true; @endphp
                                        <li>
                                            <strong>{{ ucfirst($key) }}:</strong>
                                            <span class="log-old">{{ $oldValue ?? '-' }}</span>
                                            →
                                            <span class="log-new">{{ $newValue ?? '-' }}</span>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- PASSWORD CHANGE --}}
                                @if(!empty($log->details['password_changed']))
                                    @php $changes = true; @endphp
                                    <li>
                                        <strong>Password:</strong>
                                        <span class="log-new">Changed</span>
                                    </li>

                                {{-- PASSWORD CHANGE (OLD FORMAT) --}}
                                @elseif(!empty($log->details['message']) && str_contains(strtolower($log->details['message']), 'password'))
                                    @php $changes = true; @endphp
                                    <li>
                                        <strong>Password:</strong>
                                        <span class="log-new">Changed</span>
                                    </li>
                                @endif

                            </ul>

                            @if(!$changes)
                                <em class="text-muted">No visible changes</em>
                            @endif


                        {{-- DELETED --}}
                        @elseif($log->action === 'deleted')
                            <strong>Deleted User</strong>
                            <ul class="log-detail-list">
                                <li><strong>Name:</strong> {{ $log->details['name'] ?? '-' }}</li>
                                <li><strong>Email:</strong> {{ $log->details['email'] ?? '-' }}</li>
                                <li><strong>Role:</strong> {{ ucfirst($log->details['role'] ?? '-') }}</li>
                                <li><strong>Status:</strong> {{ ucfirst($log->details['status'] ?? '-') }}</li>
                            </ul>

                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">No log records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $logs->appends(request()->except('logs_page'))->links() }}
</div>

<script>
function toggleFilters() {
    const panel = document.getElementById('filter-panel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}

function toggleDropdown(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
</script>


@endsection
