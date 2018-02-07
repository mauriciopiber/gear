<?php
namespace Gear\Module\Diagnostic;

use Gear\Module\Diagnostic\DiagnosticService;

trait DiagnosticServiceTrait
{
    protected $diagnosticService;

    public function getDiagnosticService()
    {
        if (!isset($this->diagnosticService)) {
            $this->diagnosticService = $this->getServiceLocator()->get('Gear\Module\Diagnostic');
        }
        return $this->diagnosticService;
    }

    public function setDiagnosticService(DiagnosticService $diagnosticService)
    {
        $this->diagnosticService = $diagnosticService;
        return $this;
    }
}
