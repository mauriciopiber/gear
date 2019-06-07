<?php
namespace Gear\Diagnostic\Composer;

use Gear\Diagnostic\Composer\ComposerServiceFactory;

trait ComposerServiceTrait
{
    protected $composerDiagService;

    public function getComposerDiagnosticService()
    {
        return $this->composerDiagService;
    }

    public function setComposerDiagnosticService(
        ComposerService $composerDiagService
    ) {
        $this->composerDiagService = $composerDiagService;
        return $this;
    }
}
