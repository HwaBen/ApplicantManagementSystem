@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{ auth()->user()->dashboardRoute() }}">Dashboard</a>
    <span>/</span>
    <strong>Participant Search</strong>
</div>

<h1 class="page-title">Applicant Search</h1>

<div class="search-wrapper">

    <form method="GET" action="{{ route('applicants.search') }}" class = "search-form">

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
        <a href="{{ route('applicants.search') }}" class="btn-danger" style="text-decoration:none; display:inline-block; padding:8px 12px; border-radius:6px; margin-left:4px;">
            Reset</a>
    </div>


     <div id="filter-panel" class="filter-panel" style="display:none; margin-top:12px;">

        {{-- Course Choice--}}
        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('option-drop')">
                Course Choice<span>▾</span>
            </div>

            <div id="option-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                <label><input type="checkbox" name="option[]" value="all"> All</label>
                @foreach($options as $option)
                    <label>
                        <input type="checkbox" name="option[]" value="{{ $option->id }}">
                        {{ ucwords($option->option) }}
                    </label>
                @endforeach
                </div>
                
            </div>
        </div>

            {{-- AGE --}}
            <div class="filter-group">
                <div class="filter-title" onclick="toggleDropdown('age-drop')">
                    Age Range <span>▾</span>
                </div>

                 <div id="age-drop" class="filter-dropdown" style="display:none;">
                        <label>Min Age</label>
                        <input type="number" name="age_min" value="{{ request('age_min') }}" min="0">

                        <label>Max Age</label>
                        <input type="number" name="age_max" value="{{ request('age_max') }}" min="0">
                </div>
            </div>

        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('gender-drop')">
                Gender <span>▾</span>
            </div>

            <div id="gender-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                    <label><input type="checkbox" name="gender[]" value="0"> Male</label>
                    <label><input type="checkbox" name="gender[]" value="1"> Female</label>
                </div>
                
            </div>
        </div>


        {{-- RACE --}}
        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('race-drop')">
                Race <span>▾</span>
            </div>

            <div id="race-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                @foreach($races as $race)
                    <label>
                        <input type="checkbox" name="race[]" value="{{ $race->id }}">
                        {{ ucwords($race->race) }}
                    </label>
                @endforeach
                </div>
            </div>
        </div>

        {{-- BUMIPUTERA --}}
        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('bumiputera-drop')">
                Bumiputera <span>▾</span>
            </div>

            <div id="bumiputera-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                    <label><input type="checkbox" name="bumiputera[]" value="0"> Yes</label>
                    <label><input type="checkbox" name="bumiputera[]" value="1"> No</label>
                </div>
                
            </div>
        </div>

         {{-- MALAYSIAN --}}
        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('malaysian-drop')">
                Malaysian National <span>▾</span>
            </div>

            <div id="malaysian-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                    <label><input type="checkbox" name="malaysian[]" value="0"> Yes</label>
                    <label><input type="checkbox" name="malaysian[]" value="1"> No</label>
                </div>
                
            </div>
        </div>

        {{-- STATE --}}
        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('state-drop')">
                State <span>▾</span>
            </div>

            <div id="state-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                <label><input type="checkbox" name="state[]" value="all"> All</label>
                @foreach($states as $state)
                    <label>
                        <input type="checkbox" name="state[]" value="{{ $state->id }}">
                        {{ ucwords($state->state) }}
                    </label>
                @endforeach
                </div>
                
            </div>
        </div>

        {{-- Academic --}}
        <div class="filter-group">
            <div class="filter-title" onclick="toggleDropdown('academic-drop')">
                Academic Qualification <span>▾</span>
            </div>

            <div id="academic-drop" class="filter-dropdown multi-select">

                <div class="multi-list">
                <label><input type="checkbox" name="qualification[]" value="all"> All</label>
                @foreach($qualifications as $qualification)
                    <label>
                        <input type="checkbox" name="qualification[]" value="{{ $qualification->id }}">
                        {{ ucwords($qualification->qualification) }}
                    </label>
                @endforeach
                </div>
                
            </div>
            
        </div>

    </div>
</div>

{{-- RESULTS TABLE --}}

@if(isset($applicants))


<div class="downloads">
    <div class="download-left">
        <span class="download-label">Download file:</span>

        <img src="{{ asset('images/pdf-icon.png') }}" class="icon-pdf">
        <img src="{{ asset('images/csv-icon.png') }}" class="icon-csv">
    </div>

    <div class="download-right">
        Total Results: {{ $applicants->total() }}
    </div>
</div>


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
    @foreach($applicants as $applicant)
    <tr>
        <td class="table-center">{{ $applicant['id']}}</td>
        <td>{{ $applicant['name'] }}</td>
        <td>{{ $applicant['ic_num'] }}</td>
        <td>{{ $applicant['email'] }}</td>
        <td>{{ $applicant['mobile'] }}</td>
        <td class="table-center">{{ $applicant['age'] }}</td>
        <td class="table-center">{{ $applicant->gender->gender }}</td>
        <td>{{ $applicant['field'] }}</td>
        <td class="table-center action-buttons">
            {{-- View --}}
            <a href="{{ route('applicants.show', $applicant['id']) }}" class="btn-icon btn-view">
                 <i class="fa fa-info"></i>
            </a>

            {{-- Edit --}}
            <button type="button" class="btn-icon btn-edit">
                 <i class="fa fa-pencil"></i>
            </button>

            {{-- Delete --}}
            <button class="btn-icon btn-delete"
                data-id="{{ $applicant->id }}">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

{{-- Pagination --}}

{{ $applicants->links() }}


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
        if (!confirm('Delete this applicant?')) return;

        fetch(`/applicants/${this.dataset.id}`, {
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
