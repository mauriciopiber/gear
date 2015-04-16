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

    public function loadFixtures($event)
    {
        $loadedModules = $this->getModuleManager()->getLoadedModules();
        $merge = [***REMOVED***;

        foreach ($loadedModules as $moduleName => $module) {
            if (method_exists($module, 'getConfig')) {
                $config = $module->getConfig();
                if (isset($config['data-fixture'***REMOVED***)) {
                    foreach ($config['data-fixture'***REMOVED*** as $name => $location) {
                        $merge[$moduleName***REMOVED*** = $location;
                    }
                }
            }
        }
        $service = $event->getTarget();
        $service->setLoadedFixtures($merge);
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

        $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController',  'dispatch', function($event)
            use ($serviceManager) {

            $controller = $event->getTarget();
            $controller->getEventManager()->attachAggregate($serviceManager->get('SchemaListener'));
        }, 2);

        $sharedManager->attach(
            '*',
            'init',
            function($event) use ($serviceManager) {

                $controller = $event->getTarget();
                $controller->getEventManager()->attachAggregate($serviceManager->get('SchemaListener'));
            },
            2
        );


        $sharedManager->attach('Gear\Controller\IndexController', 'module.pre', array($this, 'setUpModule'));
    }

    public function init(ModuleManager $moduleManager)
    {
        $this->setModuleManager($moduleManager);
        $eventManager = $moduleManager->getEventManager();
        $shareManager = $eventManager->getSharedManager();
        $shareManager->attach('Gear\Service\AclService', 'loadModules', array($this, 'setUpAcl'));
        $shareManager->attach('Gear\Service\FixtureService', 'loadFixtures', array($this, 'loadFixtures'));
    }

    public function getConsoleUsage(Console $console)
    {
        return array(
            //Project
            'gear project create <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= --username= --password=' => '',
            'gear project setUpGlobal --host= --dbname=  --dbms= --environment= ' => '',
            'gear project setUpLocal --username= --password= ' => '',
            'gear project setUpEnvironment --environment=' => '',
            'gear project setUpConfig --host= --dbname=  --username= --password= --environment= --dbms=' => '',
            'gear project deploy <environment>' => '',

            //Module
            'gear module create   <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED***' => '',
            'gear module create   <module> --light [--ci***REMOVED*** [--build=***REMOVED*** [--doctrine***REMOVED*** [--doctrine-fixture***REMOVED*** [--unit***REMOVED*** [--codeception***REMOVED*** [--gear***REMOVED***' => '',
            'gear module delete   <module>' => '',
            'gear module load     <module> [--before=***REMOVED*** [--after=***REMOVED***' => '',
            'gear module unload   <module>' => '',
            'gear module build    <module> [--trigger=***REMOVED*** [--domain=***REMOVED***' => '',
            'gear module push     <module> --description=' => '',
            'gear module dump     <module> [--json***REMOVED*** [--array***REMOVED***' => '',
            'gear module entities <module>' => '',
            'gear module entity   <module> --entity=' => '',

            //Constructor
            'gear controller create|delete <module> --name= --object= [--service=***REMOVED*** ' => '',
            'gear activity create|delete <module> <parent> --name= [--routeHttp=***REMOVED*** [--routeConsole=***REMOVED*** [--role=***REMOVED*** [--dependency=***REMOVED***' => '',
            'gear src create|delete <module> --type= --name= [--dependency==***REMOVED*** [--extends***REMOVED*** [--db=***REMOVED*** ' => '',
            'gear db create|delete <module> --table= ' => '',
            'gear test create|delete <module> --suite= --target= ' => '',
            'gear view create|delete <module> --target= ' => '',


            //database
            'gear database mysql2sqlite --from= --target=' => '',
            'gear database analyse' => '',
            'gear database analyse table <table>' => '',
            'gear database fix' => '',
            'gear database fix-table' => '',
            'gear database autoincrement' => '',
            'gear database autoincrement table <table>' => '',
            'gear database order' => '',
            'gear database create table <name>' => '',
            'gear database create column  <table> <name> <type> [--limit=***REMOVED*** [--null=***REMOVED***' => '',
            'gear database create constraint <table> <column> <constraintType> <refTable> <refColumn> <updateRule> <deleteRule>' => '',
            'gear database drop table <table>' => '',
            'gear database drop column <table> <name>' => '',
            'gear database drop constraint <table> <column>' => '',
            'gear database mysql load <location>' => '',
            'gear database mysql dump <location> [<name>***REMOVED***' => ''

        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'arrayToYml' => 'Gear\Factory\ArrayToYmlHelperFactory',
                'str' => 'Gear\Factory\StrHelperFactory',
                'getRouteConstraint' => 'Gear\Factory\RouteConstraint'
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
            'Check Mysql is running' => function(){
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
