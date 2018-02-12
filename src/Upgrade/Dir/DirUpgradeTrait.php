<?php
namespace Gear\Upgrade\Dir;

use Gear\Upgrade\Dir\DirUpgrade;

trait DirUpgradeTrait
{
    protected $dirUpgrade;

    public function getDirUpgrade()
    {
        if (!isset($this->dirUpgrade)) {
            $name = 'Gear\Upgrade\Dir\DirUpgrade';
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
