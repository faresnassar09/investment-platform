<?php

namespace App\Repository\Contract;


interface InvestmentInterface { 

    public function create($userId,$planId,$planPrice,$durationDays);


}