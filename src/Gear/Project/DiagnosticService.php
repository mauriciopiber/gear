<?php
namespace Gear\Project;

use Gear\Diagnostic\AbstractDiagnostic;

class DiagnosticService extends AbstractDiagnostic
{
    public static $SATIS = 'https://mirror.pibernetwork.com';

    public function diagnostics()
    {
        $this->baseDir = \GearBase\Module::getProjectFolder();
        $this->console = $this->getServiceLocator()->get('console');

        if (
            !is_dir(!$this->baseDir.'/module')
            && is_file($this->baseDir.'/Module.php')
        ) {
            $this->showCheck('Execute esse comando apenas no contexto de Projeto.');
            return;
        }


        $this->diagnosticFolder($this->baseDir.'/data/logs');
        $this->diagnosticFolder($this->baseDir.'/data/DoctrineORMModule/Proxy');
        $this->diagnosticFolder($this->baseDir.'/data/DoctrineModule/cache');
        $this->diagnosticFolder($this->baseDir.'/data/cache/configcache');
        $this->diagnosticFolder($this->baseDir.'/data/session');
        $this->diagnosticFolder($this->baseDir.'/build');

        $this->diagnosticFrontend();
        $this->diagnosticBuildpath();
        $this->diagnosticComposer();
        $this->diagnosticScript();

        $this->diagnosticCodeception();

        if (empty($this->message)) {
            $this->message = 'Diagnóstico Ok, sistema pronto para produção.';
            $this->showCheck($this->message);
        } else {
            $this->message = 'Corrija os erros antes de continuar';
            $this->console->writeLine($this->message, 2);
        }

    }

    public function diagnosticFolder($baseDir)
    {
        if (!is_dir($baseDir)) {

            $this->message = sprintf(
                'Deves criar o diretório %s',
                $baseDir
            );
            $this->console->writeLine($this->message, 2);
        }

        if (!is_writable($baseDir)) {
            $this->message = sprintf(
                'Deves dar permissão de escrita no diretório %s',
                $baseDir
            );
            $this->console->writeLine($this->message, 2);
        }

        if (!is_file($baseDir.'/.gitignore')) {
            $this->message = sprintf(
                'Deve adicionar arquivo .gitignore para pasta %s',
                $baseDir
            );
            $this->console->writeLine($this->message, 2);
        }
    }

    public function diagnosticFile($baseDir)
    {
        $diagnostic = is_file($baseDir);

        if (!$diagnostic) {

            $this->showError(
                sprintf(
                    'Deves criar o arquivo %s',
                    $baseDir
                )
            );
        }

        return $diagnostic;
    }

    public function diagnosticBuildpath()
    {
        $this->diagnosticFile($this->baseDir.'/.buildpath');
    }

