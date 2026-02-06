@extends('layouts.app')

@section('content')

<h1 class="page-title">Participant Details</h1>

<div class="search-card">

    <p><strong>Employee ID:</strong> {{ $participant['employee_id'] }}</p>
    <p><strong>Name:</strong> {{ $participant['name'] }}</p>
    <p><strong>Batch:</strong> {{ $participant->batch->batch }}</p> 
    <p><strong>Join Date:</strong> {{ $participant['date_join'] }}</p>
    <p><strong>End Date:</strong> {{ $participant['date_end'] }}</p>
    <p><strong>Apprenticeship Company:</strong> {{ $participant->company->company }}</p>
    <p><strong>Email:</strong> {{ $participant['email'] }}</p>
    <p><strong>Phone:</strong> {{ $participant['mobile'] }}</p>
    <p><strong>IC:</strong> {{ $participant['ic_num'] }}</p>
    <p><strong>Birthdate:</strong> {{ $participant['birth_date'] }}</p>
    <p><strong>Age:</strong> {{ $participant['age'] }}</p>
    <p><strong>Gender:</strong> {{ $participant->gender->gender }}</p>
    <p><strong>Race:</strong> {{ $participant->race->race }}</p>
    <p><strong>Address:</strong> {{ $participant['address'] }}</p>
    <p><strong>Pos:</strong> {{ $participant['pos'] }}</p>
    <p><strong>City:</strong> {{ $participant['city'] }}</p>
    <p><strong>State:</strong> {{ $participant->state->state }}</p>
    <p><strong>Qualification:</strong> {{ $participant->qualification->qualification }}</p>
    <p><strong>Institution Type:</strong> {{ $participant->institution->institution }}</p>
    <p><strong>Institution Name:</strong> {{ $participant['institute_name'] }}</p>
    <p><strong>Field:</strong> {{ $participant['field'] }}</p>
    <p><strong>Graduation Year:</strong> {{ $participant['grad_year'] }}</p>
    

    <a href="{{ route('participants.search') }}" class="btn-primary">
        Back
    </a>


    <button type="submit" class="btn-show-delete">Delete Participant Data</button>
  </form>

</div>

@endsection
