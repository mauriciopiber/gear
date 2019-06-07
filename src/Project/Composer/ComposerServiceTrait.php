<?php
namespace Gear\Project\Composer;

use Gear\Project\Composer\ComposerServiceFactory;

/**
 * @deprecated
 */
trait ComposerServiceTrait
{
    protected $composerService;

    public function getComposerService()
    {
        return $this->composerService;
    }

    public function setComposerService(
        ComposerService $composerService
    ) {
        $this->composerService = $composerService;
        return $this;
    }
}
