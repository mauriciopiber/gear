<?php
namespace Gear\Upgrade\Dir;

use Gear\Upgrade\Dir\DirUpgrade;

trait DirUpgradeTrait
{
    protected $dirUpgrade;

    public function getDirUpgrade()
    {
        return $this->dirUpgrade;
    }

    public function setDirUpgrade(
        DirUpgrade $dirUpgrade
    ) {
        $this->dirUpgrade = $dirUpgrade;
        return $this;
    }
}
