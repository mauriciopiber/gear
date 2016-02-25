<?php
namespace Gear\Creator;

use Gear\Creator\SrcDependency;

trait SrcDependencyTrait
{
    protected $srcDependency;

    public function getSrcDependency()
    {
        if (!isset($this->srcDependency)) {
            $this->srcDependency = $this->getServiceLocator()->get('Gear\Creator\Src');
        }
        return $this->srcDependency;
    }

    public function setSrcDependency(SrcDependency $srcDependency)
    {
        $this->srcDependency = $srcDependency;
        return $this;
    }
}
