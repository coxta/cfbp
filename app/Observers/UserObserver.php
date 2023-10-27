<?php

namespace App\Observers;

use App\Models\User;
use Masmerise\Toaster\Toaster;

class UserObserver
{

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        
        if(!isset($user->teams)) {
            $user->teams = [];
            $user->save();
        }
        
        Toaster::success('Account created!');

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}