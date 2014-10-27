<?php
namespace Gear;

use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Gear\Common\ConfigAwareInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\ModuleAwareInterface;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Console\ColorInterface;
use ZendDiagnostics\Check\DirWritable;
use ZendDiagnostics\Check\ExtensionLoaded;
use ZendDiagnostics\Check\ProcessRunning;
use ZendDiagnostics\Check\PhpVersion;
use ZendDiagnostics\Check\CpuPerformance;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Module implements ConsoleUsageProviderInterface,ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $moduleManager;


    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setModuleManager($moduleManager)
    {
        $this->moduleManager = $moduleManager;
        return $this;
    }

    public function getModuleManager()
    {
        return $this->moduleManager;
    }

    public function setUpAcl($event)
    {
        $loadedModules = $this->getModuleManager()->getLoadedModules();
        $merge = [***REMOVED***;

        foreach ($loadedModules as $moduleName => $module) {
            if (method_exists($module, 'getConfig')) {
                $config = $module->getConfig();
                if (isset($config['acl'***REMOVED***[$moduleName***REMOVED***) && $config['acl'***REMOVED***[$moduleName***REMOVED*** === true) {
                    $merge[$moduleName***REMOVED*** = $module;
                }
            }
        }

        $service = $event->getTarget();
        $service->setLoadedModules($merge);
    }

    public function setUpSecurity($event)
    {
        $loadedModules = $this->getModuleManager()->getLoadedModules();
        $loadedModules      = array_keys($loadedModules);
        if (!in_array('Security', $loadedModules)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Security need to be loaded to run'
                )
            );
        }
    }

    public function init(ModuleManager $moduleManager)
    {
        $this->setModuleManager($moduleManager);
        $eventManager = $moduleManager->getEventManager();
        $shareManager = $eventManager->getSharedManager();
        $shareManager->attach('Gear\Controller\IndexController', 'dependsSecurity', array($this, 'setUpSecurity'));
        $shareManager->attach('Gear\Service\AclService', 'loadModules', array($this, 'setUpAcl'));
    }

    public function setUpSchema($event)
    {
        if (!$event->getTarget()->getRequest() instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $controller = $event->getTarget();
        $controller->getEventManager()->attachAggregate($this->getServiceLocator()->get('SchemaListener'));
        $controller->getEventManager()->attachAggregate($this->getServiceLocator()->get('LogListener'));
    }

    public function setUpModule($event)
    {
        $module = $event->getTarget()->getRequest()->getParam('module');

        if (empty($module)) {
            throw new \InvalidArgumentException('Module need to be set to run this action');
        }
    }

    public function onBootstrap(MvcEvent $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $application = $event->getApplication();

        $serviceManager = $event->getApplication()->getServiceManager();
        $this->setServiceLocator($serviceManager);
        // get the shared events manager
        $sharedManager = $application->getEventManager()->getSharedManager();

        $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController',  'dispatch', array($this, 'setUpSchema'), 2);
        $sharedManager->attach('Gear\Controller\IndexController', 'module.pre', array($this, 'setUpModule'));

    }

    public function getConsoleUsage(Console $console)
    {
        return array(
            'gear (--version|-v)'                                                           => 'Shows version.',

            'gear src <action> <srcType> [<options>***REMOVED***'                                       => 'Execute actions for src files',
            'gear migrate'                                                                  => 'Migrate project',
            'gear dump <module> <type>'                                                     => 'Dump a schema from a module in Json and Array',
            'gear module create <module>'                                                   => 'Create a new basic module with IndexAction',
            'gear module remove <module>'                                                   => 'Removes full module',
            'gear module add-config <module>'                                               => 'Add a module to the application.config.php',
            'gear module del-config <module>'                                               => 'Delete a module from the application.config.php',
            'gear create crud <project> <path> <module> [<table_prefix>***REMOVED***'                   => 'Create full suite for all tables',
            'gear create entities <project> <path> <module> [<table_prefix>***REMOVED***'               => 'Create by doctrine all entities for project',
            'gear create project <project> <path>'                                          => 'Create a new skeleton app',
            'gear create file <project> <path> <module> <file> [<table>***REMOVED*** [<table_prefix>***REMOVED***'  => 'Create a new file from a specified format',
            'gear create lego <project> <path> <module> <piece> [<table>***REMOVED*** [<table_prefix>***REMOVED***' => 'Create a single piece of software',
            'gear create crud-unique <project> <path> <module> <table> [<table_prefix>***REMOVED*** [<exclude>***REMOVED***' => 'Create a full suite for a single table with exclude options'
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'arrayToYml' => 'Gear\Factory\ArrayToYmlHelperFactory',
                'str' => 'Gear\Factory\StrHelperFactory'
            )
        );
    }


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getLocation()
    {
        return __DIR__;
    }

    public function getDiagnostics()
    {
        return array(
            'Cache & Log Directories Available' => function() {
                $folder = \Gear\ValueObject\Project::getStaticFolder();
                $diagnostic = new DirWritable(array(
                    $folder . '/data/cache',
                    $folder . '/data/logs',
                    __DIR__ . '/Entity',
                ));
                return $diagnostic->check();
            },
            'Check PHP extensions' => function(){
                $diagnostic = new ExtensionLoaded(array(
                    'json',
                    'pdo',
                    'pdo_mysql',
                    'intl',
                ));
                return $diagnostic->check();
            },
            'Check Apache is running' => function(){
                $diagnostic = new ProcessRunning('apache2');
                return $diagnostic->check();
            },
            'CPU Performance' => function(){
                $diagnostic = new CpuPerformance(0.5);
                return $diagnostic->check();
            },
            'Check PostgreSQL is running' => function(){
                $diagnostic = new ProcessRunning('mysql');
                return $diagnostic->check();
            },
            'Check PHP Version' => function(){
                $diagnostic = new PhpVersion('5.5.0', '>=');
                return $diagnostic->check();
            }
        );
    }
}
