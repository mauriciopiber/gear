<?php
namespace Gear\Creator\FileCreator\AppTest;

use Gear\Creator\FileCreator\AppTest\Vars;

trait VarsTrait
{
    protected $vars;

    public function getVars()
    {
        return $this->vars;
    }

    public function setVars(
        Vars $vars
    ) {
        $this->vars = $vars;
        return $this;
    }
}
