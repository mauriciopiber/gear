<?php
namespace Gear\ValueObject;

class BasicModuleStructure
{

    /**
     * MainFolder must have a full path to a module in ZF2 Gear Modules. With the mainFolder you should get all modules folders inside it automatically.
     * @var string mainFolder
     */
    protected $mainFolder;
    protected $moduleName;

    public function __construct($module)
    {
        $folder = realpath(__DIR__."/../../../../../");
        $this->setMainFolder($folder.'/module/'.$module);
        $this->setModuleName($module);
    }

    public function getModuleName()
    {
        return $this->moduleName;
    }

    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;

        return $this;
    }

    public function getMainFolder()
    {
        return $this->mainFolder;
    }

    public function setMainFolder($mainFolder)
    {
        $this->mainFolder = $mainFolder;

        return $this;
    }

    public function getConfigFolder()
    {
        return $this->getMainFolder().'/config';
    }

    public function getConfigExtFolder()
    {
        return $this->getConfigFolder().'/ext';
    }

    public function getConfigAclFolder()
    {
        return $this->getConfigFolder().'/acl';
    }

    public function getConfigJenkinsFolder()
    {
        return $this->getConfigFolder().'/jenkins';
    }

    public function getSrcFolder()
    {

    }

    public function getViewFolder()
    {

    }

    public function getTestFolder()
    {
        return $this->getMainFolder().'/test';
    }

    public function getTestDataFolder()
    {
        return $this->getTestFolder().'/_data';
    }

    public function getTestSupportFolder()
    {
        return $this->getTestFolder().'/_support';
    }

    public function getTestAcceptanceFolder()
    {
        return $this->getTestFolder().'/acceptance';
    }

    public function getTestFunctionalFolder()
    {
        return $this->getTestFolder().'/functional';
    }

    public function getTestPagesFolder()
    {
        return $this->getTestFolder().'/Pages';
    }

    public function getTestUnitFolder()
    {
        return $this->getTestFolder().'/unit';
    }

    public function getTestUnitModuleFolder()
    {
        return $this->getTestUnitFolder().'/'.$this->getModuleName();
    }

    public function getSchemaFolder()
    {

    }

    public function getDataFolder()
    {

    }

    public function getLanguageFolder()
    {

    }
}
