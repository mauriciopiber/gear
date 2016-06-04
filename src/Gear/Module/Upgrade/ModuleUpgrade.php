<?php
namespace Gear\Module\Upgrade;

use Gear\Upgrade\AbstractUpgrade;

class ModuleUpgrade extends AbstractUpgrade
{
    public function upgrade($type = 'web', $force = false)
    {
        var_dump($type);
        var_dump($force);
        //$module = $this->module->getModule();

        $this->upgrades = [***REMOVED***;

        /*
        $this->upgrade1 = $this->getComposerUpgrade()->upgradeModule($type);
        $this->upgrade2 = $this->getNpmUpgrade()->upgradeModule($type);
        $this->upgrade3 = $this->getAntUpgrade()->upgradeModule($type);
        $this->upgrade4 = $this->getDirUpgrade()->upgradeModule($type);
        $this->upgrade5 = $this->getFileUpgrade()->upgradeModule($type);

        $this->upgrades = array_merge(
            $this->upgrade1,
            $this->upgrade2,
            $this->upgrade3,
            $this->upgrade4,
            $this->upgrade5
        );
        */

        $this->showUpgrades();

        return true;
    }
}
