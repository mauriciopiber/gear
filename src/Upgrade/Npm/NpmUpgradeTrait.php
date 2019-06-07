<?php
namespace Gear\Upgrade\Npm;

use Gear\Upgrade\Npm\NpmUpgrade;

trait NpmUpgradeTrait
{
    protected $npmUpgrade;

    public function getNpmUpgrade()
    {
        return $this->npmUpgrade;
    }

    public function setNpmUpgrade(
        NpmUpgrade $npmUpgrade
    ) {
        $this->npmUpgrade = $npmUpgrade;
        return $this;
    }
}
