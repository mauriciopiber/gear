<?php
namespace Gear\Upgrade;

use Gear\Upgrade\NpmUpgradeFactory;

trait NpmUpgradeTrait
{
    protected $npmUpgrade;

    public function getNpmUpgrade()
    {
        if (!isset($this->npmUpgrade)) {
            $name = 'Gear\Upgrade\NpmUpgrade';
            $this->npmUpgrade = $this->getServiceLocator()->get($name);
        }
        return $this->npmUpgrade;
    }

    public function setNpmUpgrade(
        NpmUpgrade $npmUpgrade
    ) {
        $this->npmUpgrade = $npmUpgrade;
        return $this;
    }
}
