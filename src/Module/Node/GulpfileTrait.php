<?php
namespace Gear\Module\Node;

use Gear\Module\Node\Gulpfile;

trait GulpfileTrait
{
    protected $gulpfile;

    public function getGulpfile()
    {
        return $this->gulpfile;
    }

    public function setGulpfile(Gulpfile $gulpfile)
    {
        $this->gulpfile = $gulpfile;
        return $this;
    }
}
