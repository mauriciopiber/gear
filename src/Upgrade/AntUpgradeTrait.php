<?php
namespace Gear\Upgrade;

use Gear\Upgrade\AntUpgradeFactory;

trait AntUpgradeTrait
{
    protected $antUpgrade;

    public function getAntUpgrade()
    {
        if (!isset($this->antUpgrade)) {
            $name = 'Gear\Upgrade\AntUpgrade';
            $this->antUpgrade = $this->getServiceLocator()->get($name);
        }
        return $this->antUpgrade;
    }

    public function setAntUpgrade(
        AntUpgrade $antUpgrade
    ) {
        $this->antUpgrade = $antUpgrade;
        return $this;
    }
}
