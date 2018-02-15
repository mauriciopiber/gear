<?php
namespace Gear\Module\Structure;

use Gear\Module\Structure\ModuleStructure;

interface ModuleStructureInterface
{
    /**
     * @param  Config $config
     * @return mixed
     */
    public function setModule(ModuleStructure $module);

    /**
     * @return mixed
     */
    public function getModule();
}
