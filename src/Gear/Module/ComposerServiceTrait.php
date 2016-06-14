<?php
namespace Gear\Module;

use Gear\Module\ComposerService;

trait ComposerServiceTrait
{
    protected $composerService;

    public function getComposerService()
    {
        if (!isset($this->composerService)) {
            $this->composerService = $this->getServiceLocator()->get('Gear\Module\Composer');
        }
        return $this->composerService;
    }

    public function setComposerService(ComposerService $composerService)
    {
        $this->composerService = $composerService;
        return $this;
    }
}
