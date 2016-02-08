<?php
namespace Gear\Module;

use Gear\Module\BasicModuleStructure;

interface ModuleAwareInterface
{
    /**
     * @param  Config $config
     * @return mixed
     */
    public function setModule(BasicModuleStructure $module);

    /**
     * @return mixed
     */
    public function getModule();
}
