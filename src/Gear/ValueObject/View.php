<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractHydrator;

class View extends AbstractHydrator
{
    protected $fileLocation;

    protected $fileName;

    protected $viewFolder;

    protected $target;

    protected $module;



    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function getFileName()
    {
        if (!isset($this->fileName)) {

            $target   = $this->getTarget();
            $targets  = explode('/', $target);
            $fileName = end($targets);

            $this->fileName = $fileName;
        }
        return $this->fileName;
    }

    public function getFileLocation()
    {
        if (!isset($this->fileLocation)) {

            $location = $this->getTarget();
            $locations = explode('/', $location);

            array_pop($locations);

            $location = $this->getViewFolder().'/'.implode('/', $locations);

            $this->fileLocation = $location;

        }
        return $this->fileLocation;
    }

    public function prepare($moduleName)
    {
        $module = new \Gear\ValueObject\BasicModuleStructure($moduleName);
        $module->prepare($moduleName);

        $this->setViewFolder($module->getViewFolder());

        $location = $this->getTarget();
        $locations = explode('/', $location);

        array_pop($locations);

        $deep = count($locations);

        $lastFolder = $this->getViewFolder();

        for ($i = count($locations); $i > 0; $i--) {
            $lastFolder = $lastFolder.'/'.$locations[$i-1***REMOVED***;
        }

        //var_dump($locations);

        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget($dir)
    {
        $this->target = $dir;
        return $this;
    }

    public function getViewFolder()
    {
        return $this->viewFolder;
    }

    public function setViewFolder($mainFolder)
    {
        $this->viewFolder = $mainFolder;
        return $this;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    public function setFileLocation($fileLocation)
    {
        $this->fileLocation = $fileLocation;
        return $this;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }
}
