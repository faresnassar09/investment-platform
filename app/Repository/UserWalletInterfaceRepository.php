<?php

namespace App\Repository;

use App\Models\User\Wallet\UserWallet;
use App\Repository\Contract\UserWalletInterface;

class UserWalletInterfaceRepository implements UserWalletInterface{


    public function find($userId){

        return UserWallet::where('user_id',$userId)->first();
    }

    public function findAndLock($walletId){


       return UserWallet::where('id', $walletId)->lockForUpdate()->first();

    }


}