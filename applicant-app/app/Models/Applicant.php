<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'applicant_details';
    protected $primaryKey = 'id';
    protected $fillable = ['timestamp', 'name', 'email', 'mobile', 'ic_num', 'age', 
    'birth_date', 'gender_id', 'race_id','bumi_id','nationality_id', 'address', 'pos', 'city',
    'state_id','qualification_id', 'institution_id', 'institute_name','field', 'grad_year',
    'computer_availability','employ_status_id', 'unemploy_duration_id', 'household_id',
    'income_id', 'option_1_id', 'option_2_id','option_3_id', 'other_programme','other_programme_name', 
    'exposure_id', 'agree'];
    const CREATED_AT = 'timestamp';
    const UPDATED_AT = 'timestamp';

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');   
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
        
    public function bumi()
    {
        return $this->belongsTo(Bumiputera::class);
    }
    
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
    
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function employ_status()
    {
        return $this->belongsTo(EmployStatus::class);
    }

    public function unemploy_duration()
    {
        return $this->belongsTo(UnemployDuration::class);
    }

    public function income()
    {
        return $this->belongsTo(Income::class);
    }

    public function optionOne()
    {
        return $this->belongsTo(Option::class,'option_1_id');
    }

    public function optionTwo()
    {
        return $this->belongsTo(Option::class,'option_2_id');
    }
    
    public function optionThree()
    {
        return $this->belongsTo(Option::class,'option_3_id');
    }
    /** @use HasFactory<\Database\Factories\ApplicantsFactory> */
    use HasFactory;
    
}
