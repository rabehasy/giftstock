<?php

namespace App\Domain\Gift;

class UploadedGiftMessage
{
    private string $filename;
    /**
     * @var string
     */
    private $targetDirectory;

    public function __construct(string $filename, string $targetDirectory)
    {
        $this->filename = $filename;
        $this->targetDirectory = $targetDirectory;
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }
}
