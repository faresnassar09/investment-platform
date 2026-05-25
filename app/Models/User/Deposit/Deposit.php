<?php

namespace App\Models\User\Deposit;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{

    public $fillable = ['user_id','status','amount','description','image_path'];

}
