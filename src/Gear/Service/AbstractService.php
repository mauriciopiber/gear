<?php
namespace Gear\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\FileServiceAwareInterface;
use Gear\Common\StringServiceAwareInterface;
use Gear\Common\DirServiceAwareInterface;

use Gear\Service\Filesystem\ClassService;
use Gear\Service\Filesystem\FileService;
use Gear\Service\Filesystem\DirService;
use Gear\Service\Type\StringService;
use Gear\Common\ConfigAwareInterface;

use Gear\ValueObject\Config\Config;
use Zend\View\Model\ViewModel;
/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @author piber
 */
abstract class AbstractService implements
    ServiceLocatorAwareInterface,
    ClassServiceAwareInterface,
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ConfigAwareInterface
{
    protected $serviceLocator;
    protected $adapter;
    protected $stringService;
    protected $dirService;
    protected $fileService;
    protected $classService;
    protected $config;

    public function createFileFromTemplate($templateName, $config, $name, $location)
    {
        $phpRenderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();

        $view = new ViewModel($config);
        $view->setTemplate($templateName);

        $template = $phpRenderer->render($view);

        return $this->getFileService()->factory($location, $name, $template);
    }


    public function createEmptyFile($name, $location)
    {
        return $this->getFileService()->factory($location, $name, ' ');
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


    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }


	public function getAdapter()
	{
		return $this->adapter;
	}

	public function setAdapter($adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getIndent($indent, $patters = 4)
	{
	    return $this->getClassService()->getIndent($indent, $patters);
	}

	public function powerline($indent, $text, $params = array(), $newline = false)
	{
	    return $this->getClassService()->powerLine($indent, $text, $params, $newline);
	}


	public function getRepository($repositoryName)
	{
	    if($repositoryName) {

	        $serviceName = sprintf('%sRepository',$repositoryName);

	        $repository = $this->getServiceLocator()->get($serviceName);
	        if($repository) {
	            return $repository;
	        }
	    }
	    return false;
	}

}