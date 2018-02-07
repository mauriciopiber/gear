<?php
namespace Gear\Cache;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use GearBase\RequestTrait;
use GearBase\Util\Dir\DirServiceTrait;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class CacheService implements ServiceLocatorAwareInterface
{
    use DirServiceTrait;

    use RequestTrait;

    use ServiceLocatorAwareTrait;

    /**
     * @cautions
     */
    public function renewFileCache()
    {
        $dataFile = \GearBase\Module::getProjectFolder().'/data/cache/configcache';

        if (is_dir($dataFile)) {
            foreach (glob($dataFile."/*") as $file) {
                unlink($file);
            }
        }

        $dataFile = \GearBase\Module::getProjectFolder().'/data/DoctrineORMModule/Proxy';

        if (is_dir($dataFile)) {
            foreach (glob($dataFile."/*") as $file) {
                unlink($file);
            }
        }

        $dataFile = \GearBase\Module::getProjectFolder().'/data/DoctrineModule/cache';

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
        $scriptRunner->setLocation(\GearBase\Module::getProjectFolder());
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
