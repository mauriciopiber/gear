<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

class NpmService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use \Gear\Edge\NpmEdgeTrait;


    static protected $requireDevNotFound = 'DevDependency "%s" com versão "%s"';

    static protected $requireDevVersion = 'DevDependency "%s" mudar para versão "%s"';

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function diagnosticProject($type = 'web')
    {
        $this->errors = [***REMOVED***;

        if (!is_dir($this->getModule()->getMainFolder().'/node_modules/.bin')) {
            $this->errors[***REMOVED*** = 'Você deve rodar o comando npm install para utilizar os testes';
        }

        return $this->errors;
    }

    public function diagnosticModule($type = 'web')
    {
        $this->errors = [***REMOVED***;

//         if (!is_dir($this->getModule()->getMainFolder().'/node_modules/.bin')) {
//             $this->errors[***REMOVED*** = 'Você deve rodar o comando npm install para utilizar os testes';
//         }


        if (!is_file($this->getModule()->getMainFolder().'/package.json')) {
            $this->errors[***REMOVED*** = 'Adicione o arquivo package.json corretamente com os pacotes necessários';
            return $this->errors;
        }


        $package = \Zend\Json\Json::decode(file_get_contents($this->getModule()->getMainFolder().'/package.json'), 1);

        $mirror = $this->getNpmEdge()->getNpmModule($type);

        $require = $this->verify(
            $mirror['devDependencies'***REMOVED***,
            $package['devDependencies'***REMOVED***,
            static::$requireDevNotFound,
            static::$requireDevVersion
        );

        $this->errors = array_merge($this->errors, $require);

        return $this->errors;

    }

    public function verify($edge, $composer, $require, $requireDev)
    {
        $errors = [***REMOVED***;

        foreach ($edge as $package => $version) {

            if (!array_key_exists($package, $composer)) {
                $errors[***REMOVED*** = sprintf($require, $package, $version);
                continue;
            }

            if ($composer[$package***REMOVED*** !== $version) {
                $errors[***REMOVED*** = sprintf($requireDev, $package, $version);
            }
        }

        return $errors;
    }


    public function diagnosticModuleCli()
    {
        return [***REMOVED***;
    }
}
