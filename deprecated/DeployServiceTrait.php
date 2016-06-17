<?php
namespace Gear\Project;

trait DeployServiceTrait
{
    protected $deployService;

    public function setDeployService($deployService)
    {
        $this->deployService = $deployService;
    }

    public function getDeployService()
    {
        if (!isset($this->deployService)) {
            $this->deployService = $this->getServiceLocator()->get('Gear\Service\Deploy');
        }
        return $this->deployService;
    }
}
