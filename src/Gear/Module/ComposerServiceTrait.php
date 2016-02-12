<?php
namespace Gear\Module;

use Gear\Module\ComposerService;

trait ComposerServiceTrait
{
    protected $composerService;

    public function getComposerService()
    {
        if (!isset($this->composerService)) {
            $this->composerService = $this->getServiceLocator()->get('composerService');
        }
        return $this->composerService;
    }

    public function setComposerService(ComposerService $composerService)
    {
        $this->composerService = $composerService;
        return $this;
    }
}
