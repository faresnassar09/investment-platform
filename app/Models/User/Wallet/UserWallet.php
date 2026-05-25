<?php

namespace App\Models\User\Wallet;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    
    public $fillable = ['user_id','balance','team_earnings','salary'];
}
