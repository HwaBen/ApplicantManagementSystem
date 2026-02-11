@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{ auth()->user()->dashboardRoute() }}">Dashboard</a>
    <span>/</span>
    <strong>Participant Search</strong>
</div>

<h1 class="page-title">Participant Search</h1>

<div class="search-wrapper">

    <form method="GET" action="{{ route('participants.search') }}" class = "search-form">

    {{-- MAIN SEARCH BAR --}}
    <div class="search-top">
        <input type="text" name="keyword" class="search-input" 
            placeholder="Search Keyword...">
               
        <button type="button" class="more-filter-btn" onclick="toggleFilters()">
            More Options ▾
        </button>

        {{-- This is the submit button (type="submit") — will send all form fields as query params --}}
        <button type="submit" class="search-btn btn-secondary">Search</button>

        {{-- Optional Reset (clear filters and reload page) --}}
        <a href="{{ route('participants.search') }}" class="btn-danger" style="text-decoration:none; display:inline-block; padding:8px 12px; border-radius:6px; margin-left:4px;">
            Reset</a>
    </div>        

    {{--Search Panel--}}
    <div id="filter-panel" class="filter-panel" style="display:none; margin-top:12px;">

        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('company-drop')">
                Apprenticeship Company<span>▾</span>
            </div>
            <div id="company-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                    <label><input type="checkbox" name="company[]" value="all"> All</label>
                    @foreach($companies as $company)
                        <label>
                            <input type="checkbox" name="company[]" value="{{ $company->id }}">
                            {{ ucwords($company->company) }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>


    </div>    
</div>

{{-- RESULTS TABLE --}}

@if(isset($participants))


<div class="downloads">
    <div class="download-left">
        <span class="download-label">Download file:</span>

        <img src="{{ asset('images/pdf-icon.png') }}" class="icon-pdf">
        <img src="{{ asset('images/csv-icon.png') }}" class="icon-csv">
    </div>

    <div class="download-right">
        Total Results: {{ $participants->total() }}
    </div>
</div>


<div class="table-wrapper">
    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Full Name</th>
            <th>IC</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Field</th>
            <th>Additional Info</th>
        </tr>
    </thead>

   <tbody>
        @foreach($participants as $participant)
            <tr>
                <td class="table-center">{{ $participant['id']}}</td>
                <td>{{ $participant['name'] }}</td>
                <td>{{ $participant['ic_num'] }}</td>
                <td>{{ $participant['email'] }}</td>
                <td>{{ $participant['mobile'] }}</td>
                <td class="table-center">{{ $participant['age'] }}</td>
                <td class="table-center">{{ $participant->gender->gender }}</td>
                <td>{{ $participant['field'] }}</td>
                <td class="table-center action-buttons">
                    {{-- View --}}
                    <a href="{{ route('participants.show', $participant['id']) }}" class="btn-icon btn-view">
                        <i class="fa fa-info"></i>
                    </a>

                    {{-- Edit --}}
                    <button type="button" class="btn-icon btn-edit">
                        <i class="fa fa-pencil"></i>
                    </button>

                    {{-- Delete --}}
                    <button class="btn-icon btn-delete"
                        data-id="{{ $participant->id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

{{-- Pagination --}}

{{ $participants->links() }}


@endif

<script>
function toggleDropdown(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.display = (el.style.display === 'block') ? 'none' : 'block';
}

function toggleFilters() {
    const panel = document.getElementById('filter-panel');
    panel.style.display = (panel.style.display === 'block') ? 'none' : 'block';
}

// "All" checkbox logic for State
document.addEventListener('change', function(e){
    if (e.target.matches('#state-drop input[value="all"]')) {
        const checked = e.target.checked;
        document.querySelectorAll('#state-drop input[type="checkbox"]').forEach(cb => {
            cb.checked = checked;
        });
    }
});

// "All" checkbox logic for Academic Qualification
document.addEventListener('change', function(e){
    if (e.target.matches('#academic-drop input[value="all"]')) {
        const checked = e.target.checked;
        document.querySelectorAll('#academic-drop input[type="checkbox"]').forEach(cb => {
            cb.checked = checked;
        });
    }
});

document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        if (!confirm('Delete this participant?')) return;

        fetch(`/participants/${this.dataset.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(res => {
            if (res.ok) location.reload();
        });
    });
});

</script>


@endsection
