<?php
namespace Gear\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\FileServiceAwareInterface;
use Gear\Common\StringServiceAwareInterface;
use Gear\Common\DirServiceAwareInterface;
use Gear\Common\ModuleAwareInterface;
use Zend\Console\ColorInterface;

use Gear\Service\Type\ClassService;
use Gear\Service\Filesystem\FileService;
use Gear\Service\Filesystem\DirService;
use Gear\Service\Type\StringService;
use Gear\Common\ConfigAwareInterface;
use Gear\ValueObject\BasicModuleStructure;

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
    ConfigAwareInterface,
    ModuleAwareInterface
{
    protected $serviceLocator;

    protected $adapter;

    protected $stringService;

    protected $dirService;

    protected $fileService;

    protected $classService;

    protected $templateService;


    protected $options;
    /**
     * @var \Gear\ValueObject\BasicModuleStructure
     */
    protected $module;
    protected $config;

    public function getVersion()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['version'***REMOVED***;
    }

    public function outputConsole($message, $color)
    {
        $console = $this->getServiceLocator()->get('console');
        return $console->writeLine($message, ColorInterface::RESET, $color);
    }

    public function output($message, $color, $background)
    {
        $console = $this->getServiceLocator()->get('console');
        return $console->writeLine($message, $color, $background);
    }

    public function outputYellow($message)
    {
        return $this->outputConsole($message,ColorInterface::YELLOW);
    }

    public function outputRed($message)
    {
        return $this->outputConsole($message,ColorInterface::RED);
    }

    public function outputGreen($message)
    {
        return $this->outputConsole($message,ColorInterface::GREEN);
    }

    public function outputBlue($message)
    {
        return $this->outputConsole($message,ColorInterface::BLUE);
    }


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

    public function createFileFromTemplate($templateName, $config, $name, $location)
    {
        $template = $this->getTemplateService()->render($templateName, $config);


        return $this->getFileService()->factory($location, $name, $template);
    }

    public function createFileFromText($content, $name, $location)
    {
        return $this->getFileService()->factory($location, $name, $content);
    }

    public function createFileFromCopy($templateName, $name, $location)
    {

        $config = $this->getServiceLocator()->get('config');

        $from = $config['view_manager'***REMOVED***['template_map'***REMOVED***[$templateName***REMOVED***;

        $tolocation = $location.'/'.$name;

        copy($from, $tolocation);
    }

    public function createEmptyFile($name, $location)
    {
        return $this->getFileService()->empty($location, $name);
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


    public function setTemplateService(TemplateService $fileWriter)
    {
        $this->templateService = $fileWriter;

        return $this;
    }

    public function getTemplateService()
    {
        if (!isset($this->templateService)) {
            $this->templateService = $this->getServiceLocator()->get('templateService');
        }

        return $this->templateService;
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

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($optionsParam = array())
    {
        $request = $this->getServiceLocator()->get('application')->getMvcEvent()->getRequest();

        $options = [***REMOVED***;

        if ($request->getParam('doctrine')) {
            $options[***REMOVED*** = 'doctrine';
        }
        if ($request->getParam('doctrine-fixture')) {
            $options[***REMOVED*** = 'doctrine-fixture';
        }
        if ($request->getParam('unit')) {
            $options[***REMOVED*** = 'unit';
        }
        if ($request->getParam('codeception')) {
            $options[***REMOVED*** = 'codeception';
        }
        if ($request->getParam('ci')) {
            $options[***REMOVED*** = 'ci';
        }

        if ($request->getParam('gear')) {
            $options[***REMOVED*** = 'gear';
        }

        $this->options = array_merge($optionsParam, $options);
        return $this;
    }
}
