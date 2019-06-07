<?php
namespace Gear\Diagnostic\File;

use Gear\Diagnostic\File\FileService;

trait FileServiceTrait
{
    protected $fileDiagService;

    public function getFileDiagnosticService()
    {
        return $this->fileDiagService;
    }

    public function setFileDiagnosticService(
        FileService $fileService
    ) {
        $this->fileDiagService = $fileService;
        return $this;
    }
}