    public function diagnosticComposer()
    {
        $isComposer = $this->diagnosticFile($this->baseDir.'/composer.json');

        if (!$isComposer) {
            return;
        }


        $composer = \Zend\Json\Json::decode(file_get_contents($this->baseDir.'/composer.json'), 1);

        //repository http
        //packagist false

        //continuous CI.

        //gear

        //admin


        if (!array_key_exists('name', $composer)) {
            $this->showError('Adicione o nome do projeto ao composer');
        }

        if (!array_key_exists('repositories', $composer)) {
            $this->showError('Adicione a opção de desativar o packagist global no composer.');
            $this->showError('Adicione o repositório https://mirror.pibernetwork.com ao composer.');
        } else {

            $packagist = false;
            $satis = false;

            foreach ($composer['repositories'***REMOVED*** as $repository) {

                if (array_key_exists('packagist', $repository) && $repository['packagist'***REMOVED*** === false) {
                    $packagist = true;
                }


                if (
                    array_key_exists('type', $repository)
                    && $repository['type'***REMOVED*** === 'composer'
                    && array_key_exists('url', $repository)
                    && $repository['url'***REMOVED*** === static::$SATIS
                ) {

                    $satis = true;

                }

            }

            if ($packagist === false) {
                $this->showError('Adicione a opção de desativar o packagist global no composer.');
            }

            if ($satis === false) {
                $this->showError('Adicione o repositório https://mirror.pibernetwork.com ao composer.');
            }

        }

        $required = [
            'mauriciopiber/gear-admin' => '~0.2.0',
            'mauriciopiber/gear-acl' => '~0.2.0',
            'mauriciopiber/gear-image' => '~0.2.0',
            'mauriciopiber/gear-email' => '~0.2.0',
            'mauriciopiber/gear-base' => '~0.2.0',
            'mauriciopiber/gear-json' => '~0.2.0',
            'zendframework/zend-mvc' => '~2.6.0',
        ***REMOVED***;


        foreach ($required as $package => $version) {
            if (!array_key_exists($package, $composer['require'***REMOVED***)) {
                $this->showError('Adicione o package '.$package.' com versão '.$version);
                continue;
            }

            if ($composer['require'***REMOVED***[$package***REMOVED*** !== '~0.2.0') {
                $this->showError('Modifique a versão do package '.$package.' para versão '.$version);
            }

        }

        $requiredDev = [
            'mauriciopiber/gear' => '~0.2.0',
            'mauriciopiber/gear-deploy' => '~0.2.0',
            'mauriciopiber/gear-version' => '~0.2.0',
            'mauriciopiber/gear-jenkins' => '~0.2.0',
        ***REMOVED***;

        foreach ($required as $package => $version) {
            if (!array_key_exists($package, $composer['require-dev'***REMOVED***)) {
                $this->showError('Adicione o package '.$package.' com versão '.$version);
                continue;
            }

            if ($composer['require-dev'***REMOVED***[$package***REMOVED*** !== '~0.2.0') {
                $this->showError('Modifique a versão do package '.$package.' para versão '.$version);
            }

        }
    }

    public function diagnosticSuiteConfig($suiteLocation)
    {
        if (is_file($suiteLocation)) {

            $suiteLocationYaml = Yaml::parse($suiteLocation);

            if (isset($suiteLocationYaml['modules'***REMOVED***['config'***REMOVED***['WebDriver'***REMOVED***)) {
                $this->message = sprintf(
                    'Remover webdriver do teste de aceitação para'
                    . 'Módulo %s, só é permitido configuração global.',
                    $suiteLocation
                );
                $this->console->writeLine($this->message, 2);
            }

            if (isset($suiteLocationYaml['modules'***REMOVED***['config'***REMOVED***['Db'***REMOVED***)) {
                $this->message = sprintf(
                    'Remover db do teste de aceitação para Módulo %s,'
                    . 'só é permitido configuração global.',
                    $suiteLocation
                );
                $this->console->writeLine($this->message, 2);
                $this->console->writeLine($this->message, 2);
            }


            if ($suiteLocationYaml['class_name'***REMOVED*** == 'UnitTester') {

                if (isset($suiteLocationYaml['coverage'***REMOVED***) && $suiteLocationYaml['coverage'***REMOVED***['enabled'***REMOVED*** == false) {
                    $this->message = sprintf(
                        'Habilitar code-coverage para testes unitários',
                        $suiteLocation
                    );
                    $this->console->writeLine($this->message, 2);
                    $this->console->writeLine($this->message, 2);
                }
            }


            if ($suiteLocationYaml['class_name'***REMOVED*** != 'UnitTester') {

                if (isset($suiteLocationYaml['coverage'***REMOVED***) && $suiteLocationYaml['coverage'***REMOVED***['enabled'***REMOVED*** == true) {
                    $this->message = sprintf(
                        'Desabilitar code-coverage para testes unitários',
                        $suiteLocation
                    );
                    $this->console->writeLine($this->message, 2);
                    $this->console->writeLine($this->message, 2);
                }
            }
        }
    }


    public function diagnosticCodeception()
    {
        $projectCodeception = $this->baseDir.'/codeception.yml';

        $this->diagnosticFile($projectCodeception);

        return;

        $projectCodeceptionDecoded = Yaml::parse($projectCodeception);

        if (empty($projectCodeceptionDecoded['include'***REMOVED***)) {
            return false;
        }

        $modules = $projectCodeceptionDecoded['include'***REMOVED***;

        foreach ($modules as $module) {

            $moduleYaml = \GearBase\Module::getProjectFolder().'/'.$module.'/codeception.yml';

            if (!is_file($moduleYaml)) {
                $this->message = sprintf(
                    'Módulo %s adicionado ao projeto mas não possui arquivo codeception.yml',
                    $module
                );
                $this->console->writeLine($this->message, 2);
            }


            $moduleDecoded = Yaml::parse($moduleYaml);

            //Todos módulos tem que ter apenas o arquivo principal de configuração para WebDriver e DB.

            if (!isset($moduleDecoded['modules'***REMOVED***['config'***REMOVED***['WebDriver'***REMOVED***)) {
                $this->message = sprintf(
                    'Módulo %s não possui configuração WebDriver no arquivo codeception.yml',
                    $module
                );
                $this->console->writeLine($this->message, 2);
            }

            if (!isset($moduleDecoded['modules'***REMOVED***['config'***REMOVED***['Db'***REMOVED***)) {
                $this->message = sprintf(
                    'Módulo %s não possui configuração Db no arquivo codeception.yml',
                    $module
                );
                $this->console->writeLine($this->message, 2);
            }

            $acceptance = \GearBase\Module::getProjectFolder().'/'.$module.'/test/acceptance.suite.yml';

            $this->diagnosticSuiteConfig($acceptance);

            $functional = \GearBase\Module::getProjectFolder().'/'.$module.'/test/functional.suite.yml';

            $this->diagnosticSuiteConfig($functional);

            $unit = \GearBase\Module::getProjectFolder().'/'.$module.'/test/unit.suite.yml';

            $this->diagnosticSuiteConfig($unit);
            //Para cada módulo, deve ter 1 configuração de
            //WebDriver e 1 configuração de DB Logo no arquivo principal.
        }
    }

    public function diagnosticScript()
    {
        $this->diagnosticFile($this->baseDir.'/script/deploy-testing.sh');
        $this->diagnosticFile($this->baseDir.'/script/deploy-development.sh');
        $this->diagnosticFile($this->baseDir.'/script/deploy-production.sh');
        $this->diagnosticFile($this->baseDir.'/script/deploy-staging.sh');
        $this->diagnosticFile($this->baseDir.'/script/load.sh');
    }


    public function diagnosticFrontend()
    {
        $this->diagnosticFolder($this->baseDir.'/node_modules');

        $this->diagnosticFile($this->baseDir.'/package.json');
        $this->diagnosticFile($this->baseDir.'/gulpfile.js');
        $this->diagnosticFile($this->baseDir.'/config.json');

        //package.json

        //config.json
        if (!is_dir($this->baseDir.'/node_modules/.bin')) {
            $this->showError(sprintf(
                'Deves rodar o comando npm install'
            ));
        }

        //rodou npm install?
    }
}
