<?php

namespace App\Services\Files;


class FileService{


    public function uploadImage($image,$folder){

        $fileName = $image->getClientOriginalName();
        $fileExtention = $image->getClientOriginalExtension();

        $completeFileName = $fileName . '_' . time() . '.' . $fileExtention;

        $storeImage = $image->storeAs($folder,$completeFileName,'public');

                if (!$storeImage) {

            return false;
        } else {

            return $storeImage;
        } 

    }

}
