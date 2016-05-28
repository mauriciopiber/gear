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

    public function diagnostic($type = 'web')
    {
        $module = $this->module->getModule();

        $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticModule($type));
        $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticModule($type));
        $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModule($type));
        $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticModule($type));
        $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticModule($type));

        $this->show();

        return true;
    }
}
