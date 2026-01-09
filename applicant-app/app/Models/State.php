<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state_table';
    protected $fillable = ['state'];
       
    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    //
}
