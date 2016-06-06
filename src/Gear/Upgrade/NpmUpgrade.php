<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\NpmEdgeTrait;

class NpmUpgrade extends AbstractJsonService
{
    use NpmEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    static public $version = 'Alterado package %s da versão %s para versão %s';

    static public $added = 'Adicionado package %s com versão %s';

    static public $shouldVersion = 'Deve alterar a versão do package %s de %s para %s?';

    static public $shouldAdd = 'Deve adicionar o package %s na versão %s?';

    public function __construct($console, $consolePrompt, $module = null)
    {
        $this->console = $console;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
        //$this->stringService = $string;
    }



    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        if (!in_array($type, ['web'***REMOVED***)) {
            return $this->upgrades;
        }

        $edge = $this->getNpmEdge()->getNpmModule($type);

        if (!isset($edge['devDependencies'***REMOVED***)) {
            return $this->upgrades;
        }

        $dir = $this->getModule()->getMainFolder();

        $npmModule = \Zend\Json\Json::decode(file_get_contents($dir.'/package.json'), 1);

        $newNpm = $this->upgrade($edge, $npmModule);

        $json = str_replace('\/', '/', json_encode($newNpm, JSON_UNESCAPED_UNICODE));
        file_put_contents($dir.'/package.json', \Zend\Json\Json::prettyPrint($json, 1));


        return $this->upgrades;
    }

    public function upgrade($edge, $file)
    {
        $this->upgrades = [***REMOVED***;

        foreach ($edge['devDependencies'***REMOVED*** as $dependency => $version) {


            if (!array_key_exists($dependency, $file['devDependencies'***REMOVED***)) {

                $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldAdd, $dependency, $version));

                if ($confirm === false) {
                    continue;
                }

                $file['devDependencies'***REMOVED***[$dependency***REMOVED*** = $version;

                $this->upgrades[***REMOVED*** = sprintf(static::$added, $dependency, $version);
                continue;
            }

            if (
                array_key_exists($dependency, $file['devDependencies'***REMOVED***)
                && $file['devDependencies'***REMOVED***[$dependency***REMOVED*** !== $version
            ) {

                $confirm = $this->getConsolePrompt()->show(
                    sprintf(
                        static::$shouldVersion,
                        $dependency,
                        $file['devDependencies'***REMOVED***[$dependency***REMOVED***,
                        $version
                    )
                );

                if ($confirm === false) {
                    continue;
                }

                $old = $file['devDependencies'***REMOVED***[$dependency***REMOVED***;

                $file['devDependencies'***REMOVED***[$dependency***REMOVED*** = $version;

                $this->upgrades[***REMOVED*** = sprintf(static::$version, $dependency, $old, $version);

                continue;
            }
        }

        ksort($file['devDependencies'***REMOVED***);

        return $file;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
