<?php
namespace Gear\Upgrade\Composer;

use Gear\Upgrade\Composer\ComposerUpgrade;

trait ComposerUpgradeTrait
{
    protected $composerUpgrade;

    public function getComposerUpgrade()
    {
        return $this->composerUpgrade;
    }

    public function setComposerUpgrade(
        ComposerUpgrade $composerUpgrade
    ) {
        $this->composerUpgrade = $composerUpgrade;
        return $this;
    }
}
