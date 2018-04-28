<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/22/2018
 * Time: 10:51 PM
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FilesUploader
{
    public function uploadPhotos(UploadedFile $files, $targetDir)
    {
        foreach ($files as $file)
        {
            $fileName = $targetDir.md5(uniqid()).'.'.$file->guessExtension();
            $file->move($targetDir, $fileName);
        }
    }
}