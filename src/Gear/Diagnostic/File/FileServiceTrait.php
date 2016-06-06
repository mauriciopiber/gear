<?php
namespace Gear\Diagnostic\File;

use Gear\Diagnostic\File\FileService;

trait FileServiceTrait
{
    protected $fileDiagService;

    public function getFileDiagnosticService()
    {
        if (!isset($this->fileDiagService)) {
            $name = 'Gear\Diagnostic\FileService';
            $this->fileDiagService = $this->getServiceLocator()->get($name);
        }
        return $this->fileDiagService;
    }

    public function setFileDiagnosticService(
        FileService $fileService
    ) {
        $this->fileDiagService = $fileService;
        return $this;
    }
}
