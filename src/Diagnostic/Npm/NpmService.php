<?php
namespace Gear\Diagnostic\Npm;

use Gear\Project\ProjectLocationTrait;
use Gear\Edge\Npm\NpmEdgeTrait;
use Gear\Diagnostic\ModuleDiagnosticInterface;
use Gear\Module\ModuleAwareTrait;

class NpmService implements ModuleDiagnosticInterface
{
    use ProjectLocationTrait;

    use NpmEdgeTrait;

    use ModuleAwareTrait;

    static public $missingFile = 'Nodejs - Está faltando o arquivo package.json';

    static public $requireDevNotFound = 'Nodejs - DevDependency "%s" com versão "%s"';

    static public $requireDevVersion = 'Nodejs - DevDependency "%s" mudar para versão de %s para "%s"';

    static public $requireRun = 'Nodejs - Você deve rodar o comando npm install para utilizar os testes';

    public function __construct($module = null)
    {
        $this->module = $module;
    }

    public function diagnosticModule($type = 'web')
    {
        $this->errors = [***REMOVED***;

        if (!in_array($type, ['web'***REMOVED***)) {
            return $this->errors;
        }

        $baseDir = $this->getModule()->getMainFolder();

        $npmFile = $baseDir.'/package.json';

        if (!is_file($npmFile)) {
            return [static::$missingFile***REMOVED***;
        }

        $package = \Zend\Json\Json::decode(file_get_contents($npmFile), 1);

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
            if (!is_array($composer)) {
                $errors[***REMOVED*** = sprintf($require, $package, $version);
                continue;
            }

            if (!array_key_exists($package, $composer)) {
                $errors[***REMOVED*** = sprintf($require, $package, $version);
                continue;
            }

            if ($composer[$package***REMOVED*** !== $version) {
                $errors[***REMOVED*** = sprintf($requireDev, $package, $composer[$package***REMOVED***, $version);
            }
        }

        return $errors;
    }


    public function diagnosticModuleCli()
    {
        return [***REMOVED***;
    }
}
