<?php
namespace Gear\Edge\Composer;

use Gear\Edge\Composer\ComposerEdgeFactory;

trait ComposerEdgeTrait
{
    protected $composerEdge;

    public function getComposerEdge()
    {
        return $this->composerEdge;
    }

    public function setComposerEdge(
        ComposerEdge $composerEdge
    ) {
        $this->composerEdge = $composerEdge;
        return $this;
    }
}
