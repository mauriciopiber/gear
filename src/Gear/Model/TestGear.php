<?php

namespace Gear\Model;

class TestGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function initTest($path)
    {

        $this->mkPHP($path, 'Bootstrap',$this->getBootstrap($this->getModule()));

        $this->mkXML($path, 'phpunit',$this->getPHPUnitXml($this->getModule()));
    }

    public function getPHPUnitXml($module)
    {
        $b = '';
        $b .= $this->getIndent(0).trim('<phpunit bootstrap="Bootstrap.php" colors="true">').PHP_EOL;
        $b .= $this->getIndent(1).trim('<testsuites>').PHP_EOL;
        $b .= $this->getIndent(2).trim('<testsuite name="furianetwork">').PHP_EOL;
        $b .= $this->getIndent(3).trim('<directory>./</directory>').PHP_EOL;
        $b .= $this->getIndent(2).trim('</testsuite>').PHP_EOL;
        $b .= $this->getIndent(1).trim('</testsuites>').PHP_EOL;
        $b .= $this->getIndent(0).trim('</phpunit>').PHP_EOL;

        return $b;
    }

    public function getBootstrap($module)
    {
        $b = '';
        $b .= $this->getIndent(0).trim("namespace ".$module."Test;").PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(0).trim("use Zend\Loader\AutoloaderFactory;").PHP_EOL;
        $b .= $this->getIndent(0).trim("use Zend\Mvc\Service\ServiceManagerConfig;").PHP_EOL;
        $b .= $this->getIndent(0).trim("use Zend\ServiceManager\ServiceManager;").PHP_EOL;
        $b .= $this->getIndent(0).trim("use RuntimeException;").PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(0).trim("error_reporting(E_ALL | E_STRICT);").PHP_EOL;
        $b .= $this->getIndent(0).trim("chdir(__DIR__);").PHP_EOL;

        $b .= $this->getIndent(0).trim("/**").PHP_EOL;
        $b .= $this->getIndent(0).trim(" * Test bootstrap, for setting up autoloading").PHP_EOL;
        $b .= $this->getIndent(0).trim("*/").PHP_EOL;
        $b .= $this->getIndent(0).trim("class Bootstrap").PHP_EOL;
        $b .= $this->getIndent(0).trim("{").PHP_EOL;
        $b .= $this->getIndent(1).trim('    protected static $serviceManager;').PHP_EOL;

        $b .= $this->getIndent(1).trim("    public static function init()").PHP_EOL;
        $b .= $this->getIndent(1).trim("    {").PHP_EOL;
        $b .= $this->getIndent(2).trim('        $zf2ModulePaths = array(dirname(dirname(__DIR__)));').PHP_EOL;
        $b .= $this->getIndent(2).trim('        if (($path = static::findParentPath(\'vendor\'))) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('            $zf2ModulePaths[***REMOVED*** = $path;').PHP_EOL;
        $b .= $this->getIndent(2).trim("        }").PHP_EOL;
        $b .= $this->getIndent(2).trim('        if (($path = static::findParentPath(\'module\')) !== $zf2ModulePaths[0***REMOVED***) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('           $zf2ModulePaths[***REMOVED*** = $path;').PHP_EOL;
        $b .= $this->getIndent(2).trim("        }").PHP_EOL;

        $b .= $this->getIndent(2).trim("        static::initAutoloader();").PHP_EOL;

        $b .= $this->getIndent(2).trim('        // use ModuleManager to load this module and it\'s dependencies').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $config = array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('            \'module_listener_options\' => array(').PHP_EOL;
        $b .= $this->getIndent(4).trim('                \'module_paths\' => $zf2ModulePaths,').PHP_EOL;
        $b .= $this->getIndent(3).trim('            ),').PHP_EOL;
        $b .= $this->getIndent(3).trim('            \'modules\' => array(').PHP_EOL;
        $b .= $this->getIndent(4).trim(' \'DoctrineModule\',').PHP_EOL;
        $b .= $this->getIndent(4).trim(' \'DoctrineORMModule\',').PHP_EOL;
        $b .= $this->getIndent(4).trim('                \''.$module.'\'').PHP_EOL;
        $b .= $this->getIndent(3).trim('            )').PHP_EOL;
        $b .= $this->getIndent(2).trim('        );').PHP_EOL;

        $b .= $this->getIndent(2).trim('        $serviceManager = new ServiceManager(new ServiceManagerConfig());').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $serviceManager->setService(\'ApplicationConfig\', $config);').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $serviceManager->get(\'ModuleManager\')->loadModules();').PHP_EOL;

        $b .= $this->getIndent(2).trim('        static::$serviceManager = $serviceManager;').PHP_EOL;
        $b .= $this->getIndent(1).trim('    }').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).trim('   public static function chroot()').PHP_EOL;
        $b .= $this->getIndent(1).trim('    {').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $rootPath = dirname(static::findParentPath(\'module\'));').PHP_EOL;
        $b .= $this->getIndent(2).trim('        chdir($rootPath);').PHP_EOL;
        $b .= $this->getIndent(1).trim('    }').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).trim('    public static function getServiceManager()').PHP_EOL;
        $b .= $this->getIndent(1).trim('    {').PHP_EOL;
        $b .= $this->getIndent(2).trim('        return static::$serviceManager;').PHP_EOL;
        $b .= $this->getIndent(1).trim('    }').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).trim('    protected static function initAutoloader()').PHP_EOL;
        $b .= $this->getIndent(1).trim('    {').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $vendorPath = static::findParentPath(\'vendor\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $zf2Path = getenv(\'ZF2_PATH\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('        if (!$zf2Path) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('            if (defined(\'ZF2_PATH\')) {').PHP_EOL;
        $b .= $this->getIndent(4).trim('                $zf2Path = ZF2_PATH;').PHP_EOL;
        $b .= $this->getIndent(3).trim('            } elseif (is_dir($vendorPath . \'/ZF2/library\')) {').PHP_EOL;
        $b .= $this->getIndent(4).trim('                $zf2Path = $vendorPath . \'/ZF2/library\';').PHP_EOL;
        $b .= $this->getIndent(3).trim('            } elseif (is_dir($vendorPath . \'/zendframework/zendframework/library\')) {').PHP_EOL;
        $b .= $this->getIndent(4).trim('                $zf2Path = $vendorPath . \'/zendframework/zendframework/library\';').PHP_EOL;
        $b .= $this->getIndent(3).trim('            }').PHP_EOL;
        $b .= $this->getIndent(2).trim('        }').PHP_EOL;

        $b .= $this->getIndent(2).trim('        if (!$zf2Path) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('            throw new RuntimeException(').PHP_EOL;
        $b .= $this->getIndent(4).trim('                    \'Unable to load ZF2. Run `php composer.phar install` or\'').PHP_EOL;
        $b .= $this->getIndent(4).trim('                    . \' define a ZF2_PATH environment variable.\'').PHP_EOL;
        $b .= $this->getIndent(3).trim('            );').PHP_EOL;
        $b .= $this->getIndent(2).trim('        }').PHP_EOL;

        $b .= $this->getIndent(2).trim('        if (file_exists($vendorPath . \'/autoload.php\')) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('            include $vendorPath . \'/autoload.php\';').PHP_EOL;
        $b .= $this->getIndent(2).trim('        }').PHP_EOL;

        $b .= $this->getIndent(2).trim('        include $zf2Path . \'/Zend/Loader/AutoloaderFactory.php\';').PHP_EOL;
        $b .= $this->getIndent(2).trim('        AutoloaderFactory::factory(array(').PHP_EOL;
        $b .= $this->getIndent(3).trim('        \'Zend\Loader\StandardAutoloader\' => array(').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'autoregister_zf\' => true,').PHP_EOL;
        $b .= $this->getIndent(4).trim('        \'namespaces\' => array(').PHP_EOL;
        $b .= $this->getIndent(5).trim('        __NAMESPACE__ => __DIR__ . \'/\' . __NAMESPACE__,').PHP_EOL;
        $b .= $this->getIndent(4).trim('        ),').PHP_EOL;
        $b .= $this->getIndent(3).trim('       ),').PHP_EOL;
        $b .= $this->getIndent(2).trim('       ));').PHP_EOL;
        $b .= $this->getIndent(1).trim('    }').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).trim('    protected static function findParentPath($path)').PHP_EOL;
        $b .= $this->getIndent(1).trim('    {').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $dir = __DIR__;').PHP_EOL;
        $b .= $this->getIndent(2).trim('        $previousDir = \'.\';').PHP_EOL;
        $b .= $this->getIndent(2).trim('        while (!is_dir($dir . \'/\' . $path)) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('            $dir = dirname($dir);').PHP_EOL;
        $b .= $this->getIndent(3).trim('            if ($previousDir === $dir) {').PHP_EOL;
        $b .= $this->getIndent(4).trim('                return false;').PHP_EOL;
        $b .= $this->getIndent(3).trim('            }').PHP_EOL;
        $b .= $this->getIndent(3).trim('           $previousDir= $dir;').PHP_EOL;
        $b .= $this->getIndent(2).trim('        }').PHP_EOL;
        $b .= $this->getIndent(2).trim('        return $dir . \'/\' . $path;').PHP_EOL;
        $b .= $this->getIndent(1).trim('    }').PHP_EOL;

        $b .= $this->getIndent(0).trim('}').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(0).trim('Bootstrap::init();').PHP_EOL;
        $b .= $this->getIndent(0).trim('Bootstrap::chroot();').PHP_EOL;

        return $b;
    }
}
