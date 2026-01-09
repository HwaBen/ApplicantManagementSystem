<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $table = 'institution_table';
    protected $fillable = ['institution'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    /** @use HasFactory<\Database\Factories\InstitutionFactory> */
    use HasFactory;
}
