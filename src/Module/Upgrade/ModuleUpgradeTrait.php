<?php
namespace Gear\Module\Upgrade;

use Gear\Module\Upgrade\ModuleUpgradeFactory;

trait ModuleUpgradeTrait
{
    protected $moduleUpgrade;

    public function getModuleUpgrade()
    {
        if (!isset($this->moduleUpgrade)) {
            $name = 'Gear\Module\Upgrade\ModuleUpgrade';
            $this->moduleUpgrade = $this->getServiceLocator()->get($name);
        }
        return $this->moduleUpgrade;
    }

    public function setModuleUpgrade(
        ModuleUpgrade $moduleUpgrade
    ) {
        $this->moduleUpgrade = $moduleUpgrade;
        return $this;
    }
}
