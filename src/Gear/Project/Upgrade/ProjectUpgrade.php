<?php
namespace Gear\Project\Upgrade;

use Gear\Upgrade\AbstractUpgrade;

class ProjectUpgrade extends AbstractUpgrade
{
    public function upgrade($type = 'web', $force = false)
    {
        var_dump($type);
        var_dump($force);
        //$module = $this->module->getProject();

        $this->upgrades = [***REMOVED***;

        /*
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
        */


        $this->showUpgrades();

        return true;
    }
}
