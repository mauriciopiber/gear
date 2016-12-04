<?php
namespace Gear\Module\Diagnostic;

use Gear\Diagnostic\AbstractDiagnostic;

/**
 * Classe responsável por fazer o diagnóstico dos módulos para ter certeza que possui todos componentes
 * necessários para utilização do Gear, Jenkins.
 */
class DiagnosticService extends AbstractDiagnostic
{
    /**
     * Construtor do diagnóstico
     *
     * @param Zend\Console $console
     * @param Gear\Module\BasicModuleStructure $module
     */
    public function __construct($console, $module)
    {
        $this->console = $console;
        $this->module = $module;
    }

    public function diagnostic($type = 'web', $just = null)
    {
        $this->errors = [***REMOVED***;

        if ($this->checkJust($just) === false) {
            return false;
        }

        if ($just === null) {
            $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticModule($type));
            $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticModule($type));

            $this->show();

            return true;
        }


        switch ($just) {
            case 'composer':
                $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticModule($type));
                break;

            case 'ant':
                $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModule($type));
                break;

            case 'npm':
                $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticModule($type));
                break;

            case 'file':
                $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticModule($type));
                break;

            case 'dir':
                $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticModule($type));
                break;

            default:
                $this->errors[***REMOVED*** = sprintf(self::NO_FOUND, $just);
                break;
        }

        $this->show();

        return true;
    }
}
