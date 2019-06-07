<?php
namespace Gear\Mvc\Repository;

use Gear\Mvc\Repository\RepositoryTestService;

trait RepositoryTestServiceTrait
{
    protected $repositoryTestService;

    public function getRepositoryTestService()
    {
        return $this->repositoryTestService;
    }

    public function setRepositoryTestService($repositoryTest)
    {
        $this->repositoryTestService = $repositoryTest;
        return $this;
    }
}
