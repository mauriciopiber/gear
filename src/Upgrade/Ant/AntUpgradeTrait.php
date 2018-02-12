<?php
namespace Gear\Upgrade\Ant;

use Gear\Upgrade\Ant\AntUpgradeFactory;

trait AntUpgradeTrait
{
    protected $antUpgrade;

    public function getAntUpgrade()
    {
        if (!isset($this->antUpgrade)) {
            $name = 'Gear\Upgrade\Ant\AntUpgrade';
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
