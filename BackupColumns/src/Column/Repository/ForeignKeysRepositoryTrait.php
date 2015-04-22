<?php
namespace Column\Repository;

use Column\Repository\ForeignKeysRepository;

trait ForeignKeysRepositoryTrait
{
    protected $foreignKeysRepository;

    public function getForeignKeysRepository()
    {
        if (!isset($this->foreignKeysRepository)) {
            $serviceName = 'Column\Repository\ForeignKeysRepository';
            $this->foreignKeysRepository = $this->getServiceLocator()->get($serviceName);
        }
        return $this->foreignKeysRepository;
    }

    public function setForeignKeysRepository(ForeignKeysRepository $foreignKeysRepository)
    {
        $this->foreignKeysRepository = $foreignKeysRepository;
        return $this;
    }
}
