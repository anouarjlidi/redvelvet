<?php
/**
 * Created by PhpStorm.
 * Author : Vytautas Saulis
 * Date: 2/22/2018
 * Time: 10:51 PM
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    public function delete($filename)
    {
        unlink($this->getTargetDirectory().'/'.$filename);
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}