<?php
namespace Gear\Diagnostic\Composer;

use Gear\Diagnostic\Composer\ComposerServiceFactory;

trait ComposerServiceTrait
{
    protected $composerDiagService;

    public function getComposerDiagnosticService()
    {
        if (!isset($this->composerDiagService)) {
            $name = 'Gear\Diagnostic\Composer\ComposerService';
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
