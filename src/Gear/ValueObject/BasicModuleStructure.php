<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractValueObject;

class BasicModuleStructure extends AbstractValueObject
{
    /**
     * MainFolder must have a full path to a module in ZF2 Gear Modules. With the mainFolder you should get all modules folders inside it automatically.
     * @var string mainFolder
     */
    protected $mainFolder;
    protected $moduleName;


    public function __construct()
    {
        parent::__construct();
    }

    public function prepare()
    {
        $folder = $this->getBasePath();
        $this->setMainFolder($folder.'/module/'.$this->getConfig()->getModule());
        $this->setModuleName($this->getConfig()->getModule());
        return $this;
    }

    public function getFactoryFolder()
    {
        return $this->getSrcModuleFolder().'/Factory';
    }

    public function write()
    {
        $this->getDirService()->mkDir($this->getMainFolder());
        $this->getDirService()->mkDir($this->getConfigFolder());
        $this->getDirService()->mkDir($this->getConfigAclFolder());
        $this->getDirService()->mkDir($this->getConfigExtFolder());
        $this->getDirService()->mkDir($this->getConfigJenkinsFolder());
        $this->getDirService()->mkDir($this->getBuildFolder());
        $this->getDirService()->mkDir($this->getSchemaFolder());
        $this->getDirService()->mkDir($this->getDataFolder());
        $this->getDirService()->mkDir($this->getLanguageFolder());
        $this->getDirService()->mkDir($this->getSrcFolder());
        $this->getDirService()->mkDir($this->getSrcModuleFolder());
        $this->getDirService()->mkDir($this->getControllerFolder());
        $this->getDirService()->mkDir($this->getEntityFolder());
        $this->getDirService()->mkDir($this->getFactoryFolder());
        $this->getDirService()->mkDir($this->getFormFolder());
        $this->getDirService()->mkDir($this->getFilterFolder());
        $this->getDirService()->mkDir($this->getRepositoryFolder());
        $this->getDirService()->mkDir($this->getServiceFolder());
        $this->getDirService()->mkDir($this->getValueObjectFolder());
        $this->getDirService()->mkDir($this->getViewFolder());
        $this->getDirService()->mkDir($this->getViewModuleFolder());
        $this->getDirService()->mkDir($this->getViewErrorFolder());
        $this->getDirService()->mkDir($this->getViewLayoutFolder());
        $this->getDirService()->mkDir($this->getViewIndexControllerFolder());
        $this->getDirService()->mkDir($this->getTestFolder());
        $this->getDirService()->mkDir($this->getTestDataFolder());
        $this->getDirService()->mkDir($this->getTestSupportFolder());
        $this->getDirService()->mkDir($this->getTestPagesFolder());
        $this->getDirService()->mkDir($this->getTestAcceptanceFolder());
        $this->getDirService()->mkDir($this->getTestFunctionalFolder());
        $this->getDirService()->mkDir($this->getTestUnitFolder());
        $this->getDirService()->mkDir($this->getTestUnitModuleFolder());
        $this->getDirService()->mkDir($this->getTestControllerFolder());
        $this->getDirService()->mkDir($this->getTestServiceFolder());
        $this->getDirService()->mkDir($this->getPublicFolder());
        $this->getDirService()->mkDir($this->getTestEntityFolder());
        $this->getDirService()->mkDir($this->getTestRepositoryFolder());
        $this->getDirService()->mkDir($this->getTestFormFolder());
        $this->getDirService()->mkDir($this->getTestFilterFolder());
        $this->getDirService()->mkDir($this->getTestFactoryFolder());
        $this->getDirService()->mkDir($this->getTestValueObjectFolder());
        $this->getDirService()->mkDir($this->getTestControllerPluginFolder());
        $this->getDirService()->mkDir($this->getLanguageRouteFolder());
        $this->getDirService()->mkDir($this->getControllerPluginFolder());
        return $this;
    }

