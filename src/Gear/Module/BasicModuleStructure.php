<?php
namespace Gear\Module;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use GearBase\Util\Dir\DirServiceTrait;
use GearBase\Util\Dir\DirServiceAwareInterface;
use GearBase\Util\String\StringServiceAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\ModuleAwareInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\Exception\ResourceNotFound;

class BasicModuleStructure implements ServiceLocatorAwareInterface,
 StringServiceAwareInterface,
 DirServiceAwareInterface,
 ModuleAwareInterface
{

    use ServiceLocatorAwareTrait;
    use StringServiceTrait;
    use DirServiceTrait;
    use ModuleAwareTrait;

    public function str($label, $value)
    {
        return $this->getStringService()->str($label, $value);
    }

    /**
     * MainFolder must have a full path to a module in ZF2 Gear Modules.
     * With the mainFolder you should get all modules folders inside it automatically.
     * @var string mainFolder
     */
    protected $mainFolder;
    protected $moduleName;


    public function __construct($moduleName = null)
    {
        $this->setModuleName($moduleName);
    }

    public function getRequestName()
    {
        return $this->getServiceLocator()
          ->get('application')
          ->getMvcEvent()
          ->getRequest()
          ->getParam('module');
    }

    public function prepare($moduleName = null)
    {
        if (!empty($this->getModuleName())) {
            $module = $this->getModuleName();
        } elseif (!empty($moduleName)) {
            $module = $moduleName;
        } elseif (null !== $this->getRequestName()) {
            $module = $this->getRequestName();
        } else {
            throw new \Exception('No Module Name to prepare module');
        }

        if (empty($moduleName)) {
            $moduleName = $this->getModuleName();
            if (empty($moduleName)) {
                $moduleName = $this->getModule()->getModuleName();
            }
        }

        $this->setModuleName($moduleName);

        if ($this->getMainFolder() == null) {

            $folder = $this->getBasePath();

            if (is_dir($folder.'/module')) {
                $this->setMainFolder($folder.'/module/'.$moduleName);
            } else {
                $this->setMainFolder($folder);
            }
        }


        return $this;
    }

    public function map($resource)
    {
        $resources = [
            'Service' => $this->getServiceFolder(),
            'ServiceTest' => $this->getTestServiceFolder(),
            'Repository' => $this->getRepositoryFolder(),
            'RepositoryTest' => $this->getTestRepositoryFolder(),
            'Controller' => $this->getControllerFolder(),
            'ControllerTest' => $this->getTestControllerFolder(),
            'Form' => $this->getFormFolder(),
            'FormTest' => $this->getTestFormFolder(),
            'Filter' => $this->getFilterFolder(),
            'FilterTest' => $this->getTestFilterFolder(),
            'ViewHelper' => $this->getViewHelperFolder(),
            'ViewHelperTest' => $this->getTestViewHelperFolder(),
            'SearchForm' => $this->getSearchFolder(),
        ***REMOVED***;

        if (!isset($resources[$resource***REMOVED***)) {
            throw new ResourceNotFound($resource);
        }

        return $resources[$resource***REMOVED***;
    }


    public function write()
    {
        //main
        $this->getDirService()->mkDir($this->getMainFolder());

        //script
        $this->getDirService()->mkDir($this->getScriptFolder());

        //config
        $this->getDirService()->mkDir($this->getConfigFolder());
        $this->getDirService()->mkDir($this->getConfigAutoloadFolder());
        $this->getDirService()->mkDir($this->getConfigExtFolder());


        //build
        $this->getDirService()->mkDir($this->getBuildFolder());
        $this->writable($this->getBuildFolder());
        $this->createGitIgnore($this->getBuildFolder());

        //schema
        $this->getDirService()->mkDir($this->getSchemaFolder());


        //data
        $this->getDirService()->mkDir($this->getDataFolder());
        //data/migrations
        $this->getDirService()->mkDir($this->getDataMigrationFolder());
        $this->writable($this->getDataMigrationFolder());
        //data/logs
        $this->getDirService()->mkDir($this->getDataLogsFolder());
        //data/_files
        $this->getDirService()->mkDir($this->getDataFilesFolder());
        //data/DoctrineModule
        //$this->getDirService()->mkDir($this->getDataCacheFolder());
        $this->getDirService()->mkDir($this->getDataDoctrineModuleFolder());
        $this->getDirService()->mkDir($this->getDataDoctrineModuleCacheFolder());
        $this->getDirService()->mkDir($this->getDataDoctrineORMModuleCacheFolder());
        $this->getDirService()->mkDir($this->getDataDoctrineProxyCacheFolder());

        $this->writable($this->getDataMigrationFolder());
        $this->writable($this->getDataLogsFolder());
        $this->writable($this->getDataDoctrineModuleCacheFolder());
        $this->writable($this->getDataDoctrineProxyCacheFolder());
        $this->ignoreAll($this->getDataDoctrineProxyCacheFolder());
        $this->ignoreAll($this->getDataDoctrineModuleCacheFolder());


        $this->getDirService()->mkDir($this->getLanguageFolder());
        $this->getDirService()->mkDir($this->getSrcFolder());
        $this->getDirService()->mkDir($this->getSrcModuleFolder());
        $this->getDirService()->mkDir($this->getControllerFolder());
        $this->getDirService()->mkDir($this->getSearchFolder());
        $this->getDirService()->mkDir($this->getEntityFolder());
        $this->createGitIgnore($this->getEntityFolder());
        $this->getDirService()->mkDir($this->getFactoryFolder());
        $this->getDirService()->mkDir($this->getFormFolder());
        $this->getDirService()->mkDir($this->getFilterFolder());
        $this->getDirService()->mkDir($this->getRepositoryFolder());
        $this->getDirService()->mkDir($this->getServiceFolder());


        $this->getDirService()->mkDir($this->getValueObjectFolder());
        $this->getDirService()->mkDir($this->getControllerPluginFolder());
        $this->getDirService()->mkDir($this->getFixtureFolder());
        $this->createGitIgnore($this->getFixtureFolder());

        //view
        $this->getDirService()->mkDir($this->getViewFolder());
        $this->getDirService()->mkDir($this->getViewModuleFolder());
        $this->getDirService()->mkDir($this->getViewErrorFolder());
        $this->getDirService()->mkDir($this->getViewLayoutFolder());
        $this->getDirService()->mkDir($this->getViewIndexControllerFolder());

        //public
        $this->getDirService()->mkDir($this->getPublicFolder());
        $this->getDirService()->mkDir($this->getPublicUploadFolder());
        $this->getDirService()->mkDir($this->getPublicJsFolder());
        $this->getDirService()->mkDir($this->getPublicJsAppFolder());
        $this->getDirService()->mkDir($this->getPublicJsSpecFolder());
        $this->getDirService()->mkDir($this->getPublicJsSpecUnitFolder());
        $this->getDirService()->mkDir($this->getPublicJsSpecIntegrationFolder());
        $this->getDirService()->mkDir($this->getPublicJsSpecMockFolder());
        $this->getDirService()->mkDir($this->getPublicCssFolder());
        $this->getDirService()->mkDir($this->getPublicJsControllerFolder());
        $this->writable($this->getPublicUploadFolder());
        //$this->createGitIgnore($this->getPublicJsControllerFolder());
        //test
        $this->getDirService()->mkDir($this->getTestFolder());
        $this->getDirService()->mkDir($this->getTestUnitFolder());
        $this->getDirService()->mkDir($this->getTestUnitModuleFolder());

        $this->getDirService()->mkDir($this->getPublicTempFolder());
        $this->writable($this->getPublicTempFolder());
        $this->createGitIgnore($this->getPublicTempFolder());

        $this->getDirService()->mkDir($this->getTestDataFolder());
        $this->getDirService()->mkDir($this->getTestSupportFolder());

        $this->getDirService()->mkDir($this->getTestControllerFolder());
        $this->getDirService()->mkDir($this->getTestServiceFolder());
        $this->getDirService()->mkDir($this->getTestEntityFolder());
        $this->getDirService()->mkDir($this->getTestRepositoryFolder());
        $this->getDirService()->mkDir($this->getTestFormFolder());
        $this->getDirService()->mkDir($this->getTestSearchFolder());

        $this->getDirService()->mkDir($this->getModuleViewFolder());
        $this->getDirService()->mkDir($this->getViewHelperFolder());

        $this->getDirService()->mkDir($this->getTestViewFolder());
        $this->getDirService()->mkDir($this->getTestViewHelperFolder());
        $this->getDirService()->mkDir($this->getTestFilterFolder());
        $this->getDirService()->mkDir($this->getTestFactoryFolder());
        $this->getDirService()->mkDir($this->getTestValueObjectFolder());
        $this->getDirService()->mkDir($this->getTestControllerPluginFolder());
        $this->writable($this->getTestSupportFolder());

        //language
        $this->getDirService()->mkDir($this->getLanguageRouteFolder());

        return $this;
    }

    public function writeAngular()
    {
        $this->getDirService()->mkDir($this->getMainFolder());
        $this->getDirService()->mkDir($this->getConfigFolder());
        $this->getDirService()->mkDir($this->getConfigAutoloadFolder());
        $this->getDirService()->mkDir($this->getConfigExtFolder());

        $this->getDirService()->mkDir($this->getBuildFolder());
        $this->createGitIgnore($this->getBuildFolder());
        $this->getDirService()->mkDir($this->getSchemaFolder());
        $this->getDirService()->mkDir($this->getDataFolder());
        $this->getDirService()->mkDir($this->getDataFilesFolder());
        $this->getDirService()->mkDir($this->getSrcFolder());
        $this->getDirService()->mkDir($this->getSrcModuleFolder());
        $this->getDirService()->mkDir($this->getControllerFolder());
        $this->getDirService()->mkDir($this->getTestControllerFolder());
        $this->getDirService()->mkDir($this->getViewFolder());
        $this->getDirService()->mkDir($this->getViewModuleFolder());
        $this->getDirService()->mkDir($this->getViewLayoutFolder());
        $this->getDirService()->mkDir($this->getViewIndexControllerFolder());
        $this->getDirService()->mkDir($this->getPublicFolder());
        $this->getDirService()->mkDir($this->getPublicCssFolder());
        $this->getDirService()->mkDir($this->getPublicJsFolder());
        $this->getDirService()->mkDir($this->getPublicJsAppFolder());
        $this->getDirService()->mkDir($this->getPublicJsSpecFolder());


    }



    public function getFactoryFolder()
    {
        return $this->getSrcModuleFolder().'/Factory';
    }

    public function ignoreAll($location)
    {
        $template = <<<EOS
*
!.gitignore

EOS;
        file_put_contents($location.'/.gitignore', $template);
    }



    public function createGitIgnore($location)
    {
        $template = <<<EOS
*
!*.php
!*.css
!*.phtml
!*.js
!.gitignore

EOS;
        file_put_contents($location.'/.gitignore', $template);
    }

    public function getDataDoctrineModuleFolder()
    {
        return $this->getDataFolder().'/DoctrineModule';
    }

    public function getDataDoctrineModuleCacheFolder()
    {
        return $this->getDataDoctrineModuleFolder().'/cache';
    }

    public function getDataDoctrineORMModuleCacheFolder()
    {
        return $this->getDataFolder().'/DoctrineORMModule/';
    }

    public function getDataDoctrineProxyCacheFolder()
    {
        return $this->getDataDoctrineORMModuleCacheFolder().'/Proxy';
    }

    public function writable($dir)
    {
        chmod($dir, 0777);
    }


    public function getDataMigrationFolder()
    {
        return $this->getDataFolder().'/migrations';
    }

    public function getPublicFolder()
    {
        return $this->getMainFolder().'/public';
    }

    public function getPublicUploadFolder()
    {
        return $this->getPublicFolder().'/upload';
    }

    public function getPublicJsFolder()
    {
        return $this->getPublicFolder().'/js';
    }

    public function getPublicCssFolder()
    {
        return $this->getPublicFolder().'/css';
    }

    public function getPublicJsAppFolder()
    {
        return $this->getPublicJsFolder().'/app';
    }

    public function getPublicJsSpecFolder()
    {
        return $this->getPublicJsFolder().'/spec';
    }

    public function getPublicJsSpecUnitFolder()
    {
        return $this->getPublicJsSpecFolder().'/unit';
    }

    public function getPublicJsSpecMockFolder()
    {
        return $this->getPublicJsSpecFolder().'/mock';
    }

    public function getPublicJsSpecIntegrationFolder()
    {
        return $this->getPublicJsSpecFolder().'/integration';
    }

    public function getPublicJsControllerFolder()
    {
        return $this->getPublicJsAppFolder().'/controller';
    }

    public function getModuleViewFolder()
    {
        return $this->getSrcModuleFolder().'/View';
    }

    public function getViewHelperFolder()
    {
        return $this->getModuleViewFolder().'/Helper';
    }



    public function getValueObjectFolder()
    {
        return $this->getSrcModuleFolder().'/ValueObject';
    }

    public function getTestControllerFolder()
    {
        return $this->getTestUnitModuleFolder().'/ControllerTest';
    }

    public function getTestViewFolder()
    {
        return $this->getTestUnitModuleFolder().'/ViewTest';
    }

    public function getTestViewHelperFolder()
    {
        return $this->getTestViewFolder().'/HelperTest';
    }

    public function getPublicTempFolder()
    {
        return $this->getPublicFolder().'/_temp';
    }

    public function getTestFactoryFolder()
    {
        return $this->getTestUnitModuleFolder().'/FactoryTest';
    }

    public function getTestValueObjectFolder()
    {
        return $this->getTestUnitModuleFolder().'/ValueObjectTest';
    }

    public function getControllerPluginFolder()
    {
        return $this->getControllerFolder().'/Plugin';
    }

    public function getTestControllerPluginFolder()
    {
        return $this->getTestControllerFolder().'/PluginTest';
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

    public function getSearchFolder()
    {
        return $this->getFormFolder().'/Search';
    }

    public function getEntityFolder()
    {
        return $this->getSrcModuleFolder().'/Entity';
    }

    public function getFormFolder()
    {
        return $this->getSrcModuleFolder().'/Form';
    }

    public function getTestSearchFolder()
    {
        return $this->getTestFormFolder().'/SearchTest';
    }


    public function getFixtureFolder()
    {
        return $this->getSrcModuleFolder().'/Fixture';
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
        return $this->getViewFolder().'/'.$this->str('url', $this->getModuleName());
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

    public function getBasePath()
    {
        return \GearBase\Module::getProjectFolder();
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

    public function getScriptFolder()
    {
        return $this->getMainFolder().'/script';
    }

    public function getConfigAutoloadFolder()
    {
        return $this->getConfigFolder().'/autoload';
    }

    public function getConfigExtFolder()
    {
        return $this->getConfigFolder().'/ext';
    }

    public function getConfigAclFolder()
    {
        return $this->getConfigFolder().'/acl';
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

    public function getTestAcceptanceStepsFolder()
    {
        return $this->getTestAcceptanceFolder().'/_steps';
    }

    public function getTestFunctionalStepsFolder()
    {
        return $this->getTestFunctionalFolder().'/_steps';
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

    public function getDataLogsFolder()
    {
        return $this->getDataFolder().'/logs';
    }

    public function getDataFilesFolder()
    {
        return $this->getDataFolder().'/_files';
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
