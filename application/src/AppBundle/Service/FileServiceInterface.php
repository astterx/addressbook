<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileServiceInterface
{
    public function move(UploadedFile $file);

    public function delete(string $path);
}
