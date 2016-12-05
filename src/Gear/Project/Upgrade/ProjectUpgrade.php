<?php
namespace Gear\Project\Upgrade;

use Gear\Upgrade\AbstractUpgrade;

class ProjectUpgrade extends AbstractUpgrade
{
    public function upgrade($type = 'web', $just = null, $force = false)
    {
        //$module = $this->module->getProject();
        if ($this->checkJust($just) === false) {
            return false;
        }


        if ($just === null) {

            $this->upgrades = [***REMOVED***;

            $this->upgrade1 = $this->getComposerUpgrade()->upgradeProject($type);
            $this->upgrade2 = $this->getNpmUpgrade()->upgradeProject($type);
            $this->upgrade3 = $this->getAntUpgrade()->upgradeProject($type);
            $this->upgrade4 = $this->getDirUpgrade()->upgradeProject($type);
            $this->upgrade5 = $this->getFileUpgrade()->upgradeProject($type);

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
                $this->upgrades = array_merge($this->upgrades, $this->getComposerUpgrade()->upgradeProject($type));
                break;

            case 'ant':
                $this->upgrades = array_merge($this->upgrades, $this->getAntUpgrade()->upgradeProject($type));
                break;

            case 'npm':
                $this->upgrades = array_merge($this->upgrades, $this->getNpmUpgrade()->upgradeProject($type));
                break;

            case 'file':
                $this->upgrades = array_merge($this->upgrades, $this->getFileUpgrade()->upgradeProject($type));
                break;

            case 'dir':
                $this->upgrades = array_merge($this->upgrades, $this->getDirUpgrade()->upgradeProject($type));
                break;

        }

        $this->showUpgrades();

        return true;
    }
}
