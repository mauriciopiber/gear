<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;

class ComposerUpgrade extends AbstractJsonService implements ModuleUpgradeInterface
{
    use \Gear\Edge\ComposerEdgeTrait;

    public function upgradeModule($type = 'web')
    {
        $composer = $this->getComposerEdge()->getComposerModule($type);

        $dir = $this->getModule()->getMainFolder();

        $moduleComposer = \Zend\Json\Json::decode(file_get_contents($dir.'/composer.json'), 1);

        $newComposer = $this->upgrade($composer, $moduleComposer);

        $json = str_replace('\/', '/', json_encode($newComposer, JSON_UNESCAPED_UNICODE));
        file_put_contents($dir.'/composer.json', \Zend\Json\Json::prettyPrint($json, 1));

        return true;
    }

    public function upgradeProject($type = 'web')
    {
        return true;
    }

    public function upgrade($edge, $file)
    {
        foreach ($edge['require'***REMOVED*** as $require => $version) {

            if (!array_key_exists($require, $file['require'***REMOVED***)) {
                $file['require'***REMOVED***[$require***REMOVED*** = $version;
                continue;
            }

            if ($file['require'***REMOVED***[$require***REMOVED*** !== $version) {
                $file['require'***REMOVED***[$require***REMOVED*** = $version;
            }
        }

        foreach ($edge['require-dev'***REMOVED*** as $require => $version) {

            if (!array_key_exists($require, $file['require-dev'***REMOVED***)) {
                $file['require-dev'***REMOVED***[$require***REMOVED*** = $version;
                continue;
            }

            if ($file['require-dev'***REMOVED***[$require***REMOVED*** !== $version) {
                $file['require-dev'***REMOVED***[$require***REMOVED*** = $version;
            }
        }

        return $file;
    }
}
