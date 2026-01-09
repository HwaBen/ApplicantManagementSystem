<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bumiputera extends Model
{
    protected $table = 'bumi_table';
    protected $fillable = ['bumi'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
    /** @use HasFactory<\Database\Factories\BumiputeraFactory> */
    use HasFactory;
}
