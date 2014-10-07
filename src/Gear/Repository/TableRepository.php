<?php
namespace Gear\Repository;

use Zend\Db\Adapter\Adapter;

class TableRepository extends AbstractRepository
    implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    public function __construct($adapter)
    {
        $this->setAdapter($adapter);
    }

    public function get($nome)
    {
        $dbAdapter = new Adapter($this->getAdapter()->driver);
        $metadata = new \Zend\Db\Metadata\Metadata($dbAdapter);

        return $metadata->getTable($nome);
    }

}
