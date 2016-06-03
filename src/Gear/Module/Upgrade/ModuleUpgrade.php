<?php
namespace Gear\Module\Upgrade;

use Gear\Upgrade\AbstractUpgrade;

class ModuleUpgrade extends AbstractUpgrade
{
    public function upgrade($type = 'web')
    {
        //$module = $this->module->getModule();

        $this->errors = [***REMOVED***;

        $this->errors = array_merge($this->errors, $this->getComposerUpgrade()->upgradeModule($type));
        $this->errors = array_merge($this->errors, $this->getNpmUpgrade()->upgradeModule($type));
        $this->errors = array_merge($this->errors, $this->getAntUpgrade()->upgradeModule($type));
        $this->errors = array_merge($this->errors, $this->getDirUpgrade()->upgradeModule($type));
        $this->errors = array_merge($this->errors, $this->getFileUpgrade()->upgradeModule($type));

        $this->show();

        return true;
    }
}
