<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Symfony\Component\Yaml\Parser;

class ComposerService implements ServiceLocatorAwareInterface, ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use \Gear\Edge\ComposerEdgeTrait;

    use ServiceLocatorAwareTrait;

    use \Gear\Module\ModuleAwareTrait;

    static protected $requireNotFound = 'Package require "%s" com versão "%s"';

    static protected $requireVersion = 'Package require "%s" mudar para versão "%s"';

    static protected $requireDevNotFound = 'Package require-dev "%s" com versão "%s"';

    static protected $requireDevVersion = 'Package require-dev "%s" mudar para versão "%s"';

    public function __construct($module = null)
    {
        $this->module = $module;
    }

    public function diagnosticProject($type = 'web')
    {

    }

    public function diagnosticModule($type = 'cli')
    {
        $composer = $this->getComposerEdge()->getComposerModule($type);

        $dir = $this->getModule()->getMainFolder();

        $moduleComposer = \Zend\Json\Json::decode(file_get_contents($dir.'/composer.json'), 1);

        $errors = $this->diagnostic($composer, $moduleComposer);

        return $errors;
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

    public function diagnostic($composer, $moduleComposer)
    {
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

        return array_merge($require, $requireDev);
    }
}
