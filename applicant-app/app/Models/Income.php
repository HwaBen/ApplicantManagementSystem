<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'income_table';
    protected $fillable = ['income'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    //
}
