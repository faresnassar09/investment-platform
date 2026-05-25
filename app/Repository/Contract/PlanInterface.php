<?php

namespace App\Repository\Contract;


interface PlanInterface {


    public function create($data);
    public function find($id);
    public function get();


}