<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Company;
use App\Models\Qualification;
use App\Models\Race;
use App\Models\Option;
use App\Models\Gender;
use App\Models\State;
use App\Models\Institution;
use App\Models\EmployStatus;
use App\Models\UnemployDuration;
use App\Models\Income;


class ParticipantController extends Controller
{
    public function search()
    {
        $companies = Company::all();

        $participants= Participant::query()
            ->when(request('keyword'), function ($q,$keyword){
                // Remove hyphens from the user's search input
                
                $cleanKeyword = str_replace('-', '', $keyword);

                $q->where(function($q2) use($keyword, $cleanKeyword){
                    $q2->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhere('field', 'LIKE', "%{$keyword}%")
                    // Remove hyphens from database value before comparing
                    ->orWhereRaw("REPLACE(ic_num, '-', '') LIKE ?", ["%{$cleanKeyword}%"])
                    ->orWhereRaw("REPLACE(mobile, '-', '') LIKE ?", ["%{$cleanKeyword}%"]);             
                    });
            })
            ->when(request('company'), fn ($q, $company) => $q->whereIn('company_id', $company))

            ->paginate(20)
            ->withQueryString();            

        return view('participants.search',[
            'participants'=>$participants, 'companies'=> $companies
        ]);
    }

    public function show($id){
        $participant = Participant::findOrFail($id);
    return view ('participants.show', compact('participant'));
}
}