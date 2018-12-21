<?php
namespace Gear;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use ZendDiagnostics\Check\DirWritable;
use ZendDiagnostics\Check\ExtensionLoaded;
use ZendDiagnostics\Check\ProcessRunning;
use ZendDiagnostics\Check\PhpVersion;
use ZendDiagnostics\Check\CpuPerformance;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Module implements
    ConsoleUsageProviderInterface,
    ConsoleBannerProviderInterface,
    ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $moduleManager;

    const LOCATION = __DIR__;

    /**
     * Set Console Banner
     *
     * @param Console $console
     *
     * @return string
     */
    public function getConsoleBanner(Console $console)
    {
        unset($console);
        $version = require __DIR__.'/../config/module.config.php';

        $banner = sprintf(
            'Gear - v%s - Poderoso Gear.',
            $version['gear'***REMOVED***['modules'***REMOVED***['gear'***REMOVED***['version'***REMOVED***
        );

        return $banner;
    }

    /**
     * Set Module Manager
     *
     * @param ModuleManager $moduleManager
     *
     * @return \Gear\Module
     */
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
                    foreach ($config['data-fixture'***REMOVED*** as $location) {
                        $merge[$moduleName***REMOVED*** = $location;
                    }
                }
            }
        }
        $service = $event->getTarget();
        $service->setLoadedFixtures($merge);
    }

    public function loadModules($event)
    {
        $service = $event->getTarget();
        $service->setLoadedModules($this->getModuleManager()->getLoadedModules());
    }

    public function setUpGearAdmin()
    {
        $loadedModules = $this->getModuleManager()->getLoadedModules();
        $loadedModules      = array_keys($loadedModules);
        if (!in_array('GearAdmin', $loadedModules)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'GearAdmin need to be loaded to run'
                )
            );
        }
    }



    public function onBootstrap(MvcEvent $event)
    {
        $application = $event->getApplication();

        $serviceManager = $event->getApplication()->getServiceManager();
        $this->setServiceLocator($serviceManager);
        // get the shared events manager
        $sharedManager = $application->getEventManager()->getSharedManager();

        $sharedManager->attach(
            'Zend\Mvc\Controller\AbstractActionController',
            'dispatch',
            function ($event) use ($serviceManager) {
                $controller = $event->getTarget();
                $controller->getEventManager()->attachAggregate($serviceManager->get('SchemaListener'));
            },
            2
        );

        $sharedManager->attach(
            '*',
            'init',
            function ($event) use ($serviceManager) {

                $controller = $event->getTarget();
                $controller->getEventManager()->attachAggregate($serviceManager->get('SchemaListener'));
            },
            2
        );
    }

    public function init(ModuleManager $moduleManager)
    {
        $this->setModuleManager($moduleManager);
        $eventManager = $moduleManager->getEventManager();
        $shareManager = $eventManager->getSharedManager();
        $shareManager->attach('Gear\Mvc\Entity\EntityService', 'loadModules', [$this, 'loadModules'***REMOVED***);
        $shareManager->attach('Gear\Mvc\Fixture\FixtureService', 'loadFixtures', [$this, 'loadFixtures'***REMOVED***);
    }

    public function getConsoleUsage(Console $console)
    {
        unset($console);
        return [
            //Module
            'Module',
            'gear module fixture  <module> [--append***REMOVED*** [--reset-increment***REMOVED***' => '',
            'gear module delete   <module>' => '',
            'gear module load     <module> [--before=***REMOVED*** [--after=***REMOVED***' => '',
            'gear module unload   <module>' => '',
            'gear module build    <module> [--trigger=***REMOVED*** [--domain=***REMOVED***' => '',
            'gear module push     <module> --description=' => '',
            'gear module dump     <module> [--json***REMOVED*** [--array***REMOVED***' => '',
            'gear module entities <module>' => '',
            'gear module entity   <module> --entity=' => '',
            'gear module create <module> <basepath> [--type=***REMOVED*** [--force***REMOVED*** [--staging=***REMOVED*** [--namespace***REMOVED***' => '',
            'gear module construct <module> [<basepath>***REMOVED*** [--file=***REMOVED***' => '',

            'Module/Constructor',
            'gear module controller create' => 'Criar Controller',

            ['<module>', 'Required', 'Módulo'***REMOVED***,
            ['<basepath>', 'Optional', 'Localização do Módulo'***REMOVED***,
            ['--name=', 'Required', 'Nome do Controller'***REMOVED***,
            ['--service=', 'Required', 'Tipo do Servico, invokables ou factory.'***REMOVED***,
            ['--extends=', 'Optional', ''***REMOVED***,
            ['--type=', 'Optional', ''***REMOVED***,
            ['--namespace=', 'Optional', ''***REMOVED***,
            ['--db=', 'Optional', ''***REMOVED***,
            ['--columns', 'Optional', ''***REMOVED***,

            'gear module activity create' => 'Criar Action',

            ['<module>', 'Required', ''***REMOVED***,
            ['<basepath>', 'Optional', ''***REMOVED***,
            ['<parent>', 'Required', ''***REMOVED***,
            ['--name=', 'Required', ''***REMOVED***,
            ['--template=', 'Optional', ''***REMOVED***,
            ['--route=***REMOVED***', 'Optional', ''***REMOVED***,
            ['--role=***REMOVED***', 'Optional', ''***REMOVED***,
            ['--dependency=***REMOVED***', 'Optional', ''***REMOVED***,


            'gear module app create|delete' => 'Criar App',
            ['<module>', 'Required', ''***REMOVED***,
            ['<basepath>', 'Optional', ''***REMOVED***,
            ['--type=', 'Required', ''***REMOVED***,
            ['--name=', 'Required', ''***REMOVED***,
            ['--namespace=', 'Optional', ''***REMOVED***,
            ['--db=', 'Optional', ''***REMOVED***,

            'gear module src create|delete' => 'Criar Src',
            ['<module>', 'Required', ''***REMOVED***,
            ['<basepath>', 'Optional', ''***REMOVED***,
            ['--type=', 'Required', ''***REMOVED***,
            ['--name=', 'Required', ''***REMOVED***,
            ['--namespace=', 'Optional', ''***REMOVED***,
            ['--service=', 'Optional', ''***REMOVED***,
            ['--template=', 'Optional', ''***REMOVED***,
            ['--abstract', 'Optional', ''***REMOVED***,
            ['--dependency=', 'Optional', ''***REMOVED***,
            ['--extends=', 'Optional', ''***REMOVED***,
            ['--db=', 'Optional', ''***REMOVED***,
            ['--columns=', 'Optional', ''***REMOVED***,


            'gear module db create|delete' => 'Criar Mvc',
            ['<module>', 'Required', ''***REMOVED***,
            ['[<basepath>***REMOVED***', 'Optional', ''***REMOVED***,
            ['--table=', 'Required', ''***REMOVED***,
            ['[--user=***REMOVED***', 'Optional', ''***REMOVED***,
            ['[--default-role=***REMOVED***', 'Optional', ''***REMOVED***,
            ['[--columns=***REMOVED***', 'Optional', ''***REMOVED***,

            'gear module dump-autoload <module>' => '',

            //database
            'Database',
            'gear database migration create [<module>***REMOVED*** [<name>***REMOVED***' => 'Criar Migration',
            'gear database mock <module> <table>' => 'Cria Mocks para Testes Unitários',
            'gear database clear table <table>' => 'Trunca tabela',
            'gear database autoincrement' => '',
            'gear database autoincrement table <table>' => '',
            'gear database load <location>' => 'Carrega banco em determinada localização',
            'gear database dump <location> [<name>***REMOVED***' => 'Coloca banco em determinado lugar',
            'gear database module dump <module>' => '',
            'gear database module load <module>' => '',
            'gear database project dump' => '',
            'gear database project load' => '',
            'gear database analyse' => '',
            'gear database analyse table <table>' => '',
            'gear database fix' => '',
            'gear database fix table <table>' => '',

            'Cache',
            'gear cache renew --data' => '',
            'gear cache renew --memcached' => ''

        ***REMOVED***;
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/../autoload_classmap.php',
            ***REMOVED***,
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/../src/' . __NAMESPACE__,
                ***REMOVED***,
            ***REMOVED***,
        ***REMOVED***;
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getLocation()
    {
        return __DIR__;
    }

    public function getDiagnostics()
    {
        return [
            'Cache & Log Directories Available' => function () {
                $folder = \Gear\ValueObject\Project::getStaticFolder();
                $diagnostic = new DirWritable([
                    $folder . '/data/cache',
                    $folder . '/data/logs',
                    __DIR__ . '/Entity',
                ***REMOVED***);
                return $diagnostic->check();
            },
            'Check PHP extensions' => function () {
                $diagnostic = new ExtensionLoaded([
                    'json',
                    'pdo',
                    'pdo_mysql',
                    'intl',
                ***REMOVED***);
                return $diagnostic->check();
            },
            'Check Apache is running' => function () {
                $diagnostic = new ProcessRunning('apache2');
                return $diagnostic->check();
            },
            'CPU Performance' => function () {
                $diagnostic = new CpuPerformance(0.5);
                return $diagnostic->check();
            },
            'Check Mysql is running' => function () {
                $diagnostic = new ProcessRunning('mysql');
                return $diagnostic->check();
            },
            'Check PHP Version' => function () {
                $diagnostic = new PhpVersion('5.5.0', '>=');
                return $diagnostic->check();
            }
        ***REMOVED***;
    }
}
