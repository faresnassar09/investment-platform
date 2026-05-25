<?php

namespace App\Services\Logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoggingService {


    public function successLogger($message = '' , $data = []){

        $data = $data+ [
            'userId' => Auth::id(),

        ];

        Log::channel('investment')->info($message , $data);

    }

    public function failedLogger($message = '' , $data = [] ,  $errorMessage = null){

        $data = $data+ [
            'userId' => Auth::id(),

        ];

        Log::channel('investment')->error($message, [$data,$errorMessage] );
    }


}