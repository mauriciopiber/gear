<?php
namespace Gear\Project;

trait UpgradeTrait
{
    protected $upgrade;

    public function getUpgrade()
    {
        if (!isset($this->upgrade)) {
            $this->upgrade = $this->getServiceLocator()->get('Gear\Project\Upgrade');
        }
        return $this->upgrade;
    }

    public function setUpgrade($upgrade)
    {
        $this->upgrade = $upgrade;
        return $this;
    }
}
