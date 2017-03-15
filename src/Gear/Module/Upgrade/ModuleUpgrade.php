<?php
namespace Gear\Module\Upgrade;

use Gear\Upgrade\AbstractUpgrade;

class ModuleUpgrade extends AbstractUpgrade
{
    public function upgrade($type = 'web', $just = null, $force = false)
    {

        if ($this->checkJust($just) === false) {
            return false;
        }


        if ($just === null) {
            $this->upgrades = [***REMOVED***;

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

            $this->showUpgrades();

            return true;
        }


        switch ($just) {
            case 'composer':
                $this->upgrades = array_merge($this->upgrades, $this->getComposerUpgrade()->upgradeModule($type));
                break;

            case 'ant':
                $this->upgrades = array_merge($this->upgrades, $this->getAntUpgrade()->upgradeModule($type));
                break;

            case 'npm':
                $this->upgrades = array_merge($this->upgrades, $this->getNpmUpgrade()->upgradeModule($type));
                break;

            case 'file':
                $this->upgrades = array_merge($this->upgrades, $this->getFileUpgrade()->upgradeModule($type));
                break;

            case 'dir':
                $this->upgrades = array_merge($this->upgrades, $this->getDirUpgrade()->upgradeModule($type));
                break;
        }

        $this->showUpgrades();

        return true;
    }
}
