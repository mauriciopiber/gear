<?php
namespace Gear\Common;

trait RepositoryServiceTrait {

    protected $repositoryService;

    public function getRepositoryService()
    {
        if (!isset($this->repositoryService)) {
            $this->repositoryService = $this->getServiceLocator()->get('repositoryService');
        }
        return $this->repositoryService;
    }

    public function setRepositoryService($repositoryService)
    {
        $this->repositoryService = $repositoryService;
        return $this;
    }
}
