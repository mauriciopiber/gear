<?php
namespace Gear\Creator;

use Gear\Creator\AppDependency;

trait AppDependencyTrait
{
    protected $appDependency;

    public function getAppDependency()
    {
        if (!isset($this->appDependency)) {
            $this->appDependency = $this->getServiceLocator()->get('Gear\Creator\App');
        }
        return $this->appDependency;
    }

    public function setAppDependency(AppDependency $appDependency)
    {
        $this->appDependency = $appDependency;
        return $this;
    }
}
