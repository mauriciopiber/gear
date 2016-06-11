<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;

class AssetManager extends AbstractJsonService implements ModuleManagerInterface
{

    public function module(array $controllers)
    {
        $this->getFileCreator()->createFile(
            'template/module/config/asset.config.phtml',
            array(),
            'asset.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function addAsset($collection, $asset)
    {
        $assetmanager = require $this->getModule()->getConfigExtFolder().'/asset.config.php';

        if (!isset($assetmanager['resolver_configs'***REMOVED***['collections'***REMOVED***[$collection***REMOVED***)) {
            throw new \Exception('Trying to add a collection that not exist yet');
        }

        $assetmanager['resolver_configs'***REMOVED***['collections'***REMOVED***[$collection***REMOVED***[***REMOVED*** = $asset;

        $this->getArrayService()->arrayToFile(
            $this->getModule()->getConfigExtFolder().'/asset.config.php',
            $assetmanager
        );
    }


    public function mergeAssetManagerFromDb($db)
    {

        $this->tableName = $db->getTable();


        $assetmanager = require $this->getModule()->getConfigExtFolder().'/asset.config.php';

        if (!isset($assetmanager['resolver_configs'***REMOVED***)) {
            $assetmanager['resolver_configs'***REMOVED*** = [***REMOVED***;
        }

        $resolverConfigs = $assetmanager['resolver_configs'***REMOVED***;

        if (!isset($resolverConfigs['collections'***REMOVED***)) {
            $assetmanager['resolver_configs'***REMOVED***['collections'***REMOVED*** = [***REMOVED***;
        }

        $collections = $assetmanager['resolver_configs'***REMOVED***['collections'***REMOVED***;

        if (!isset($collections['js/gear-admin.js'***REMOVED***)) {
            $assetmanager['resolver_configs'***REMOVED***['collections'***REMOVED***['js/gear-admin.js'***REMOVED*** = [***REMOVED***;
        }

        $gearAdmin = $assetmanager['resolver_configs'***REMOVED***['collections'***REMOVED***['js/gear-admin.js'***REMOVED***;


        $files = [
            '/js/app/controller/'.$this->tableName.'CreateController.js',
            '/js/app/controller/'.$this->tableName.'EditController.js',
            '/js/app/controller/'.$this->tableName.'ListController.js',
            '/js/app/controller/'.$this->tableName.'ViewController.js',
        ***REMOVED***;


        foreach ($files as $file) {
            if (!in_array($file, $gearAdmin)) {

                $gearAdmin[***REMOVED*** = $file;
            }
        }

        $assetmanager['resolver_configs'***REMOVED***['collections'***REMOVED***['js/gear-admin.js'***REMOVED*** = $gearAdmin;

        $this->getArrayService()->arrayToFile(
            $this->getModule()->getConfigExtFolder().'/asset.config.php',
            $assetmanager
        );
    }
}
