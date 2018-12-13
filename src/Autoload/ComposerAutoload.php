<?php
namespace Gear\Autoload;

use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructure;
use Zend\Json\Json;
use Gear\Locator\ModuleLocatorTrait;

class ComposerAutoload
{
    use ModuleStructureTrait;

    use ModuleLocatorTrait;

    public function __construct(ModuleStructure $module)
    {
        $this->module = $module;

        $this->fileLocation = $this->getModuleFolder().'/composer.json';

        $this->actualFile = Json::decode(file_get_contents($this->fileLocation), 1);
    }

    public function loadFile()
    {
        $this->fileLocation = $this->getModuleFolder().'/composer.json';

        $this->actualFile = Json::decode(file_get_contents($this->fileLocation), 1);
    }

    public function saveFile()
    {
        $this->fileLocation = $this->getModuleFolder().'/composer.json';

        $pretty = Json::prettyPrint(Json::encode($this->actualFile, 1));

        $pretty = str_replace('\/', '/', $pretty);
        //$pretty = str_replace('" :', '":', $pretty);

        return file_put_contents($this->fileLocation, $pretty);
    }


    public function forceReload()
    {
    }

    /**
     * Adiciona o módulo ao autoload do vendor, como se fosse adicionado pelo próprio composer.
     *
     * @return boolean
     */
    public function addModuleToProject()
    {
        $this->loadFile();

        $moduleName = $this->module->getModuleName();

        $moduleTest = sprintf('%sTest', $moduleName);

        if (isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleName***REMOVED***)
            && isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleTest***REMOVED***)
        ) {
            return false;
        }


        if (!isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleName***REMOVED***)) {
            $this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleName***REMOVED*** = sprintf('module/%s/src', $moduleName);
        }

        if (!isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleTest***REMOVED***)) {
            $this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleTest***REMOVED*** = sprintf('module/%s/test/unit', $moduleName);
        }

        $this->saveFile();

        return true;
    }

    public function removeModuleFromProject()
    {
        $this->loadFile();

        $moduleName = $this->module->getModuleName();

        $moduleTest = sprintf('%sTest', $moduleName);

        if (!isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleName***REMOVED***)
            && !isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleTest***REMOVED***)
        ) {
            return false;
        }

        if (isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleName***REMOVED***)) {
            unset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleName***REMOVED***);
        }

        if (isset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleTest***REMOVED***)) {
            unset($this->actualFile['autoload'***REMOVED***['psr-0'***REMOVED***[$moduleTest***REMOVED***);
        }

        $this->saveFile();

        return true;
    }
}
