<?php
namespace Gear\Upgrade\Ant;

use Gear\Upgrade\Ant\AntUpgradeFactory;

trait AntUpgradeTrait
{
    protected $antUpgrade;

    public function getAntUpgrade()
    {
        return $this->antUpgrade;
    }

    public function setAntUpgrade(
        AntUpgrade $antUpgrade
    ) {
        $this->antUpgrade = $antUpgrade;
        return $this;
    }
}
