<?php
namespace Gear\Module\Node;

use Gear\Module\Node\Gulpfile;

trait GulpfileTrait
{
    protected $gulpfile;

    public function getGulpfile()
    {
        if (!isset($this->gulpfile)) {
            $this->gulpfile = $this->getServiceLocator()->get('Gear\Module\Node\Gulpfile');
        }
        return $this->gulpfile;
    }

    public function setGulpfile(Gulpfile $gulpfile)
    {
        $this->gulpfile = $gulpfile;
        return $this;
    }
}
