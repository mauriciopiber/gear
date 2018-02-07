<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\Repository\RepositoryService;

trait RepositoryServiceTrait
{
    protected $repositoryService;

    public function getRepositoryService()
    {
        if (!isset($this->repositoryService)) {
            $this->repositoryService = $this->getServiceLocator()->get(RepositoryService::class);
        }
        return $this->repositoryService;
    }

    public function setRepositoryService($repositoryService)
    {
        $this->repositoryService = $repositoryService;
        return $this;
    }
}
