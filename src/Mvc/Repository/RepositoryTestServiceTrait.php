<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\Repository\RepositoryTestService;

trait RepositoryTestServiceTrait
{
    protected $repositoryTestService;

    public function getRepositoryTestService()
    {
        if (!isset($this->repositoryTestService)) {
            $this->repositoryTestService = $this->getServiceLocator()->get(
                RepositoryTestService::class
            );
        }
        return $this->repositoryTestService;
    }

    public function setRepositoryTestService($repositoryTest)
    {
        $this->repositoryTestService = $repositoryTest;
        return $this;
    }
}
