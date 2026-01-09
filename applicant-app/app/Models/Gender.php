<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'gender_table';
    protected $fillable = ['gender'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    use HasFactory;
}
