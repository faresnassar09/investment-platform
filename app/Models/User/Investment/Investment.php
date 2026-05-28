<?php

namespace App\Models\User\Investment;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{


    public $fillable = ['user_id','amount','status','expires_at','investment_plan_id'];
}
