<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\NpmEdgeTrait;
use Gear\Project\ProjectLocationTrait;

class NpmUpgrade extends AbstractJsonService
{
    use ProjectLocationTrait;

    use NpmEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    static public $shouldFile = 'Nodejs - Você quer criar o arquivo package.json?';

    static public $fileCreated = 'Nodejs - Arquivo package.json criado';


    static public $version = 'Nodejs - Alterado package %s da versão %s para versão %s';

    static public $added = 'Nodejs - Adicionado package %s com versão %s';

    static public $shouldVersion = 'Nodejs - Deve alterar a versão do package %s de %s para %s?';

    static public $shouldAdd = 'Nodejs - Deve adicionar o package %s na versão %s?';

    public $config;

    public function __construct($console, $consolePrompt, $config, $module = null)
    {
        $this->console = $console;
        $this->module = $module;
        $this->config = $config;
        $this->consolePrompt = $consolePrompt;
        //$this->stringService = $string;
    }


    public function createNewPackage($dir, $name)
    {
        file_put_contents($dir.'/package.json', $this->prepare([
            'name' => sprintf('pibernetwork-%s', strtolower($this->str('url', $name))),
            'version' => '0.1.0',
            'devDependencies' => [***REMOVED***
        ***REMOVED***));

        $this->upgrades[***REMOVED*** = static::$fileCreated;
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

        $packageFile = $dir.'/package.json';

        if (!is_file($packageFile)) {
            $confirm = $this->getConsolePrompt()->show(static::$shouldFile);

            if ($confirm === false) {
                return [***REMOVED***;
            }

            $this->createNewPackage($dir, $this->getModule()->getModuleName());
            //cria arquivo.
        }

        $npmModule = \Zend\Json\Json::decode(file_get_contents($packageFile), 1);

        $newNpm = $this->upgrade($edge, $npmModule);

        file_put_contents($packageFile, $this->prepare($newNpm));

        return $this->upgrades;
    }

    public function prepare(array $php)
    {
        $json = str_replace('\/', '/', json_encode($php, JSON_UNESCAPED_UNICODE));
        return \Zend\Json\Json::prettyPrint($json, 1);

    }

    public function upgrade($edge, $file)
    {
        if (empty($this->upgrades)) {
            $this->upgrades = [***REMOVED***;
        }

        if (empty($file['devDependencies'***REMOVED***)) {
            $file['devDependencies'***REMOVED*** = [***REMOVED***;
        }

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

            if (array_key_exists($dependency, $file['devDependencies'***REMOVED***)
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
        $this->upgrades = [***REMOVED***;

        if (!in_array($type, ['web'***REMOVED***)) {
            return $this->upgrades;
        }

        $edge = $this->getNpmEdge()->getNpmProject($type);

        if (!isset($edge['devDependencies'***REMOVED***)) {
            return $this->upgrades;
        }

        $dir = $this->getProject();

        $packageFile = $dir.'/package.json';

        if (!is_file($packageFile)) {
            $confirm = $this->getConsolePrompt()->show(static::$shouldFile);

            if ($confirm === false) {
                return [***REMOVED***;
            }

            $this->createNewPackage($dir, $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***);
            //cria arquivo.
        }


        $npmModule = \Zend\Json\Json::decode(file_get_contents($dir.'/package.json'), 1);

        $newNpm = $this->upgrade($edge, $npmModule);

        file_put_contents($dir.'/package.json', $this->prepare($newNpm));


        return $this->upgrades;
    }
}
