<?php
namespace Gear\Module\Upgrade;

use Gear\Module\Upgrade\ModuleUpgradeFactory;

trait ModuleUpgradeTrait
{
    protected $moduleUpgrade;

    public function getModuleUpgrade()
    {
        return $this->moduleUpgrade;
    }

    public function setModuleUpgrade(
        ModuleUpgrade $moduleUpgrade
    ) {
        $this->moduleUpgrade = $moduleUpgrade;
        return $this;
    }
}
