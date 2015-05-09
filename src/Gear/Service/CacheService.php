<?php
namespace Gear\Service;

use Gear\Service\AbstractService;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class CacheService extends AbstractService
{

    public function renewFileCache()
    {
        $dataFile = \GearBase\Module::getProjectFolder().'/data/cache/configcache';

        if (is_dir($dataFile)) {
            foreach (glob($dataFile."/*") as $file) {
                unlink($file);
            }
        }
        return true;
    }

    public function renewMemcached()
    {
        $script = realpath(__DIR__.'/../../../script/utils/clear-memcached.sh');
        $scriptRunner = $this->getServiceLocator()->get('scriptService');

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
