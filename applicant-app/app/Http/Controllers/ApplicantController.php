<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use App\Models\Qualification;

class ApplicantController extends Controller
{
    public function create()
{
    $races = Race::all();   // fetch all races from the database

    $qualification = Qualification::all();

    return view('search', compact('races','qualification'));

}

}
