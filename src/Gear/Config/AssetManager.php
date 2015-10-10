<?php
namespace Gear\Config;

use Gear\Service\AbstractJsonService;
use Gear\ValueObject\BasicModuleStructure;

class AssetManager extends AbstractJsonService {

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


        $assetText = var_export($assetmanager, true);

        $assetText = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', $assetText);


        $assetText = str_replace('\''.$this->getModule()->getConfigExtFolder(), '__DIR__.\'', $assetText);


        file_put_contents($this->getModule()->getConfigExtFolder().'/asset.config.php', '<?php return ' . $assetText . '; ?>');
    }

}
