<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployStatus extends Model
{
    protected $table = 'employ_status_table';
    protected $fillable = ['employ_status'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    //
}
