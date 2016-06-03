<?php
namespace Gear\Project\Upgrade;

use Gear\Upgrade\AbstractUpgrade;

class ProjectUpgrade extends AbstractUpgrade
{
    public function upgrade($type = 'web')
    {
        //$module = $this->module->getProject();

        $this->errors = [***REMOVED***;

        $this->errors = array_merge($this->errors, $this->getComposerUpgrade()->upgradeProject($type));
        $this->errors = array_merge($this->errors, $this->getNpmUpgrade()->upgradeProject($type));
        $this->errors = array_merge($this->errors, $this->getAntUpgrade()->upgradeProject($type));
        $this->errors = array_merge($this->errors, $this->getDirUpgrade()->upgradeProject($type));
        $this->errors = array_merge($this->errors, $this->getFileUpgrade()->upgradeProject($type));

        $this->show();

        return true;
    }
}
