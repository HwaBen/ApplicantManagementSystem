<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batch_table';
    protected $fillable = ['batch'];

    public function applicant(){
        return $this->hasMany(Applicant::class);
    }
}