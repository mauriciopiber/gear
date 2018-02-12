<?php
namespace Gear\Edge\Ant;

use Gear\Edge\Ant\AntEdge;

trait AntEdgeTrait
{
    protected $antEdge;

    public function getAntEdge()
    {
        if (!isset($this->antEdge)) {
            $name = 'Gear\Edge\Ant\AntEdge';
            $this->antEdge = $this->getServiceLocator()->get($name);
        }
        return $this->antEdge;
    }

    public function setAntEdge(
        AntEdge $antEdge
    ) {
        $this->antEdge = $antEdge;
        return $this;
    }
}
