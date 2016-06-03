<?php
namespace Gear\Upgrade;

use Gear\Upgrade\DirUpgradeFactory;

trait DirUpgradeTrait
{
    protected $dirUpgrade;

    public function getDirUpgrade()
    {
        if (!isset($this->dirUpgrade)) {
            $name = 'Gear\Upgrade\DirUpgrade';
            $this->dirUpgrade = $this->getServiceLocator()->get($name);
        }
        return $this->dirUpgrade;
    }

    public function setDirUpgrade(
        DirUpgrade $dirUpgrade
    ) {
        $this->dirUpgrade = $dirUpgrade;
        return $this;
    }
}
