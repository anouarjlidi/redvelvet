<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/22/2018
 * Time: 10:51 PM
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir = "photos/";

    public function upload(UploadedFile $file)
    {
        $fileName = $this->getTargetDir().md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}