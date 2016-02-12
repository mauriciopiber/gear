<?php
namespace Gear\Project;

use Gear\Project\BuildService;

trait BuildServiceTrait
{
    protected $buildService;

    public function getBuildService()
    {
        if (!isset($this->buildService)) {
            $this->buildService = $this->getServiceLocator()->get('buildService');
        }
        return $this->buildService;
    }

    public function setBuildService(BuildService $buildService)
    {
        $this->buildService = $buildService;
        return $this;
    }
}