    public function getPublicFolder()
    {
        return $this->getMainFolder().'/public';
    }

    public function getValueObjectFolder()
    {
        return $this->getSrcModuleFolder().'/ValueObject';
    }

    public function getTestControllerFolder()
    {
        return $this->getTestUnitModuleFolder().'/ControllerTest';
    }

    public function getTestFactoryFolder()
    {
        return $this->getTestUnitModuleFolder().'/FactoryTest';
    }

    public function getTestValueObjectFolder()
    {
        return $this->getTestUnitModuleFolder().'/ValueObjectTest';
    }

    public function getTestControllerPluginFolder()
    {
        return $this->getTestControllerFolder().'/PluginTest';
    }

    public function getControllerPluginFolder()
    {
        return $this->getControllerFolder().'/Plugin';
    }

    public function getTestEntityFolder()
    {
        return $this->getTestUnitModuleFolder().'/EntityTest';
    }

    public function getTestRepositoryFolder()
    {
        return $this->getTestUnitModuleFolder().'/RepositoryTest';
    }

    public function getTestFormFolder()
    {
        return $this->getTestUnitModuleFolder().'/FormTest';
    }

    public function getTestFilterFolder()
    {
        return $this->getTestUnitModuleFolder().'/FilterTest';
    }

    public function getTestServiceFolder()
    {
        return $this->getTestUnitModuleFolder().'/ServiceTest';
    }

    public function getControllerFolder()
    {
        return $this->getSrcModuleFolder().'/Controller';
    }

    public function getServiceFolder()
    {
        return $this->getSrcModuleFolder().'/Service';
    }

    public function getEntityFolder()
    {
        return $this->getSrcModuleFolder().'/Entity';
    }

    public function getFormFolder()
    {
        return $this->getSrcModuleFolder().'/Form';
    }

    public function getRepositoryFolder()
    {
        return $this->getSrcModuleFolder().'/Repository';
    }

    public function getViewErrorFolder()
    {
        return $this->getViewFolder().'/error';
    }

    public function getViewLayoutFolder()
    {
        return $this->getViewFolder().'/layout';
    }

    public function getViewModuleFolder()
    {
        return $this->getViewFolder().'/'.$this->str('url', $this->getConfig()->getModule());
    }

    public function getViewIndexControllerFolder()
    {
        return $this->getViewModuleFolder().'/index';
    }


    public function getFilterFolder()
    {
        return $this->getSrcModuleFolder().'/Filter';
    }

    public function getSrcModuleFolder()
    {
        return $this->getSrcFolder().'/'.$this->getModuleName();
    }

    public function  getBasePath()
    {
        $folder = realpath(__DIR__."/../../../../../");
        $folderCheck = $folder.'/module';

        if (is_dir($folderCheck)) {
            return $folder;
        }

        $folderVendor = realpath(__DIR__."/../../../../../../");
        $folderCheck = $folderVendor.'/module';

        if (is_dir($folderCheck)) {
            return $folderVendor;
        }

        throw new \Exception('Gear can\'t find module folder');
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

    public function getBuildFolder()
    {
        return $this->getMainFolder().'/build';
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

    public function getSchema()
    {
        return $this->getMainFolder().'/schema';
    }



    public function getSrcFolder()
    {
        return $this->getMainFolder().'/src';
    }

    public function getViewFolder()
    {
        return $this->getMainFolder().'/view';
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
        return $this->getTestUnitFolder().'/'.$this->getModuleName().'Test';
    }

    public function getSchemaFolder()
    {
        return $this->getMainFolder().'/schema';
    }

    public function getDataFolder()
    {
        return $this->getMainFolder().'/data';
    }

    public function getLanguageFolder()
    {
        return $this->getMainFolder().'/language';
    }

    public function getLanguageRouteFolder()
    {
        return $this->getLanguageFolder().'/route';
    }
}
