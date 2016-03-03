<?php
namespace Gear\Creator;

use Gear\Creator\File;

trait FileCreatorTrait
{
    /* @var $fileCreator Gear\Creator\File */
    protected $fileCreator;

    public function getFileCreator()
    {
        if (!isset($this->fileCreator)) {
            $this->fileCreator = $this->getServiceLocator()->get('Gear\FileCreator');
        }
        return $this->fileCreator;
    }

    public function setFileCreator(File $fileCreator)
    {
        $this->fileCreator = $fileCreator;
        return $this;
    }
}
