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

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function diagnosticProjectWeb()
    {



        return [***REMOVED***;
    }



    public function diagnosticModuleWeb()
    {
        $composer = $this->getComposerEdge()->getComposerModule('web');

        $errors = [***REMOVED***;

        $dir = $this->getModule()->getMainFolder();

        $moduleComposer = \Zend\Json\Json::decode(file_get_contents($dir.'/composer.json'), 1);

        foreach ($composer['require'***REMOVED*** as $package => $version) {

            if (!array_key_exists($package, $moduleComposer['require'***REMOVED***)) {
                $errors[***REMOVED*** = sprintf('Package require "%s" com versão "%s"', $package, $version);
                continue;
            }

            if ($moduleComposer['require'***REMOVED***[$package***REMOVED*** !== $version) {
                $errors[***REMOVED*** = sprintf('Package require "%s" mudar para versão "%s"', $package, $version);
            }
        }

        foreach ($composer['require-dev'***REMOVED*** as $package => $version) {

            if (!array_key_exists($package, $moduleComposer['require-dev'***REMOVED***)) {
                $errors[***REMOVED*** = sprintf('Package require-dev "%s" com versão "%s"', $package, $version);
                continue;
            }

            if ($moduleComposer['require-dev'***REMOVED***[$package***REMOVED*** !== $version) {
                $errors[***REMOVED*** = sprintf('Package require-dev "%s" mudar para versão "%s"', $package, $version);
            }
        }


        return $errors;
    }



    public function diagnosticModuleCli()
    {
        return [***REMOVED***;
    }
}
