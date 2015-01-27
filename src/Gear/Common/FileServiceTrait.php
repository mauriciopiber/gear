<?php
namespace Gear\Common;

use Gear\Service\Filesystem\FileService;

trait FileServiceTrait {

    protected $fileService;

    public function getFileService()
    {
        if (!isset($this->fileService)) {
            $this->fileService = $this->getServiceLocator()->get('Gear\Service\Filesystem\File');
        }
        return $this->fileService;
    }

    public function setFileService(FileService $fileService)
    {
        $this->fileService = $fileService;
        return $this;
    }
}
