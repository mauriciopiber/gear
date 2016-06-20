<?php
namespace Gear\Autoload;

use Gear\Autoload\ComposerAutoloadFactory;

trait ComposerAutoloadTrait
{
    protected $composerAutoload;

    public function getComposerAutoload()
    {
        if (!isset($this->composerAutoload)) {
            $name = 'Gear\Autoload\ComposerAutoload';
            $this->composerAutoload = $this->getServiceLocator()->get($name);
        }
        return $this->composerAutoload;
    }

    public function setComposerAutoload(
        ComposerAutoload $composerAutoload
    ) {
        $this->composerAutoload = $composerAutoload;
        return $this;
    }
}
