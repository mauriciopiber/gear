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

    }

    public function renewCache()
    {
        $data = $this->getRequest()->getParam('data');

        if ($data) {
            $this->renewFileCache();
        }
    }
}
