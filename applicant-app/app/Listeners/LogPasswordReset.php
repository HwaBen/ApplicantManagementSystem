<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use App\Models\UserLog;

class LogPasswordReset
{
    public function handle(PasswordReset $event): void
    {
        $user = $event->user;

        UserLog::create([
            'performed_by' => $user->id,     // user who reset password
            'user_id'      => $user->id,     // affected user
            'action'       => 'password_reset',
            'details'      => [
                'message' => 'Password reset via forgot password',
                'performed_by_name' => $user->name, // IMPORTANT for deleted users later
            ],
        ]);
    }
}
