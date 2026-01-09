<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class race extends Model
{
    protected $table = 'race_table';
    protected $fillable = ['race'];
       
    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
}
