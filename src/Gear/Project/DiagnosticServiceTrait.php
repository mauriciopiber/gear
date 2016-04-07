<?php
namespace Gear\Project;

use Gear\Project\DiagnosticService;

trait DiagnosticServiceTrait
{
    protected $diagnosticService;

    public function getDiagnosticService()
    {
        if (!isset($this->diagnosticService)) {
            $name = 'Gear\Project\DiagnosticService';
            $this->diagnosticService = $this->getServiceLocator()->get($name);
        }
        return $this->diagnosticService;
    }

    public function setDiagnosticService(
        DiagnosticService $diagnosticService
    ) {
        $this->diagnosticService = $diagnosticService;
        return $this;
    }
}
