<?php
namespace Gear\Module\Node;

use Gear\Module\Node\Package;

trait PackageTrait
{
    protected $package;

    public function getPackage()
    {
        if (!isset($this->package)) {
            $this->package = $this->getServiceLocator()->get('Gear\Module\Node\Package');
        }
        return $this->package;
    }

    public function setPackage(Package $package)
    {
        $this->package = $package;
        return $this;
    }
}