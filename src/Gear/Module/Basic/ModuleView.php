<?php
namespace Gear\Module\Basic;

class ModuleView
{
    public function __construct(\Gear\Module\BasicModule $module)
    {
        $this->module = $module;
    }
}
