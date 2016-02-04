<?php
namespace Gear\Common;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\FileServiceAwareInterface;
use Gear\Common\StringServiceAwareInterface;
use Gear\Common\DirServiceAwareInterface;

use Gear\Service\Type\ClassService;
use Gear\Service\Filesystem\FileService;
use Gear\Service\Filesystem\DirService;
use Gear\Service\Type\StringService;


use Gear\ValueObject\Config\Config;
use Gear\ValueObject\BasicModuleStructure;
/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @author piber
 */

abstract class BaseAbstract implements
    ServiceLocatorAwareInterface,
    ClassServiceAwareInterface,
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ModuleAwareInterface
{

    protected $serviceLocator;
    protected $adapter;
    protected $stringService;
    protected $dirService;
    protected $fileService;
    protected $classService;

    protected $moduleService;


    public function setModule(BasicModuleStructure $module)
    {
        if (!isset($this->module)) {
            $this->module = $module;
        }
        return $this;
    }

    public function getModule()
    {
        if (!isset($this->module)) {
            $this->module = $this->getServiceLocator()->get('moduleStructure');
        }
        return $this->module;
    }

    public function __construct()
    {

    }

    public function setStringService(StringService $fileWriter)
    {
        $this->stringService = $fileWriter;

        return $this;
    }

    public function getStringService()
    {
        if (!isset($this->stringService)) {
            $this->stringService = $this->getServiceLocator()->get('stringService');
        }

        return $this->stringService;
    }

    public function str($type, $message)
    {
        return $this->getStringService()->str($type, $message);
    }

    public function setDirService(DirService $dirWriter)
    {
        $this->dirService = $dirWriter;

        return $this;
    }

    public function getDirService()
    {
        if (!isset($this->dirService)) {
            $this->dirService = $this->getServiceLocator()->get('dirService');
        }

        return $this->dirService;
    }

    public function setFileService(FileService $fileWriter)
    {
        $this->fileService = $fileWriter;

        return $this;
    }

    public function getFileService()
    {
        if (!isset($this->fileService)) {
            $this->fileService = $this->getServiceLocator()->get('fileService');
        }

        return $this->fileService;
    }

    public function setClassService(ClassService $fileWriter)
    {
        $this->classService = $fileWriter;

        return $this;
    }

    public function getClassService()
    {
        if (!isset($this->classService)) {
            $this->classService = $this->getServiceLocator()->get('classService');
        }

        return $this->classService;
    }

    public function setConfig(Config $config)
    {

        $this->config = $config;

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function getIndent($indent, $patters = 4)
    {
        return $this->getClassService()->getIndent($indent, $patters);
    }

    public function powerline($indent, $text, $params = array(), $newline = false)
    {
        return $this->getClassService()->powerLine($indent, $text, $params, $newline);
    }

}