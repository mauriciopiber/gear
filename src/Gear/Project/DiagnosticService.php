<?php
namespace Gear\Project;

use Gear\Service\AbstractJsonService;

class DiagnosticService extends AbstractJsonService
{
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
        $projectCodeception = \GearBase\Module::getProjectFolder().'/codeception.yml';
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

    public function printWarning($message)
    {
        $this->console->writeLine($message, 2);
    }

    public function printMessage($message)
    {
        $this->console->writeLine($message, 3);
    }

    public function diagnostics()
    {
        $this->baseDir = \GearBase\Module::getProjectFolder();
        $this->console = $this->getServiceLocator()->get('console');

        if (
            !is_dir(!$this->baseDir.'/module')
            || !is_file($this->baseDir.'/Module.php')
        ) {
            $this->printMessage('Execute esse comando apenas no contexto de Projeto.');
            return;
        }


        $this->diagnosticFolder($this->baseDir.'/data/logs');
        $this->diagnosticFolder($this->baseDir.'/data/DoctrineORMModule/Proxy');
        $this->diagnosticFolder($this->baseDir.'/data/DoctrineModule/cache');
        $this->diagnosticFolder($this->baseDir.'/data/cache/configcache');
        $this->diagnosticFolder($this->baseDir.'/data/session');

        //$this->diagnosticCodeception();

        if (empty($this->message)) {
            $this->message = 'Diagnóstico Ok, sistema pronto para produção.';
            $this->printMessage($this->message);
        } else {
            $this->message = 'Corrija os erros antes de continuar';
            $this->console->writeLine($this->message, 2);
        }
        //se está ok exibe mensagem verde.
        //se está errado exibe mensagem vermelha.
    }
}
