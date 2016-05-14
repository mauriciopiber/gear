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
     * @var array $errors Erros encontrados
     */
    public $errors = [***REMOVED***;

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

    public function diagnostic($cli = true)
    {
        $module = $this->module->getModule();

        $this->errors = [***REMOVED***;


        if ($cli) {
            $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModuleCli());
            $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticModuleCli());
            $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticModuleCli());
            $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticModuleCli());
            $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticModuleCli());

        } else {
            $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModuleWeb());
            $this->errors = array_merge($this->errors, $this->getDirDiagnosticService()->diagnosticModuleWeb());
            $this->errors = array_merge($this->errors, $this->getFileDiagnosticService()->diagnosticModuleWeb());
            $this->errors = array_merge($this->errors, $this->getNpmService()->diagnosticModuleWeb());
            $this->errors = array_merge($this->errors, $this->getComposerDiagnosticService()->diagnosticModuleWeb());
        }


        if (count($this->errors)) {

            $count = count($this->errors);

            $errors = ($count==1) ? 'Foi encontrado %s erro, corrijá-o.' : 'Foram encontrados %d erros, corrijá-os';

            $this->showError(sprintf($errors, count($this->errors)));

            foreach ($this->errors as $i =>  $item) {
                $this->showError(($i+1).'° '.$item);
            }



            return;
        }


        $this->console->writeLine('O Módulo está pronto para o trabalho.', 0, 3);
        return;
    }
}
