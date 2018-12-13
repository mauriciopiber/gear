<?php
namespace Gear\Mvc\Repository\ColumnInterface;

interface RepositoryUpdateTestInterface
{
    public function getRepositoryTestUpdateData();

    public function getRepositoryTestUpdatePersist();

    public function getRepositoryTestUpdateHydrator();
}
