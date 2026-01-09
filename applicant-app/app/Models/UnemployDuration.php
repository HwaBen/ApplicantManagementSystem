<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnemployDuration extends Model
{
    protected $table = 'unemploy_duration_table';
    protected $fillable = ['unemploy_duration'];
       
    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    //
}
