<?php
namespace Gear\Upgrade\Composer;

use Gear\Upgrade\Composer\ComposerUpgrade;

trait ComposerUpgradeTrait
{
    protected $composerUpgrade;

    public function getComposerUpgrade()
    {
        if (!isset($this->composerUpgrade)) {
            $name = 'Gear\Upgrade\Composer\ComposerUpgrade';
            $this->composerUpgrade = $this->getServiceLocator()->get($name);
        }
        return $this->composerUpgrade;
    }

    public function setComposerUpgrade(
        ComposerUpgrade $composerUpgrade
    ) {
        $this->composerUpgrade = $composerUpgrade;
        return $this;
    }
}
