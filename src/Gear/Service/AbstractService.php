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

    use \Zend\ServiceManager\ServiceLocatorAwareTrait;
    use \Gear\Common\StringServiceTrait;
    use \Gear\Common\ClassServiceTrait;
    use \Gear\Common\DirServiceTrait;
    use \Gear\Common\FileServiceTrait;
    use \Gear\Common\TemplateServiceTrait;

    protected $adapter;
    protected $options;
    /**
     * @var \Gear\ValueObject\BasicModuleStructure
     */
    protected $module;
    protected $config;


    //version functions
    public function getVersion()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['version'***REMOVED***;
    }

    //console functions
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
        $this->module = $module;
        return $this;
    }

    public function getModule()
    {
        if (!isset($this->module)) {
            $this->module = $this->getServiceLocator()->get('moduleStructure');
        }
        return $this->module;
    }

    //view renderer functions
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

    //string function
    public function str($type, $message)
    {
        return $this->getStringService()->str($type, $message);
    }

    public function setTemplateService(TemplateService $fileWriter)
    {
        $this->templateService = $fileWriter;

        return $this;
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        if (!isset($this->config)) {
            $this->config = $this->getServiceLocator()->get('moduleConfig');
        }
        return $this->config;
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

    public function getRequest()
    {
        if (!isset($this->request)) {
            $this->request = $this->getServiceLocator()->get('application')->getMvcEvent()->getRequest();
        }
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function setOptions($optionsParam = array())
    {
        $request = $this->getRequest();

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

        if ($request->getParam('repository')) {
            $options[***REMOVED*** = 'repository';
        }

        if ($request->getParam('service')) {
            $options[***REMOVED*** = 'service';
        }

        $this->options = array_merge($optionsParam, $options);
        return $this;
    }
}
