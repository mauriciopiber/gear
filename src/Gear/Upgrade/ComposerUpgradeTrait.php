<?php
namespace Gear\Upgrade;

use Gear\Upgrade\ComposerUpgradeFactory;

trait ComposerUpgradeTrait
{
    protected $composerUpgrade;

    public function getComposerUpgrade()
    {
        if (!isset($this->composerUpgrade)) {
            $name = 'Gear\Upgrade\ComposerUpgrade';
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
