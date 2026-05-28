<?php
namespace App\Repository;

use App\Models\User\Investment\Investment;
use App\Repository\Contract\InvestmentInterface;

class InvestmentInterfaceRepository implements InvestmentInterface{


    public function create($userId,$planId,$planPrice,$durationDays)
    {

            Investment::create([
                'user_id' => $userId,
                'investment_plan_id' => $planId,
                'amount' => $planPrice,
                'status' => 'active',
                'expires_at' => now()->addDays($durationDays?? 300),
            ]);
    }

}