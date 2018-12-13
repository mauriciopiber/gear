<?php
namespace Gear\Upgrade\Npm;

use Gear\Upgrade\Npm\NpmUpgrade;

trait NpmUpgradeTrait
{
    protected $npmUpgrade;

    public function getNpmUpgrade()
    {
        if (!isset($this->npmUpgrade)) {
            $name = 'Gear\Upgrade\Npm\NpmUpgrade';
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
