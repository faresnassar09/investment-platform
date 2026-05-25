<?php

namespace App\Repository\Contract;

interface DepositInterface{


    public function create($userId,$amount,$description,$image);

}