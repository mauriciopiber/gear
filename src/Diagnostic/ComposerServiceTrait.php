<?php
namespace Gear\Diagnostic;

use Gear\Diagnostic\ComposerServiceFactory;

trait ComposerServiceTrait
{
    protected $composerDiagService;

    public function getComposerDiagnosticService()
    {
        if (!isset($this->composerDiagService)) {
            $name = 'Gear\Diagnostic\ComposerService';
            $this->composerDiagService = $this->getServiceLocator()->get($name);
        }
        return $this->composerDiagService;
    }

    public function setComposerDiagnosticService(
        ComposerService $composerDiagService
    ) {
        $this->composerDiagService = $composerDiagService;
        return $this;
    }
}
