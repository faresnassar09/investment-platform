<?php

namespace App\Observers\User;

use App\Models\User;
use App\Models\User\Wallet\UserWallet;

class CreateWallet
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        
        UserWallet::create([

            'user_id' => $user->id,
            'balance' => 0,
            'team_earnings' => 0,
            'salary' => 0,
        ]);

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
