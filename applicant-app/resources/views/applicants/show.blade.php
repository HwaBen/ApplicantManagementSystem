@extends('layouts.app')

@section('content')

<h1 class="page-title">Applicant Details</h1>

<div class="search-card">

    <p><strong>ID:</strong> {{ $applicant['id'] }}</p>
    <p><strong>Name:</strong> {{ $applicant['name'] }}</p>
    <p><strong>IC:</strong> {{ $applicant['ic_num'] }}</p>
    <p><strong>Email:</strong> {{ $applicant['email'] }}</p>
    <p><strong>Phone:</strong> {{ $applicant['mobile'] }}</p>
    <p><strong>Age:</strong> {{ $applicant['age'] }}</p>
    <p><strong>Gender:</strong> {{ $applicant->gender->gender }}</p>
    <p><strong>Race:</strong> {{ $applicant->race->race }}</p>
    <p><strong>Bumiputera:</strong> {{ $applicant->bumi->bumi }}</p>
    <p><strong>Malaysian Nationality:</strong> {{ $applicant->nationality->nationality }}</p>
    <p><strong>Address:</strong> {{ $applicant['address'] }}</p>
    <p><strong>Pos:</strong> {{ $applicant['pos'] }}</p>
    <p><strong>City:</strong> {{ $applicant['city'] }}</p>
    <p><strong>State:</strong> {{ $applicant->state->state }}</p>
    <p><strong>Qualification:</strong> {{ $applicant->qualification->qualification }}</p>
    <p><strong>Institution Type:</strong> {{ $applicant->institution->institution }}</p>
    <p><strong>Institution Name:</strong> {{ $applicant['institute_name'] }}</p>
    <p><strong>Field:</strong> {{ $applicant['field'] }}</p>
    <p><strong>Graduation Year:</strong> {{ $applicant['grad_year'] }}</p>
    <p><strong>Computer Availability:</strong> {{ $applicant->computer_availability == 0 ? 'Yes' : 'No' }}</p>
    <p><strong>Employment Status:</strong> {{ $applicant->employ_status->employ_status }}</p>
    @if($applicant->unemploy_duration?->unemploy_duration)
     <p><strong>Unemployment Duration:</strong> {{ $applicant->unemploy_duration->unemploy_duration }}</p>
    @endif
    <p><strong>Number of Household Members:</strong> {{ $applicant['household_num'] }}</p>
    <p><strong>Recepient of Bantuan:</strong> {{ $applicant->recepient_bantuan_id== 0 ? 'Yes' : 'No' }}</p>
    <p><strong>Income Range:</strong> {{ $applicant->income->income }}</p>
    <p>
        <strong>Course Options:</strong><br>
        1. {{ $applicant->optionOne->option ?? 'N/A' }}<br>
        2. {{ $applicant->optionTwo->option ?? 'N/A' }}<br>
        3. {{ $applicant->optionThree->option ?? 'N/A' }}
    </p>
    <p><strong>Participation in other programmes:</strong> {{ $applicant->other_programme== 0 ? 'Yes' : 'No' }} 
    @if( $applicant->other_programme== 0 )
       - {{ $applicant['other_programme_name'] }}
    @endif
    </p>
    <p><strong>Source of Exposure:</strong> {{ $applicant['exposure_id'] }}</p>

    <a href="{{ route('applicants.search') }}" class="btn-primary">
        Back
    </a>

    <form action="{{ route('applicants.destroy', $applicant->id) }}" method="POST" 
    class = "delete-form"
    onclick="return confirm('Are you sure you want to delete this applicant?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-show-delete">Delete Applicant Data</button>
  </form>

</div>

@endsection
