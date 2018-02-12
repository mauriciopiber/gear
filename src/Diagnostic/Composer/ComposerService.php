<?php
namespace Gear\Diagnostic\Composer;

use Gear\Project\ProjectLocationTrait;
use Gear\Diagnostic\ModuleDiagnosticInterface;

class ComposerService implements ModuleDiagnosticInterface
{
    use \Gear\Edge\Composer\ComposerEdgeTrait;

    use \Gear\Module\ModuleAwareTrait;

    use ProjectLocationTrait;

    static public $missingFile = 'Composer - Está faltando o arquivo composer.json';

    static public $satis = 'https://mirror.pibernetwork.com';

    static public $missingName = 'Composer - Adicione o nome corretamente';

    static public $missingAutoload = 'Composer - Adicione o Autoload PSR-0 no módulo';

    static public $missingSatis = 'Composer - Adicione o repositório https://mirror.pibernetwork.com ao composer';

    static public $missingPackFalse = 'Composer - Adicione a opção de desativar o packagist global no composer';

    static public $requireNotFound = 'Composer - Package require "%s" com versão "%s"';

    static public $requireVersion = 'Composer - Package require "%s" mudar da versão %s para versão "%s"';

    static public $requireDevNotFound = 'Composer - Package require-dev "%s" com versão "%s"';

    static public $requireDevVersion = 'Composer - Package require-dev "%s" mudar da versão %s para versão "%s"';

    public function __construct($module = null)
    {
        $this->module = $module;

    }

    public function diagnosticModule($type = 'cli')
    {
        $composer = $this->getComposerEdge()->getComposerModule($type);

        $dir = $this->getModule()->getMainFolder();

        $composerFile = $dir.'/composer.json';

        if (!is_file($composerFile)) {
            return [static::$missingFile***REMOVED***;
        }

        $moduleComposer = \Zend\Json\Json::decode(file_get_contents($composerFile), 1);

        $errors = $this->diagnostic($composer, $moduleComposer, __FUNCTION__);

        return $errors;
    }

    public function verify($edge, $composer, $noFoundTemplate, $wrongVersionTemplate)
    {
        $errors = [***REMOVED***;

        foreach ($edge as $package => $version) {

            if (
                $package
                === sprintf(
                    'mauriciopiber/%s',
                    $this->getModule()->str('url', $this->getModule()->getModuleName())
                )
            ) {
                continue;
            }

            if (!array_key_exists($package, $composer)) {
                $errors[***REMOVED*** = sprintf($noFoundTemplate, $package, $version);
                continue;
            }

            if ($composer[$package***REMOVED*** !== $version) {
                $errors[***REMOVED*** = sprintf($wrongVersionTemplate, $package, $composer[$package***REMOVED***, $version);
            }
        }

        return $errors;
    }

    public function diagnosticName($file)
    {
        if (!array_key_exists('name', $file)) {
            $this->errors[***REMOVED*** = static::$missingName;
            return false;
        }

        return true;
    }

    public function diagnosticRepositoryExist($file)
    {
        if (!array_key_exists('repositories', $file)) {
            $this->errors[***REMOVED*** = static::$missingPackFalse;
            $this->errors[***REMOVED*** = static::$missingSatis;
            return false;
        }

        return true;
    }

    public function diagnosticAutoload($file)
    {
        if (!array_key_exists('autoload', $file)) {
            $this->errors[***REMOVED*** = static::$missingAutoload;
            return false;
        }

        return true;
    }

    public function diagnostic($composer, $moduleComposer, $function = null)
    {
        $this->errors = [***REMOVED***;

        $this->diagnosticName($moduleComposer);

        $hasRepository = $this->diagnosticRepositoryExist($moduleComposer);

        if ($hasRepository) {
            $packagist = false;
            $satis = false;

            foreach ($moduleComposer['repositories'***REMOVED*** as $repository) {
                if (array_key_exists('packagist', $repository) && $repository['packagist'***REMOVED*** === false) {
                    $packagist = true;
                }

                if (array_key_exists('type', $repository)
                    && $repository['type'***REMOVED*** === 'composer'
                    && array_key_exists('url', $repository)
                    && $repository['url'***REMOVED*** === static::$satis
                ) {
                    $satis = true;
                }
            }

            if ($packagist === false) {
                $this->errors[***REMOVED*** = static::$missingPackFalse;
            }

            if ($satis === false) {
                $this->errors[***REMOVED*** = static::$missingSatis;
            }
        }

        if ($function == 'diagnosticModule') {
            $this->diagnosticAutoload($moduleComposer);
        }

        $require = $this->verify(
            $composer['require'***REMOVED***,
            $moduleComposer['require'***REMOVED***,
            static::$requireNotFound,
            static::$requireVersion
        );

        $requireDev = $this->verify(
            $composer['require-dev'***REMOVED***,
            $moduleComposer['require-dev'***REMOVED***,
            static::$requireDevNotFound,
            static::$requireDevVersion
        );

        return array_merge($this->errors, $require, $requireDev);
    }
}
