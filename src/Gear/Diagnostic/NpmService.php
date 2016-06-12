<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectLocationTrait;

class NpmService extends AbstractJsonService implements ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use ProjectLocationTrait;

    use \Gear\Edge\NpmEdgeTrait;


    static public $requireDevNotFound = 'Nodejs - DevDependency "%s" com versão "%s"';

    static public $requireDevVersion = 'Nodejs - DevDependency "%s" mudar para versão "%s"';

    static public $requireRun = 'Nodejs - Você deve rodar o comando npm install para utilizar os testes';

    public function __construct($module = null)
    {
        $this->module = $module;
    }

    public function diagnosticProject($type = 'web')
    {
        $this->errors = [***REMOVED***;

        $baseDir = $this->getProject();

        if (!is_dir($baseDir.'/node_modules/.bin')) {
            $this->errors[***REMOVED*** = static::$requireRun;
        }

        $npmFile = $baseDir.'/package.json';

        if (!is_file($npmFile)) {
            return [static::$missingFile***REMOVED***;
        }

        $package = \Zend\Json\Json::decode(file_get_contents($npmFile), 1);

        $mirror = $this->getNpmEdge()->getNpmProject($type);

        $require = $this->verify(
            $mirror['devDependencies'***REMOVED***,
            $package['devDependencies'***REMOVED***,
            static::$requireDevNotFound,
            static::$requireDevVersion
        );

        $this->errors = array_merge($this->errors, $require);

        return $this->errors;



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
