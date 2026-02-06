<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participant_details';
    protected $primaryKey = 'id';
    protected $fillable = ['employee_id', 'name', 'batch_id', 'date_join','date_end','email',
    'mobile','ic_num','age','birth_date','gender_id','race_id','address','pos','city','state_id',
    'qualification_id','institution_id','institution_name','field','grad_year','company_id'];
    const CREATED_AT = 'timestamp';
    const UPDATED_AT = 'timestamp';
    
    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id');
    }

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');   
    }
    
    public function race(){
        return $this->belongsTo(Race::class,'race_id');   
    }

    public function state(){
        return $this->belongsTo(State::class,'gender_id');   
    }

    public function qualification(){
        return $this->belongsTo(Qualification::class,'gender_id');   
    }

    public function institution(){
        return $this->belongsTo(Institution::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    use HasFactory;
    
}
