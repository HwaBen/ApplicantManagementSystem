<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = 'qualification_table';
    protected $fillable = ['qualification'];
       
    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    /** @use HasFactory<\Database\Factories\QualificationFactory> */
    use HasFactory;
}
