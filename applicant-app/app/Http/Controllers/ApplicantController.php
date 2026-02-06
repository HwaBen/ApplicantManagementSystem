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
use App\Models\EmployStatus;
use App\Models\UnemployDuration;
use App\Models\Income;

class ApplicantController extends Controller
{
public function search()
{
    $options = Option::all();  
    $races = Race::all();   // fetch all races from the database
    $qualifications = Qualification::all();
    $states = State::all();
      

$applicants = Applicant::query()
    ->when(request('keyword'), function ($q, $keyword) {
        $q->where(function ($q2) use ($keyword) {
            $q2->where('name', 'LIKE', "%{$keyword}%")
               ->orWhere('email', 'LIKE', "%{$keyword}%")
               ->orWhere('mobile', 'LIKE', "%{$keyword}%")
               ->orWhere('field', 'LIKE', "%{$keyword}%");
        });
    })
    ->when(request()->filled('option'), function ($q) {
        $options = (array) request('option');

        $q->where(function ($query) use ($options) {
            $query->whereIn('option_1_id', $options)
                ->orWhereIn('option_2_id', $options)
                ->orWhereIn('option_3_id', $options);
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

    return view('applicants.search', [
        'applicants' => $applicants, 'options'=>$options,'races' => $races, 'qualifications'=>$qualifications,
        'states'=>$states
    ]);
    } 

public function show($id){
    $applicant = Applicant::findOrFail($id);
    return view ('applicants.show', compact('applicant'));
}

public function create(){
    
    $options = Option::all();
    $genders = Gender::all();
    $races = Race::all();
    $states = State::all();
    $qualifications = Qualification::all();
    $institutes = Institution::all();
    $employStatuses = EmployStatus::all();
    $unemployDurations = UnemployDuration::all();
    $incomes = Income::all();
   
    return view ('applicants.create',compact('options','genders','races','states','qualifications','institutes','employStatuses',
    'unemployDurations','incomes'));
}

    public function store(Request $request) {

      $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:225',
        'mobile' => 'required|string',
        'ic_num' => 'required|digits:12',
        'age' => 'required',
        'birth_date' => 'required',
        'gender_id' => 'required|not_in:-1|exists:gender_table,id',
        'race_id' => 'required|not_in:-1|exists:race_table,id',
        'bumi_id' => 'required',
        'nationality_id' => 'required',
        'address' => 'required',
        'pos' => 'required',
        'city' => 'required',
        'state_id' => 'required|not_in:-1|exists:state_table,id',
        'qualification_id' => 'required|not_in:-1|exists:qualification_table,id',
        'institution_id' => 'required|not_in:-1|exists:institution_table,id',
        'institute_name' => 'required',
        'field' => 'required',
        'grad_year' => 'required',
        'computer_availability' => 'required',
        'employ_status_id' => 'required|not_in:-1|exists:employ_status_table,id',
        'unemploy_duration_id' => 'required|not_in:-1|exists:unemploy_duration_table,id',
        'household_num' => 'required',
        'recepient_bantuan_id' => 'required',
        'income_id' => 'required|not_in:-1|exists:income_table,id',
        'option_1_id' => 'required|not_in:-1|exists:option_table,id',
        'option_2_id' => 'required|not_in:-1|exists:option_table,id',
        'option_3_id' => 'required|not_in:-1|exists:option_table,id',
        'other_programme' => 'required',
        'other_programme_name' => '',
        'exposure_id' => 'required',
        'agree' => 'required',
      ],
      [
        'gender_id.not_in' => 'Please select a race.',
        'race_id.not_in' => 'Please select a race.',
      ]);



      Applicant::create($validated);

      return redirect()->route('applicants.search');
    }

    public function destroy($id) {

      $applicant = Applicant::findOrFail($id);
      $applicant->delete();

      return redirect()->route('applicants.search');
    }

    public function charts(Request $request)
    {
        $groupBy = $request->group_by ?? 'gender'; // default

        switch ($groupBy) {

            case 'race':
                $results = Applicant::selectRaw('race_id, COUNT(*) as total')
                    ->groupBy('race_id')
                    ->pluck('total', 'race_id');

                $labels = Race::whereIn('id', $results->keys())->pluck('race');
                $chartTitle = 'Applicants by Race';
                break;

            case 'state':
                $results = Applicant::selectRaw('state_id, COUNT(*) as total')
                    ->groupBy('state_id')
                    ->pluck('total', 'state_id');

                $labels = State::whereIn('id', $results->keys())->pluck('state');
                $chartTitle = 'Applicants by State';
                break;
            
            case 'qualification':
                $results = Applicant::selectRaw('qualification_id, COUNT(*) as total')
                    ->groupBy('qualification_id')
                    ->pluck('total', 'qualification_id');

                $labels = Qualification::whereIn('id', $results->keys())->pluck('qualification');
                $chartTitle = 'Applicants by Qualification';
                break;

            default: // gender
                $results = Applicant::selectRaw('gender_id, COUNT(*) as total')
                    ->groupBy('gender_id')
                    ->pluck('total', 'gender_id');

                $labels = Gender::whereIn('id', $results->keys())->pluck('gender');
                $chartTitle = 'Applicants by Gender';
                break;
        }

        $data = $results->values();

        return view('applicants.charts', compact('labels', 'data', 'chartTitle', 'groupBy'));
    }
}
