<?php
namespace Gear\Module\Basic;

class ModuleConfig
{
    public function __construct(\Gear\Module\BasicModule $module)
    {
        $this->module = $module;
    }
}
