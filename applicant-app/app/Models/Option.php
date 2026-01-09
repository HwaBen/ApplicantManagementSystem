<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option_table';
    protected $fillable = ['option'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    //
}
