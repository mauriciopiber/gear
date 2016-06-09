<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectLocationTrait;
use Gear\Edge\ComposerEdgeTrait;
use Gear\Util\Prompt\ConsolePromptTrait;

class ComposerUpgrade extends AbstractJsonService implements ModuleUpgradeInterface
{
    use ProjectLocationTrait;

    use ComposerEdgeTrait;

    use ConsolePromptTrait;

    static public $shouldAdd = 'Deve adicionar o package %s na versão %s em %s?';

    static public $shouldVersion = 'Deve alterar a versão do package %s da versão %s para versão %s em %s?';

    static public $added = 'Adicionado package %s na versão %s em %s';

    static public $version = 'Alterado versão do package %s de %s para %s em %s';

    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        $composer = $this->getComposerEdge()->getComposerModule($type);

        $dir = $this->getModule()->getMainFolder();

        $moduleComposer = \Zend\Json\Json::decode(file_get_contents($dir.'/composer.json'), 1);

        $newComposer = $this->upgrade($composer, $moduleComposer);

        $json = str_replace('\/', '/', json_encode($newComposer, JSON_UNESCAPED_UNICODE));
        file_put_contents($dir.'/composer.json', \Zend\Json\Json::prettyPrint($json, 1));

        return $this->upgrades;
    }

    public function upgradeProject($type = 'web')
    {
        return true;
    }



    public function upgradePackage()
    {

    }

    public function upgrade($edge, $file)
    {
        foreach ($edge['require'***REMOVED*** as $require => $version) {

            if (!array_key_exists($require, $file['require'***REMOVED***)) {

                $confirm = $this->getConsolePrompt()->show(
                    sprintf(
                        static::$shouldAdd,
                        $require,
                        $version,
                        'require'
                    )
                );

                if ($confirm === false) {
                    continue;
                }

                $file['require'***REMOVED***[$require***REMOVED*** = $version;
                $this->upgrades[***REMOVED*** = sprintf(static::$added, $require, $version, 'require');
                continue;
            }

            if ($file['require'***REMOVED***[$require***REMOVED*** !== $version) {

                $confirm = $this->getConsolePrompt()->show(
                    sprintf(
                        static::$shouldVersion,
                        $require,
                        $file['require'***REMOVED***[$require***REMOVED***,
                        $version,
                        'require'
                    )
                );

                if ($confirm === false) {
                    continue;
                }

                $oldVersion = $file['require'***REMOVED***[$require***REMOVED***;
                $file['require'***REMOVED***[$require***REMOVED*** = $version;
                $this->upgrades[***REMOVED*** = sprintf(static::$version, $require, $oldVersion, $version, 'require');
            }
        }

        foreach ($edge['require-dev'***REMOVED*** as $require => $version) {

            if (!array_key_exists($require, $file['require-dev'***REMOVED***)) {

                $confirm = $this->getConsolePrompt()->show(
                    sprintf(
                        static::$shouldAdd,
                        $require,
                        $version,
                        'require-dev'
                    )
                );

                if ($confirm === false) {
                    continue;
                }

                $this->upgrades[***REMOVED*** = sprintf(static::$added, $require, $version, 'require-dev');
                $file['require-dev'***REMOVED***[$require***REMOVED*** = $version;
                continue;
            }

            if ($file['require-dev'***REMOVED***[$require***REMOVED*** !== $version) {

                $confirm = $this->getConsolePrompt()->show(
                    sprintf(
                        static::$shouldVersion,
                        $require,
                        $file['require-dev'***REMOVED***[$require***REMOVED***,
                        $version,
                        'require-dev'
                    )
                );

                if ($confirm === false) {
                    continue;
                }

                $oldVersion = $file['require-dev'***REMOVED***[$require***REMOVED***;
                $file['require-dev'***REMOVED***[$require***REMOVED*** = $version;
                $this->upgrades[***REMOVED*** = sprintf(static::$version, $require, $oldVersion, $version, 'require-dev');
            }
        }

        return $file;
    }
}
