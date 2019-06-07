<?php
namespace Gear\Upgrade\File;

use Gear\Upgrade\File\FileUpgrade;

trait FileUpgradeTrait
{
    protected $fileUpgrade;

    public function getFileUpgrade()
    {
        return $this->fileUpgrade;
    }

    public function setFileUpgrade(
        FileUpgrade $fileUpgrade
    ) {
        $this->fileUpgrade = $fileUpgrade;
        return $this;
    }
}
