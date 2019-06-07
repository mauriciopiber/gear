<?php
namespace Gear\Database\Connector\PhinxConnector;

use Gear\Database\Connector\PhinxConnector;

trait PhinxConnectorTrait
{
    protected $phinxConnector;

    public function getPhinxConnector()
    {
        return $this->phinxConnector;
    }

    public function setPhinxConnector(
        PhinxConnector $phinxConnector
    ) {
            $this->phinxConnector = $phinxConnector;
            return $this;
    }
}
