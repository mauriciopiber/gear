<?php
namespace GearTest;

// This is global bootstrap for autoloading
use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZendServiceLocator
{
    protected $serviceLocator;
    protected $entityManager;

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

        $env = getenv('APP_ENV') ?  : 'testing';

        $applicationConfig = include \GearBase\Module::getProjectFolder().'/config/application.config.php';

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
        require_once \GearBase\Module::getProjectFolder().'/vendor/autoload.php';

    }

    public function getApplicationConfig()
    {

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

    public function getEntityManager()
    {
        if (!isset($this->entityManager)) {
            $this->entityManager = $this->getServiceLocator()
            ->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
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
}
