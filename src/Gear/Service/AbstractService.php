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

    public function replaceInFile($fileLocation, $search, $replace)
    {
        $file = file_get_contents($fileLocation);
        $file = str_replace($search, $replace, $file);
        file_put_contents($fileLocation, $file);
        return true;
    }
    //version functions
    public function getVersion()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['version'***REMOVED***;
    }

    public function getConsole()
    {
        if (!isset($this->console)) {
            $this->console = $this->getServiceLocator()->get('console');
        }

        return $this->console;
    }

    public function setConsole($console)
    {
        $this->console = $console;
        return $this;
    }


    //console functions
    public function outputConsole($message, $color)
    {
        $console = $this->getConsole();
        return $console->writeLine($message, ColorInterface::RESET, $color);
    }

    public function output($message, $color, $background)
    {
        $console = $this->getConsole();
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

        $renderer = $this->getTemplateService()->getRenderer();



        $from = $renderer->resolver($templateName);

        if (!$from) {
            throw new \Exception(sprintf('Template Not Found: %s', $templateName));
        }



      /*   $config = $this->getServiceLocator()->get('config');

        $from = $config['view_manager'***REMOVED***['template_map'***REMOVED***[$templateName***REMOVED***; */

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
            $this->config = $this->getServiceLocator()->get('config');
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

}
