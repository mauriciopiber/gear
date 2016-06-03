<?php
namespace Gear\Upgrade;

use Gear\Upgrade\FileUpgradeFactory;

trait FileUpgradeTrait
{
    protected $fileUpgrade;

    public function getFileUpgrade()
    {
        if (!isset($this->fileUpgrade)) {
            $name = 'Gear\Upgrade\FileUpgrade';
            $this->fileUpgrade = $this->getServiceLocator()->get($name);
        }
        return $this->fileUpgrade;
    }

    public function setFileUpgrade(
        FileUpgrade $fileUpgrade
    ) {
        $this->fileUpgrade = $fileUpgrade;
        return $this;
    }
}
