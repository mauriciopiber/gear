<?php
namespace Gear\Upgrade\Composer;

use Gear\Project\ProjectLocationTrait;
use Gear\Edge\Composer\ComposerEdgeTrait;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\String\StringService;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Upgrade\ModuleUpgradeInterface;
use Gear\Config\GearConfigTrait;
use Gear\Config\GearConfig;
use Gear\Module\Structure\ModuleStructure;

class ComposerUpgrade implements ModuleUpgradeInterface
{
    use ModuleStructureTrait;

    use StringServiceTrait;

    use ProjectLocationTrait;

    use ComposerEdgeTrait;

    use ConsolePromptTrait;

    static public $satisUrl = 'https://mirror.piber.network';

    static public $shouldFile = 'Composer - Você quer criar o arquivo composer.json?';

    static public $fileCreated = 'Composer - Arquivo composer.json criado';


    static public $shouldAdd = 'Composer - Deve adicionar o package %s na versão %s em %s?';

    static public $shouldVersion =
        'Composer - Deve alterar a versão do package %s da versão %s para versão %s em %s?';

    static public $added = 'Composer - Adicionado package %s na versão %s em %s';

    static public $version = 'Composer - Alterado versão do package %s de %s para %s em %s';

    static public $shouldAutoload = 'Composer - Adicionar autoload PSR-0?';

    static public $autoload = 'Composer - Adicionado autoload PSR-0';

    static public $shouldSatis = 'Composer - Adicionar Satis aos repositórios?';

    static public $satis = 'Composer - Adicionado Satis ao repositório';

    static public $shouldPackagist = 'Composer - Desativar packagist?';

    static public $packagist = 'Composer - Packagist desativado';

    static public $shouldName = 'Composer - Colocar nome do módulo?';

    static public $namepack = 'Composer - Nome corrigído';

    public $config = [***REMOVED***;

    public function __construct(
        ModuleStructure $module,
        GearConfig $gearConfig,
        ComposerEdge $composerEdge,
        $consolePrompt,
        StringService $stringService
    ) {
        $this->setStringService($stringService);
        $this->module = $module;
        $this->gearConfig = $gearConfig;
        $this->composerEdge = $composerEdge;
        $this->consolePrompt = $consolePrompt;
    }

    public function prepare(array $php)
    {
        $json = str_replace('\/', '/', json_encode($php, JSON_UNESCAPED_UNICODE));
        return \Zend\Json\Json::prettyPrint($json, 1);
    }

    public function createNewComposer($dir)
    {
        file_put_contents($dir.'/composer.json', $this->prepare([
            'require' => [***REMOVED***,
            'require-dev' => [***REMOVED***
        ***REMOVED***));

        $this->upgrades[***REMOVED*** = static::$fileCreated;
    }

    public function upgradeModule($type = null)
    {
        if (empty($type)) {
            $type = $this->gearConfig->getCurrentType();
        }
        $this->upgrades = [***REMOVED***;

        $composer = $this->getComposerEdge()->getComposerModule($type);

        $dir = $this->getModule()->getMainFolder();

        $composerFile = $dir.'/composer.json';

        if (!is_file($composerFile)) {
            $confirm = $this->getConsolePrompt()->show(static::$shouldFile);
            if ($confirm === false) {
                return [***REMOVED***;
            }

            $this->createNewComposer($dir);
        }

        $moduleComposer = \Zend\Json\Json::decode(file_get_contents($composerFile), 1);

        $newComposer = $this->upgrade($composer, $moduleComposer, __FUNCTION__);

        file_put_contents($dir.'/composer.json', $this->prepare($newComposer));

        return $this->upgrades;
    }


    public function upgradePackage()
    {
    }

    public function upgradeName(array $file, $expectedName)
    {

        $expectedName = sprintf(
            'mauriciopiber/%s',
            str_replace(' ', '', $this->str('url', $this->str('class', $expectedName)))
        );

        if (array_key_exists('name', $file) && $file['name'***REMOVED*** === $expectedName) {
            return $file;
        }

        $confirm = $this->getConsolePrompt()->show(static::$shouldName);

        if ($confirm === false) {
            return $file;
        }

        $file = ['name' => $expectedName***REMOVED*** + $file;



        $this->upgrades[***REMOVED*** = static::$namepack;

        return $file;
    }

    public function upgradeAutoload(array $file)
    {
        if (array_key_exists('autoload', $file)) {
            return $file;
        }

        $confirm = $this->getConsolePrompt()->show(static::$shouldAutoload);

        if ($confirm === false) {
            return $file;
        }

        $class = $this->str('class', $this->getModule()->getModuleName());

        $file['autoload'***REMOVED*** = [
            'psr-0' => [
                $class => 'src',
                sprintf('%sTest', $class) => 'test/unit'
            ***REMOVED***
        ***REMOVED***;

        $this->upgrades[***REMOVED*** = static::$autoload;

        return $file;
    }

    public function upgradeSatis(array $file)
    {
        $confirm = $this->getConsolePrompt()->show(static::$shouldSatis);


        if ($confirm === false) {
            return $file;
        }

        if (!isset($file['repositories'***REMOVED***)) {
            $file['repositories'***REMOVED*** = [***REMOVED***;
        }

        $file['repositories'***REMOVED***[***REMOVED*** = [
            'type' => 'composer',
            'url' => static::$satisUrl
        ***REMOVED***;

        $this->upgrades[***REMOVED*** = static::$satis;

        return $file;
    }

    public function upgradePackagist(array $file)
    {
        $confirm = $this->getConsolePrompt()->show(static::$shouldPackagist);


        if ($confirm === false) {
            return $file;
        }

        if (!isset($file['repositories'***REMOVED***)) {
            $file['repositories'***REMOVED*** = [***REMOVED***;
        }

        $file['repositories'***REMOVED***[***REMOVED*** = [
            'packagist' => false
        ***REMOVED***;

        $this->upgrades[***REMOVED*** = static::$packagist;


        return $file;
    }

    public function upgradeRepository(array $file)
    {
        if (array_key_exists('repositories', $file) && count($file['repositories'***REMOVED***) == 2) {
            return $file;
        }

        $file = $this->upgradeSatis($file);
        $file = $this->upgradePackagist($file);
        return $file;
    }

    public function upgrade($edge, $file, $function)
    {
        if ($function == 'upgradeModule') {
            $name = $this->getModule()->getModuleName();
        }

        if ($function == 'upgradeProject') {
            $name = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
        }

        $file = $this->upgradeName($file, $name);



        foreach ($edge['require'***REMOVED*** as $require => $version) {


             if (
                $require
                === sprintf(
                    'mauriciopiber/%s',
                    $this->getModule()->str('url', $this->getModule()->getModuleName())
                )
            ) {
                continue;
            }


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

             if (
                $require
                === sprintf(
                    'mauriciopiber/%s',
                    $this->getModule()->str('url', $this->getModule()->getModuleName())
                )
            ) {
                continue;
            }


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

        if ($function == 'upgradeModule') {
            $file = $this->upgradeAutoload($file);
        }

        $file = $this->upgradeRepository($file);

        return $file;
    }
}