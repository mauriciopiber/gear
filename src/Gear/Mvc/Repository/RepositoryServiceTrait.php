<?php
namespace Gear\Mvc\Repository;

trait RepositoryServiceTrait
{
    protected $repositoryService;

    public function getRepositoryService()
    {
        if (!isset($this->repositoryService)) {
            $this->repositoryService = $this->getServiceLocator()->get('Gear\Mvc\Repository\RepositoryService');
        }
        return $this->repositoryService;
    }

    public function setRepositoryService($repositoryService)
    {
        $this->repositoryService = $repositoryService;
        return $this;
    }
}
