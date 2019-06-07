<?php
namespace Gear\Autoload;

use Gear\Autoload\ComposerAutoloadFactory;

trait ComposerAutoloadTrait
{
    protected $composerAutoload;

    public function getComposerAutoload()
    {
        return $this->composerAutoload;
    }

    public function setComposerAutoload(
        ComposerAutoload $composerAutoload
    ) {
        $this->composerAutoload = $composerAutoload;
        return $this;
    }
}
