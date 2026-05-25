<?php

namespace App\Repository;

use App\Models\User\Deposit\Deposit;
use App\Repository\Contract\DepositInterface;

class DepositInterfaceRepository implements DepositInterface{

    public function create($userId,$amount,$description,$imagePath){

        Deposit::create([

            'user_id' => $userId,
            'amount' => $amount,
            'description' => $description,
            'image_path' => $imagePath,  

        ]);
    }
}