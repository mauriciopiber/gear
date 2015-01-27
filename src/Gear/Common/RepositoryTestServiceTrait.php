<?php
namespace Gear\Common;

trait RepositoryTestServiceTrait {

    protected $repositoryTestService;

    public function getRepositoryTestService()
    {
        if (!isset($this->repositoryTestService)) {
            $this->repositoryTestService = $this->getServiceLocator()->get('repositoryTestService');
        }
        return $this->repositoryTestService;
    }

    public function setRepositoryTestService($repositoryTestService)
    {
        $this->repositoryTestService = $repositoryTestService;
        return $this;
    }

}
