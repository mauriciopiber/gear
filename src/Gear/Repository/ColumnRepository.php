<?php
namespace Gear\Repository;

use Zend\Db\Adapter\Adapter;

class ColumnRepository extends AbstractRepository
{
    public function get($nome)
    {
        $dbAdapter = new Adapter($this->getAdapter()->driver);
        $metadata = new \Zend\Db\Metadata\Metadata($dbAdapter);

        return $metadata->getColumn($nome);
    }
}
