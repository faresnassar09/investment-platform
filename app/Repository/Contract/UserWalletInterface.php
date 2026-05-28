<?php

namespace App\Repository\Contract;

interface UserWalletInterface {

    public function find($userId);

    public function findAndLock($walletId);


}