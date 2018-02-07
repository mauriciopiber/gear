<?php
namespace Gear\Project\Composer;

use Gear\Project\Composer\ComposerServiceFactory;

trait ComposerServiceTrait
{
    protected $composerService;

    public function getComposerService()
    {
        if (!isset($this->composerService)) {
            $name = 'Gear\Project\Composer\ComposerService';
            $this->composerService = $this->getServiceLocator()->get($name);
        }
        return $this->composerService;
    }

    public function setComposerService(
        ComposerService $composerService
    ) {
        $this->composerService = $composerService;
        return $this;
    }
}
