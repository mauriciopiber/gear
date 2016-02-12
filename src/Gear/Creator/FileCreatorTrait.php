<?php
namespace Gear\Creator;

use Gear\Creator\File;

trait FileCreatorTrait
{
    protected $fileCreator;

    public function getFileCreator()
    {
        if (!isset($this->fileCreator)) {
            $this->fileCreator = $this->getServiceLocator()->get('fileCreator');
        }
        return $this->fileCreator;
    }

    public function setFileCreator(File $fileCreator)
    {
        $this->fileCreator = $fileCreator;
        return $this;
    }
}
