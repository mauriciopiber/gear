<?php
namespace Gear\Mvc\Repository;

trait RepositoryTestServiceTrait
{
    protected $repositoryTestService;

    public function getRepositoryTestService()
    {
        if (!isset($this->repositoryTestService)) {
            $this->repositoryTestService = $this->getServiceLocator()->get(
                'Gear\Mvc\Repository\RepositoryTestService'
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
