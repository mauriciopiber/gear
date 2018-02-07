<?php
namespace Gear\Project\Upgrade;

use Gear\Project\Upgrade\ProjectUpgradeFactory;

trait ProjectUpgradeTrait
{
    protected $projectUpgrade;

    public function getProjectUpgrade()
    {
        if (!isset($this->projectUpgrade)) {
            $name = 'Gear\Project\Upgrade\ProjectUpgrade';
            $this->projectUpgrade = $this->getServiceLocator()->get($name);
        }
        return $this->projectUpgrade;
    }

    public function setProjectUpgrade(
        ProjectUpgrade $projectUpgrade
    ) {
        $this->projectUpgrade = $projectUpgrade;
        return $this;
    }
}
