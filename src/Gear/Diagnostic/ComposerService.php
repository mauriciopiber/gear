<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Symfony\Component\Yaml\Parser;

class ComposerService implements ServiceLocatorAwareInterface, ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use \Gear\Edge\ComposerEdgeTrait;

    use ServiceLocatorAwareTrait;

    public function diagnosticProjectWeb()
    {



        return [***REMOVED***;
    }

    public function diagnosticModuleWeb()
    {
        $data = $this->getComposerEdge()->getComposerModule('web');

        var_dump($data);

        return [***REMOVED***;
    }

    public function diagnosticModuleCli()
    {
        return [***REMOVED***;
    }
}
