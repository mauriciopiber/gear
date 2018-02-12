<?php
namespace Gear\Upgrade\File;

use Gear\Upgrade\File\FileUpgrade;

trait FileUpgradeTrait
{
    protected $fileUpgrade;

    public function getFileUpgrade()
    {
        if (!isset($this->fileUpgrade)) {
            $name = 'Gear\Upgrade\File\FileUpgrade';
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
