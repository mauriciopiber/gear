<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractService;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

class ZendServiceLocatorService extends AbstractService
{
    public function generate()
    {
        $file = '';

        $file .= $this->getConstructor();
        $file .= $this->getChroot();
        $file .= $this->getFindParentPath();
        $file .= $this->getEntityManager();
        $file .= $this->getGetServiceLocator();
        $file .= $this->getInitAutoloader();

        $class = $this->getClass($file);

        $file = $this->getFile($this->getConfig()->getModule(), $this->getUse(), $class);

        return $file;

    }

    public function getClass($body)
    {
        $class  = $this->powerline(0, 'class ZendServiceLocator');

        $class .= $this->powerline(0, '{');

        $class .= $body;

        $class .= $this->powerline(0, '}');

        return $class;
    }

    public function getUse()
    {
        $use = '';

        $use .= $this->powerline(0, 'use Zend\Loader\AutoloaderFactory;');
        $use .= $this->powerline(0, 'use Zend\Mvc\Service\ServiceManagerConfig;');
        $use .= $this->powerline(0, 'use Zend\ServiceManager\ServiceManager;');
        $use .= $this->powerline(0, 'use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;');

        $use .= PHP_EOL;

        return $use;

    }

    public function getNamespace($namespace)
    {
        return $this->powerline(0, 'namespace %s;', array($namespace)).PHP_EOL;
    }

    public function getFile($namespace, $use, $class)
    {
        $file = $this->getNamespace($namespace);
        $file .= $this->getUse();
        $file .= $class;

        return $file;
    }

    public function getConstructor()
    {
        $phpRenderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();

        $view = new ViewModel(array());
        $view->setTemplate('tests/ZendServiceLocator/construct');

        $template  = $phpRenderer->render($view);
        $template .= PHP_EOL;

        return $template;
    }

    public function getChroot()
    {
        $template = '';

        $template .= $this->powerline(1, 'public function chroot()');
        $template .= $this->powerline(1, '{');
        $template .= $this->powerline(2, '    $rootPath = dirname($this->findParentPath(\'module\'));');
        $template .= $this->powerline(2, '    chdir($rootPath);');
        $template .= $this->powerline(1, '}', array(), true);

        return $template;
    }

    public function getFindParentPath()
    {
        $template = '';

        $template .= $this->powerline(1, 'protected function findParentPath($path)');
        $template .= $this->powerline(1, '{');
        $template .= $this->powerline(2, '    $dir = __DIR__;');
        $template .= $this->powerline(2, '    $previousDir = \'.\';');
        $template .= $this->powerline(2, '    while (! is_dir($dir . \'/\' . $path)) {');
        $template .= $this->powerline(3, '        $dir = dirname($dir);');
        $template .= $this->powerline(3, '        if ($previousDir === $dir) {');
        $template .= $this->powerline(4, '            return false;');
        $template .= $this->powerline(3, '        }');
        $template .= $this->powerline(3, '        $previousDir = $dir;');
        $template .= $this->powerline(2, '    }');
        $template .= $this->powerline(2, '    return $dir . \'/\' . $path;');
        $template .= $this->powerline(1, '}', array(), true);

        return $template;
    }

    public function getEntityManager()
    {
        $template = '';
        $template .= $this->powerline(1, 'public function getEntityManager()');
        $template .= $this->powerline(1, '{');
        $template .= $this->powerline(2, '    if (!isset($this->entityManager)) {');
        $template .= $this->powerline(3, '        $this->entityManager = $this->getServiceLocator()');
        $template .= $this->powerline(3, '        ->get(\'doctrine.entitymanager.orm_default\');');
        $template .= $this->powerline(2, '    }');
        $template .= $this->powerline(2, '    return $this->entityManager;');
        $template .= $this->powerline(1, '}', array(), true);

        return $template;
    }

    public function getGetServiceLocator()
    {
        $template = '';

        $template .= $this->powerline(1, 'public function getServiceLocator()');
        $template .= $this->powerline(1, '{');
        $template .= $this->powerline(2, '    return $this->serviceLocator;');
        $template .= $this->powerline(1, '}', array(), true);

        $template .= $this->powerline(1, 'public function setServiceLocator(ServiceLocatorInterface $serviceLocator)');
        $template .= $this->powerline(1, '{');
        $template .= $this->powerline(2, '    if (!isset($this->serviceLocator)) {');
        $template .= $this->powerline(3, '        $this->serviceLocator = $serviceLocator;');
        $template .= $this->powerline(2, '    }');
        $template .= $this->powerline(2, '    return $this->serviceLocator;');
        $template .= $this->powerline(1, '}', array(), true);

        return $template;
    }

    public function getInitAutoloader()
    {

        $template = '';

        $template .= $this->powerline(1, 'protected function initAutoloader()');
        $template .= $this->powerline(1, '{');
        $template .= $this->powerline(2, '    $vendorPath = $this->findParentPath(\'vendor\');');
        $template .= PHP_EOL;
        $template .= $this->powerline(2, '    $zf2Path = getenv(\'ZF2_PATH\');');
        $template .= PHP_EOL;
        $template .= $this->powerline(2, '    if (! $zf2Path) {');
        $template .= $this->powerline(3, '        if (defined(\'ZF2_PATH\')) {');
        $template .= $this->powerline(4, '            $zf2Path = ZF2_PATH;');
        $template .= $this->powerline(3, '        } elseif (is_dir($vendorPath . \'/ZF2/library\')) {');
        $template .= $this->powerline(4, '            $zf2Path = $vendorPath . \'/ZF2/library\';');
        $template .= $this->powerline(3, '        } elseif (is_dir($vendorPath . \'/zendframework/zendframework/library\')) {');
        $template .= $this->powerline(4, '            $zf2Path = $vendorPath . \'/zendframework/zendframework/library\';');
        $template .= $this->powerline(3, '        }');
        $template .= $this->powerline(2, '    }');
        $template .= PHP_EOL;
        $template .= $this->powerline(2, '    if (! $zf2Path) {');
        $template .= $this->powerline(3, '        throw new RuntimeException(');
        $template .= $this->powerline(4, '            \'Unable to load ZF2. Run `php composer.phar install` or\' . \' define a ZF2_PATH environment variable.\'');
        $template .= $this->powerline(3, '        );');
        $template .= $this->powerline(2, '    }');
        $template .= PHP_EOL;
        $template .= $this->powerline(2, '    if (file_exists($vendorPath . \'/autoload.php\')) {');
        $template .= $this->powerline(3, '        include $vendorPath . \'/autoload.php\';');
        $template .= $this->powerline(2, '    }');
        $template .= $this->powerline(2, '    include $zf2Path . \'/Zend/Loader/AutoloaderFactory.php\';');
        $template .= PHP_EOL;
        $template .= $this->powerline(2, '    AutoloaderFactory::factory(array(');
        $template .= $this->powerline(3, '        \'Zend\Loader\StandardAutoloader\' => array(');
        $template .= $this->powerline(4, '            \'autoregister_zf\' => true,');
        $template .= $this->powerline(4, '            \'namespaces\' => array(');
        $template .= $this->powerline(5, '                __NAMESPACE__ => __DIR__ . \'/\' . __NAMESPACE__');
        $template .= $this->powerline(4, '            )');
        $template .= $this->powerline(3, '        )');
        $template .= $this->powerline(2, '    ));');
        $template .= $this->powerline(1, '}');

        return $template;
    }
}
