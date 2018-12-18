<?php
namespace Gear\Cache;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Locator\ModuleLocatorTrait;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class CacheService implements ServiceLocatorAwareInterface
{
    use DirServiceTrait;

    use ModuleLocatorTrait;

    protected $request;

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

    use ServiceLocatorAwareTrait;

    /**
     * @cautions
     */
    public function renewFileCache()
    {
        $dataFile = $this->getModuleFolder().'/data/cache/configcache';

        if (is_dir($dataFile)) {
            foreach (glob($dataFile."/*") as $file) {
                unlink($file);
            }
        }

        $dataFile = $this->getModuleFolder().'/data/DoctrineORMModule/Proxy';

        if (is_dir($dataFile)) {
            foreach (glob($dataFile."/*") as $file) {
                unlink($file);
            }
        }

        $dataFile = $this->getModuleFolder().'/data/DoctrineModule/cache';

        if (is_dir($dataFile)) {
            foreach (glob($dataFile."/*") as $file) {
                if (is_dir($file)) {
                    $this->getDirService()->rmDir($file);
                }
            }
        }
        return true;
    }

    public function renewMemcached()
    {
        $script = realpath(__DIR__.'/../../bin/memcached');
        $scriptRunner = $this->getServiceLocator()->get('scriptService');
        $scriptRunner->setLocation($this->getModuleFolder());
        echo $scriptRunner->run($script);
        return true;
    }

    public function renewCache()
    {
        $data = $this->getRequest()->getParam('data');

        if ($data) {
            $this->renewFileCache();
        }

        $memcached = $this->getRequest()->getParam('memcached');

        if ($memcached) {
            $this->renewMemcached();
        }

        return true;
    }
}
