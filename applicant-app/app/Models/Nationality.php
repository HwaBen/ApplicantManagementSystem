<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $table = 'nationality_table';
    protected $fillable = ['nationality'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    /** @use HasFactory<\Database\Factories\NationalityFactory> */
    use HasFactory;
}
