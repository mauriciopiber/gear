<?php
namespace Gear\Creator\FileCreator;

use Gear\Creator\FileCreator\FileCreator;

trait FileCreatorTrait
{
    /* @var $fileCreator Gear\Creator\File */
    protected $fileCreator;

    public function getFileCreator()
    {
        if (!isset($this->fileCreator)) {
            $this->fileCreator = $this->getServiceLocator()->get(FileCreator::class);
        }
        return $this->fileCreator;
    }

    public function setFileCreator(FileCreator $fileCreator)
    {
        $this->fileCreator = $fileCreator;
        return $this;
    }
}
