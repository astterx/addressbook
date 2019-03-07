<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageFileService implements FileServiceInterface
{
    private $picturesDirectory;

    public function __construct(string $picturesDirectory)
    {
        $this->picturesDirectory = $picturesDirectory;
    }

    public function move(UploadedFile $file): string 
    {
        $filename = md5(uniqid()) . '.' . $file->guessExtension();
        try {
            $file->move(
                $this->picturesDirectory,
                $filename
            );
        } catch (FileException $e) {
            die ('File did not upload: ' . $e->getMessage());
        }

        return $filename;
    }

    public function delete(string $path)
    {
        if (is_file($this->picturesDirectory . '/' . $path))
        {
            unlink($this->picturesDirectory . '/' . $path);
        }
    }
}
