<?php
namespace PiberNetwork;

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ZendServiceLocator
{
    public function __construct()
    {
        $this->chroot();

        $zf2ModulePaths = array(
            dirname(dirname(realpath(__DIR__ . '/../../')))
        );

        if (($path = $this->findParentPath('vendor'))) {
            $zf2ModulePaths[***REMOVED*** = $path;
        }

        if (($path = $this->findParentPath('module')) !== $zf2ModulePaths[0***REMOVED***) {
            $zf2ModulePaths[***REMOVED*** = $path;
        }

        $this->initAutoloader();

        $env = getenv('APP_ENV') ?  : 'testing';

        $applicationConfig = include __DIR__.'/../../../config/application.config.php';

        $config = array(
            'module_listener_options' => array(
                'module_paths' => $zf2ModulePaths,
                'config_glob_paths' => array(
                    sprintf('config/autoload/{,*.}{global,%s,local}.php', $env)
                )
            ),
            'modules' => $applicationConfig['modules'***REMOVED***
        );


        $serviceLocator = new ServiceManager(new ServiceManagerConfig());
        $serviceLocator->setService('ApplicationConfig', $config);
        $serviceLocator->get('ModuleManager')->loadModules();
        $this->serviceLocator = $serviceLocator;
    }

    public function chroot()
    {
        $rootPath = dirname($this->findParentPath('module'));
        chdir($rootPath);
    }

    protected function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (! is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }

    public function getEntityManager()
    {
        if (!isset($this->entityManager)) {
            $this->entityManager = $this->getServiceLocator()
            ->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        if (!isset($this->serviceLocator)) {
            $this->serviceLocator = $serviceLocator;
        }
        return $this->serviceLocator;
    }

    protected function initAutoloader()
    {
        $vendorPath = $this->findParentPath('vendor');

        $zf2Path = getenv('ZF2_PATH');

        if (! $zf2Path) {
            if (defined('ZF2_PATH')) {
                $zf2Path = ZF2_PATH;
            } elseif (is_dir($vendorPath . '/ZF2/library')) {
                $zf2Path = $vendorPath . '/ZF2/library';
            } elseif (is_dir($vendorPath . '/zendframework/zendframework/library')) {
                $zf2Path = $vendorPath . '/zendframework/zendframework/library';
            }
        }

        if (! $zf2Path) {
            throw new RuntimeException(
                'Unable to load ZF2. Run `php composer.phar install` or' . ' define a ZF2_PATH environment variable.'
            );
        }

        if (file_exists($vendorPath . '/autoload.php')) {
            include $vendorPath . '/autoload.php';
        }
        include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';

        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true,
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__
                )
            )
        ));
    }
}
