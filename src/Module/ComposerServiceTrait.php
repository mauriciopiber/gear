<?php
namespace Gear\Module;

use Gear\Module\ComposerService;

trait ComposerServiceTrait
{
    protected $composerService;

    public function getComposerService()
    {
        return $this->composerService;
    }

    public function setComposerService(ComposerService $composerService)
    {
        $this->composerService = $composerService;
        return $this;
    }
}
