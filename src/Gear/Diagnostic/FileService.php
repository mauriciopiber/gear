<?php
namespace Gear\Diagnostic;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class FileService implements ServiceLocatorAwareInterface, ModuleDiagnosticInterface, ProjectDiagnosticInterface
{
    use ServiceLocatorAwareTrait;

    public function diagnosticProjectWeb()
    {
        return [***REMOVED***;
    }

    public function diagnosticModuleWeb()
    {
        return [***REMOVED***;
    }

    public function diagnosticModuleCli()
    {
        return [***REMOVED***;
    }
}
