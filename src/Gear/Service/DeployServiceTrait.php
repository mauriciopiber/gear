<?php
namespace Gear\Service;

trait DeployServiceTrait {

    protected $deployService;

    public function getDeployService()
    {
        if (!isset($this->deployService)) {
            $this->deployService = $this->getServiceLocator()->get('Gear\Service\Deploy');
        }
        return $this->deployService;
    }

    public function setDeployService($deployService)
    {
        $this->deployService = $deployService;
        return $this;
    }
}
