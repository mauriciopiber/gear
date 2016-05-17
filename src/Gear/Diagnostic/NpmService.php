<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

class NpmService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    public function diagnosticProjectWeb()
    {
        $this->errors = [***REMOVED***;

        if (!is_dir($this->getModule()->getMainFolder().'/node_modules/.bin')) {
            $this->errors[***REMOVED*** = 'Você deve rodar o comando npm install para utilizar os testes';
        }

        return $this->errors;
    }

    public function diagnosticModuleWeb()
    {
        $this->errors = [***REMOVED***;

        if (!is_dir($this->getModule()->getMainFolder().'/node_modules/.bin')) {
            $this->errors[***REMOVED*** = 'Você deve rodar o comando npm install para utilizar os testes';
        }


        if (!is_file($this->getModule()->getMainFolder().'/package.json')) {
            $this->errors[***REMOVED*** = 'Adicione o arquivo package.json corretamente com os pacotes necessários';
            return $this->errors;
        }


        $package = \Zend\Json\Json::decode(file_get_contents($this->getModule()->getMainFolder().'/package.json', 1));





        return $this->errors;
    }

    public function diagnosticModuleCli()
    {
        return [***REMOVED***;
    }
}
