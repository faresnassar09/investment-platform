<?php

namespace App\Repository;

use App\Models\User\Plan\InvestmentPlan;

class PlanInterfaceRepository {

    public function create($data){}

    public function find($id){

        return InvestmentPlan::findOrFail($id);

    }

    public function get(){

               return InvestmentPlan::orderBy('price', 'asc')->get();
    }


}