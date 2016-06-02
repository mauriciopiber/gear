<?php
namespace Gear\Project\Upgrade;

use Gear\Service\AbstractJsonService;

class ProjectUpgrade extends AbstractJsonService
{
    public function upgrade($type)
    {
        return true;
    }
}
