<?php

namespace App\Application\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploaderInterface
{
    /**
     * @return string|null
     */
    public function upload(UploadedFile $file);
}
