<?php
namespace Gear\Edge\Ant;

use Gear\Edge\Ant\AntEdge;

trait AntEdgeTrait
{
    protected $antEdge;

    public function getAntEdge()
    {
        return $this->antEdge;
    }

    public function setAntEdge(
        AntEdge $antEdge
    ) {
        $this->antEdge = $antEdge;
        return $this;
    }
}
