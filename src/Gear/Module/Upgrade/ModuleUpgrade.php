<?php
namespace Gear\Module\Upgrade;

use Gear\Service\AbstractJsonService;

class ModuleUpgrade extends AbstractJsonService
{
    public function upgrade($type)
    {
        return true;
    }
}
