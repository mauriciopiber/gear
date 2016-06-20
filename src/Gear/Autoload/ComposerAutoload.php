<?php
namespace Gear\Autoload;

use Gear\Module\ModuleAwareTrait;
use Gear\Module\BasicModuleStructure;

class ComposerAutoload
{
    use ModuleAwareTrait;

    public function __construct(BasicModuleStructure $module)
    {
        $this->module = $module;
    }

    /**
     * Adiciona o módulo ao autoload do vendor, como se fosse adicionado pelo próprio composer.
     *
     * @return boolean
     */
    public function dumpModule()
    {
        $src  = str_replace(\GearBase\Module::getProjectFolder(), '', $this->getModule()->getMainFolder().'/src');
        $unit = str_replace(\GearBase\Module::getProjectFolder(), '', $this->getModule()->getMainFolder().'/test/unit');

        $autoloadNamespace = new \Gear\Autoload\Namespaces();
        $autoloadNamespace
        ->addNamespaceIntoComposer($this->getModule()->getModuleName(), $src)
        ->addNamespaceIntoComposer($this->getModule()->getModuleName().'Test', $unit)
        ->write();
        return true;
    }
}
