<?php

namespace App\Repository;

use App\Models\User\Deposit\Deposit;
use App\Repository\Contract\DepositInterface;
use Illuminate\Support\Facades\Auth;
use Override;

class DepositInterfaceRepository implements DepositInterface{

    public function create($userId,$amount,$description,$imagePath){

        Deposit::create([

            'user_id' => $userId,
            'amount' => $amount,
            'description' => $description,
            'image_path' => $imagePath,  

        ]);
    }

    public function get(){



        return   Deposit::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    }

    public function delete($id)
    {
        $deposit = Deposit::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        $deposit->delete();
    }
}