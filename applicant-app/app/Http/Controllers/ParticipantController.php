<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Qualification;
use App\Models\Race;
use App\Models\Option;
use App\Models\Gender;
use App\Models\State;
use App\Models\Institution;


class ParticipantController extends Controller
{
public function search()
{
    $races = Race::all();   // fetch all races from the database
    $qualifications = Qualification::all();

$applicants = Applicant::query()
    ->when(request('keyword'), function ($q, $keyword) {
        $q->where(function ($q2) use ($keyword) {
            $q2->where('name', 'LIKE', "%{$keyword}%")
               ->orWhere('email', 'LIKE', "%{$keyword}%")
               ->orWhere('mobile', 'LIKE', "%{$keyword}%")
               ->orWhere('field', 'LIKE', "%{$keyword}%");
        });
    })
    ->when(request('age_min'), fn ($q, $min) => $q->where('age', '>=', $min))
    ->when(request('age_max'), fn ($q, $max) => $q->where('age', '<=', $max))
    ->when(request('race'), fn ($q, $races) => $q->whereIn('race_id', $races))
    ->when(request('gender'), fn ($q, $genders) => $q->whereIn('gender_id', $genders))
    ->when(request('bumiputera'), fn ($q, $bumiputera) => $q->whereIn('bumi_id', $bumiputera))
    ->when(request('malaysian'), fn ($q, $nationality) => $q->whereIn('nationality_id', $nationality))    
    ->when(request('state'), fn ($q, $state) => $q->whereIn('state_id', $state))
    ->when(request('qualification'), fn ($q, $qualification) => $q->whereIn('qualification_id', $qualification))

    ->paginate(20)
    ->withQueryString();

    return view('participants.search', [
        'applicants' => $applicants, 'races' => $races, 'qualifications'=>$qualifications
    ]);
    } 

public function show($id){
    $applicant = Applicant::findOrFail($id);
    return view ('participants.show', compact('applicant'));
}

public function create(){
    
    $options = Option::all();
    $genders = Gender::all();
    $races = Race::all();
    $states = State::all();
    $qualifications = Qualification::all();
    $institutes = Institution::all();
   
    return view ('participants.create',compact('options','genders','races','states','qualifications','institutes'));
}

}
