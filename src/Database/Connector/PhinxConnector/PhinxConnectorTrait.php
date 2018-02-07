<?php
namespace Gear\Database\Connector\PhinxConnector;

use Gear\Database\Connector\PhinxConnector;

trait PhinxConnectorTrait
{
    protected $phinxConnector;

    public function getPhinxConnector()
    {
        if (!isset($this->phinxConnector)) {
            $name = 'Gear\Database\PhinxConnector';
            $this->phinxConnector = $this->getServiceLocator()->get($name);
        }
        return $this->phinxConnector;
    }

    public function setPhinxConnector(
        PhinxConnector $phinxConnector
    ) {
            $this->phinxConnector = $phinxConnector;
            return $this;
    }
}
