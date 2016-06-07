<?php
namespace Gear\Codeception;

class CodeceptionDiagnostic
{

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
}