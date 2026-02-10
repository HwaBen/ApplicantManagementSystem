<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'performed_by',
        'user_id',
        'action',
        'details',
    ];

    protected $casts = [
        'details' => 'array', // auto JSON decode
    ];

    // Who performed the action
    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    // Affected user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
