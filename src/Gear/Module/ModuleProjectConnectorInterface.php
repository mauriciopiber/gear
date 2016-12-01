<?php
namespace Gear\Module;

interface ModuleProjectConnectorInterface
{
    public function addModuleToProject();

    public function removeModuleFromProject();
}
