<?php

namespace App\Helper;

use Intervention\Image\ImageManager;

class ImageHelper
{
    // sukurti funkcija kuri ikelia img i server(TIK IKELIA)

    public static function uploadImage($directory, $fileName)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $targetDir = $directory;
        $targetFile = $targetDir . basename($fileName["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // checking if file exists
        if (file_exists($targetFile)) {
            echo "The, file: $targetFile, already exists.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($fileName["img"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($fileName["img"]["name"]) . " has been uploaded in this directory: $directory.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }


    // sukurt funkcija kuri generuoja folderius (TIK GENERUOJA)

    public static function generateFolderPath($imageName)
    {
        $i = 0;
        $directory = '/';
        while ($i < 3) {
            $directory .= $imageName[$i] . '/';
            $i++;
        }
        $generatedDir = "/var/www/tomas.sabaliauskis.lt/public_html/phpObjektinis/uploads" . $directory;
        return $generatedDir;
    }

    public static function getCreatedPath($imageName){
        $i = 0;
        $directory = '/';
        while ($i < 3) {
            $directory .= $imageName[$i] . '/';
            $i++;
        }
        return $directory;
    }

    public static function checkIfImageEgzist(){

    }

    public  static function getFileNameWithDirectory($imageName){
        return self::getCreatedPath($imageName).$imageName;
    }


    // sukurti funkcija kuri sugeneruoja naujo didzio foto, arba grazina esamos linka (TIK GENERUOJA ir GRAZINA ARBA  GRAZINA);

    public static function generateImage($imageName, $height='', $width = '') {
     $newImageDir = self::generateFolderPath($imageName);
     $newFullPath = $newImageDir.$height."X".$width.$imageName;

     if (!file_exists($newImageDir)) {
         mkdir($newImageDir, 0755, true);
     }


     if (!file_exists($newFullPath)) {


             $manager = new ImageManager(array('driver' => 'imagick'));
             if ($height !== '' && $width !== ''){
//                 debug($newImageDir);
                 $image = $manager->make($newImageDir . $imageName)->resize($height, $width);

             }else{
                 $image = $manager->make($newImageDir . $imageName);
             }
             $image->save($newFullPath);
             $newFullPath = str_replace('/var/www/tomas.sabaliauskis.lt/public_html/phpObjektinis/','', $newFullPath);
             return $newFullPath;

     }else {
         $newFullPath = str_replace('/var/www/tomas.sabaliauskis.lt/public_html/phpObjektinis/','', $newFullPath);
         return $newFullPath;
     }
    }


}

//VISKAS
