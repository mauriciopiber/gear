<?php
namespace Gear\Module\Structure;

use Gear\Util\File\FileServiceTrait;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\File\FileService;
use Gear\Util\Dir\DirService;
use Gear\Util\String\StringService;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Exception\ResourceNotFound;
use Gear\Module\ModuleTypesInterface;
use Gear\Locator\ModuleLocatorTrait;

class ModuleStructure
{
    use ModuleLocatorTrait;
    use FileServiceTrait;
    use StringServiceTrait;
    use DirServiceTrait;
    use ModuleStructureTrait;

    /**
     * MainFolder must have a full path to a module in ZF2 Gear Modules.
     * With the mainFolder you should get all modules folders inside it automatically.
     *
     * @var string mainFolder
     */
    protected $mainFolder;

    public $requestName;

    protected $moduleName;

    protected $type;

    protected $namespace;

    protected $staging;

    public $basePath;


    public function __construct(
        StringService $stringService,
        DirService $dirService,
        FileService $fileService
    ) {
        $this->stringService = $stringService;
        $this->dirService = $dirService;
        $this->fileService = $fileService;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function getNamespace()
    {
        if (empty($this->namespace)) {
            return $this->moduleName;
        }
        return $this->namespace;
    }

    public function setStaging($staging)
    {
        $this->staging = $staging;
        return $this;
    }

    public function getStaging()
    {
        return $this->staging;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getRequestName()
    {
        if (! isset($this->requestName)) {
            $this->requestName = $this->getServiceLocator()
                ->get('application')
                ->getMvcEvent()
                ->getRequest()
                ->getParam('module');
        }

        return $this->requestName;
    }

    public function setRequestName($requestName)
    {
        $this->requestName = $requestName;
        return $this;
    }

    public function str($label, $value)
    {
        return $this->getStringService()->str($label, $value);
    }

    public function prepare($moduleName = null, $type = 'web')
    {
        if ($this->getType() === null) {
            $this->setType($type);
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

            if (is_dir($folder . '/module')) {
                $this->setMainFolder($folder . '/module/' . $moduleName);
            } else {
                $this->setMainFolder($folder);
            }
        }

        return $this;
    }

    /**
     * Aliase => Folder
     */
    public function map($resource)
    {
        $resources = [
            'AppServiceSpec' => $this->getPublicJsServiceSpecFolder(),
            'AppService' => $this->getPublicJsServiceFolder(),
            'AppControllerSpec' => $this->getPublicJsControllerSpecFolder(),
            'AppController' => $this->getPublicJsControllerFolder(),
            'Service' => $this->getServiceFolder(),
            'ServiceTest' => $this->getTestServiceFolder(),
            'Repository' => $this->getRepositoryFolder(),
            'RepositoryTest' => $this->getTestRepositoryFolder(),
            'Controller' => $this->getControllerFolder(),
            'ControllerTest' => $this->getTestControllerFolder(),
            'ControllerPlugin' => $this->getControllerPluginFolder(),
            'ControllerPluginTest' => $this->getTestControllerPluginFolder(),
            'Form' => $this->getFormFolder(),
            'FormTest' => $this->getTestFormFolder(),
            'Filter' => $this->getFilterFolder(),
            'FilterTest' => $this->getTestFilterFolder(),
            'ViewHelper' => $this->getViewHelperFolder(),
            'ViewHelperTest' => $this->getTestViewHelperFolder(),
            'SearchForm' => $this->getSearchFolder(),
            'SearchFormTest' => $this->getTestSearchFolder(),
            'ValueObject' => $this->getValueObjectFolder(),
            'ValueObjectTest' => $this->getTestValueObjectFolder(),
            'Interface' => $this->getInterfaceFolder()
        ***REMOVED***;

        if (! isset($resources[$resource***REMOVED***)) {
            throw new ResourceNotFound($resource);
        }

        return $resources[$resource***REMOVED***;
    }

    public function getInterfaceFolder()
    {
        return $this->getSrcModuleFolder() . '/Interfaces';
    }

    public function write()
    {
        // main
        $this->getDirService()->mkDir($this->getMainFolder());

        $this->getDirService()->mkDir($this->getDocsFolder());
        // script

        $this->getDirService()->mkDir($this->getScriptFolder());

        // config
        $this->getDirService()->mkDir($this->getConfigFolder());
        $this->getDirService()->mkDir($this->getConfigAutoloadFolder());
        $this->getDirService()->mkDir($this->getConfigExtFolder());

        // build
        $this->getDirService()->mkDir($this->getBuildFolder());
        $this->getDirService()->writable($this->getBuildFolder());
        $this->createGitIgnore($this->getBuildFolder());

        $this->getDirService()->mkDir($this->getSrcFolder());
        $this->getDirService()->mkDir($this->getSrcModuleFolder());

        $this->getDirService()->mkDir($this->getTestFolder());
        $this->getDirService()->mkDir($this->getTestUnitFolder());
        $this->getDirService()->mkDir($this->getTestUnitModuleFolder());

        $this->getDirService()->mkDir($this->getDataFolder());
        // schema
        if (in_array($this->getType(), [
            ModuleTypesInterface::WEB,
            ModuleTypesInterface::CLI,
            ModuleTypesInterface::API
        ***REMOVED***)) {
            $this->getDirService()->mkDir($this->getSchemaFolder());

            $this->getDirService()->mkDir($this->getSessionFolder());
            $this->getDirService()->writable($this->getSessionFolder());
            $this->createGitIgnore($this->getSessionFolder());

            // data/logs
            $this->getDirService()->mkDir($this->getDataLogsFolder());
            $this->getDirService()->writable($this->getDataLogsFolder());
            $this->createGitIgnore($this->getDataLogsFolder());

            // data/DoctrineModule
            // $this->getDirService()->mkDir($this->getDataCacheFolder());
            $this->getDirService()->mkDir($this->getDataDoctrineModuleFolder());


            $this->getDirService()->mkDir($this->getDataDoctrineModuleCacheFolder());
            $this->getDirService()->writable($this->getDataDoctrineModuleCacheFolder());


            $this->getDirService()->mkDir($this->getDataDoctrineORMModuleCacheFolder());

            $this->getDirService()->mkDir($this->getDataDoctrineProxyCacheFolder());
            $this->getDirService()->writable($this->getDataDoctrineProxyCacheFolder());


            $this->ignoreAll($this->getDataDoctrineProxyCacheFolder());
            $this->ignoreAll($this->getDataDoctrineModuleCacheFolder());

            $this->getDirService()->mkDir($this->getControllerFolder());
            $this->getDirService()->mkDir($this->getEntityFolder());
            $this->createGitIgnore($this->getEntityFolder());
            //$this->getDirService()->mkDir($this->getFactoryFolder());
            $this->getDirService()->mkDir($this->getFormFolder());
            $this->getDirService()->mkDir($this->getFilterFolder());
            $this->getDirService()->mkDir($this->getRepositoryFolder());
            $this->getDirService()->mkDir($this->getServiceFolder());

            $this->getDirService()->mkDir($this->getValueObjectFolder());
            $this->getDirService()->mkDir($this->getControllerPluginFolder());
            $this->getDirService()->mkDir($this->getFixtureFolder());
            $this->createGitIgnore($this->getFixtureFolder());

            $this->getDirService()->mkDir($this->getTestControllerFolder());
            $this->getDirService()->mkDir($this->getTestServiceFolder());
            $this->getDirService()->mkDir($this->getTestEntityFolder());
            $this->getDirService()->mkDir($this->getTestRepositoryFolder());
            $this->getDirService()->mkDir($this->getTestFormFolder());

            if ($this->getType() === ModuleTypesInterface::WEB) {
                $this->getDirService()->mkDir($this->getTestSearchFolder());
            }

            $this->getDirService()->mkDir($this->getTestFilterFolder());
            //$this->getDirService()->mkDir($this->getTestFactoryFolder());
            $this->getDirService()->mkDir($this->getTestValueObjectFolder());
            $this->getDirService()->mkDir($this->getTestControllerPluginFolder());


            $this->getDirService()->mkDir($this->getDataCacheFolder());
            $this->getDirService()->mkDir($this->getDataCacheConfigFolder());
            $this->getDirService()->writable($this->getDataCacheConfigFolder());
            $this->createGitIgnore($this->getDataCacheConfigFolder());
        }


        if (in_array($this->getType(), [
            ModuleTypesInterface::WEB,
            ModuleTypesInterface::API
        ***REMOVED***)) {
            $this->getDirService()->mkDir($this->getDataMigrationFolder());
            $this->getDirService()->writable($this->getDataMigrationFolder());
            $this->getDirService()->mkDir($this->getDataFilesFolder());
        }


        if ($this->getType() === ModuleTypesInterface::WEB) {
            $this->getDirService()->mkDir($this->getSearchFolder());
        }


        if ($this->getType() === ModuleTypesInterface::WEB) {
            $this->getDirService()->mkDir($this->getViewFolder());
            $this->getDirService()->mkDir($this->getViewModuleFolder());
            $this->getDirService()->mkDir($this->getViewErrorFolder());
            $this->getDirService()->mkDir($this->getViewLayoutFolder());
            $this->getDirService()->mkDir($this->getViewIndexControllerFolder());
        }
        // view

        // public
        $this->getDirService()->mkDir($this->getPublicFolder());

        if ($this->getType() === ModuleTypesInterface::WEB) {

            $this->getDirService()->mkDir($this->getPublicUploadFolder());
            $this->getDirService()->writable($this->getPublicUploadFolder());

            $this->getDirService()->mkDir($this->getPublicJsFolder());
            $this->getDirService()->mkDir($this->getPublicJsAppFolder());
            $this->getDirService()->mkDir($this->getPublicJsSpecFolder());
            $this->getDirService()->mkDir($this->getPublicJsSpecUnitFolder());
            $this->getDirService()->mkDir($this->getPublicJsSpecEndFolder());
            $this->getDirService()->mkDir($this->getPublicJsSpecEndFolder() . '/index');
            $this->getDirService()->mkDir($this->getPublicJsSpecEndSupportFolder() . '/index');
            $this->getDirService()->mkDir($this->getPublicJsSpecIntegrationFolder());
            $this->getDirService()->mkDir($this->getPublicJsSpecMockFolder());
            $this->getDirService()->mkDir($this->getPublicCssFolder());
            $this->getDirService()->mkDir($this->getPublicJsControllerFolder());
            $this->getDirService()->mkDir($this->getPublicJsServiceFolder());
            $this->getDirService()->mkDir($this->getPublicJsControllerSpecFolder());
            $this->getDirService()->mkDir($this->getPublicJsServiceSpecFolder());


            $this->getDirService()->mkDir($this->getPublicTempFolder());
            $this->getDirService()->writable($this->getPublicTempFolder());

            $this->createGitIgnore($this->getPublicTempFolder());
        }
        // $this->createGitIgnore($this->getPublicJsControllerFolder());
        // test

        $this->getDirService()->mkDir($this->getTestDataFolder());
        $this->getDirService()->mkDir($this->getTestSupportFolder());
        $this->getDirService()->writable($this->getTestSupportFolder());

        if ($this->getType() === ModuleTypesInterface::WEB) {
            $this->getDirService()->mkDir($this->getModuleViewFolder());
            $this->getDirService()->mkDir($this->getViewHelperFolder());
            $this->getDirService()->mkDir($this->getTestViewFolder());
            $this->getDirService()->mkDir($this->getTestViewHelperFolder());
        }


        if (in_array($this->getType(), [ModuleTypesInterface::WEB, ModuleTypesInterface::API***REMOVED***)) {
            $this->getDirService()->mkDir($this->getLanguageFolder());
            $this->getDirService()->mkDir($this->getLanguageRouteFolder());
        }

        if ($this->getType() === ModuleTypesInterface::WEB) {
            $this->getDirService()->mkDir($this->getNodejsFolder());
            $this->getDirService()->writable($this->getNodejsFolder());
            $this->createGitIgnore($this->getNodejsFolder());
        }

        return $this;
    }

    /*
      * public function getFactoryFolder()
      * {
      * return $this->getSrcModuleFolder() . '/Factory';
      * }
    */
    public function ignoreAll($location)
    {
        $template = <<<EOS
*
!.gitignore

EOS;
        $this->getFileService()->factory($location, '.gitignore', $template);
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

        $this->getFileService()->factory($location, '.gitignore', $template);
    }

    public function getDataDoctrineModuleFolder()
    {
        return $this->getDataFolder() . '/DoctrineModule';
    }

    public function getDataDoctrineModuleCacheFolder()
    {
        return $this->getDataDoctrineModuleFolder() . '/cache';
    }

    public function getDataDoctrineORMModuleCacheFolder()
    {
        return $this->getDataFolder() . '/DoctrineORMModule';
    }

    public function getDataDoctrineProxyCacheFolder()
    {
        return $this->getDataDoctrineORMModuleCacheFolder() . '/Proxy';
    }

    public function getDataCacheFolder()
    {
        return $this->getDataFolder() . '/cache';
    }

    public function getDataCacheConfigFolder()
    {
        return $this->getDataCacheFolder() . '/configcache';
    }

    public function getNodejsFolder()
    {
        return $this->getMainFolder() . '/node_modules';
    }

    public function getDocsFolder()
    {
        return $this->getMainFolder() . '/docs';
    }

    public function writable($dir)
    {
        chmod($dir, 0777);
    }

    public function getDataMigrationFolder()
    {
        return $this->getDataFolder() . '/migrations';
    }

    public function getJenkinsFolder()
    {
        return $this->getMainFolder() . '/jenkins';
    }

    public function getPublicFolder()
    {
        return $this->getMainFolder() . '/public';
    }

    public function getPublicInfoFolder()
    {
        return $this->getPublicFolder() . '/info';
    }

    public function getPublicUploadFolder()
    {
        return $this->getPublicFolder() . '/upload';
    }

    public function getPublicJsFolder()
    {
        return $this->getPublicFolder() . '/js';
    }

    public function getPublicCssFolder()
    {
        return $this->getPublicFolder() . '/css';
    }

    public function getPublicJsAppFolder()
    {
        return $this->getPublicJsFolder() . '/app';
    }

    public function getPublicJsSpecFolder()
    {
        return $this->getPublicJsFolder() . '/spec';
    }

    public function getPublicJsSpecUnitFolder()
    {
        return $this->getPublicJsSpecFolder() . '/unit';
    }

    public function getPublicJsSpecEndFolder()
    {
        return $this->getPublicJsSpecFolder() . '/e2e';
    }

    public function getPublicJsSpecEndSupportFolder()
    {
        return $this->getPublicJsSpecEndFolder() . '/support';
    }

    public function getPublicJsSpecMockFolder()
    {
        return $this->getPublicJsSpecFolder() . '/mock';
    }

    public function getPublicJsSpecIntegrationFolder()
    {
        return $this->getPublicJsSpecFolder() . '/integration';
    }

    public function getPublicJsControllerSpecFolder()
    {
        return $this->getPublicJsSpecUnitFolder() . '/controllerSpec';
    }

    public function getPublicJsServiceSpecFolder()
    {
        return $this->getPublicJsSpecUnitFolder() . '/serviceSpec';
    }

    public function getPublicJsControllerFolder()
    {
        return $this->getPublicJsAppFolder() . '/controller';
    }

    public function getPublicJsServiceFolder()
    {
        return $this->getPublicJsAppFolder() . '/service';
    }

    public function getModuleViewFolder()
    {
        return $this->getSrcModuleFolder() . '/View';
    }

    public function getViewHelperFolder()
    {
        return $this->getModuleViewFolder() . '/Helper';
    }

    public function getValueObjectFolder()
    {
        return $this->getSrcModuleFolder() . '/ValueObject';
    }

    public function getTestControllerFolder()
    {
        return $this->getTestUnitModuleFolder() . '/ControllerTest';
    }

    public function getTestViewFolder()
    {
        return $this->getTestUnitModuleFolder() . '/ViewTest';
    }

    public function getTestViewHelperFolder()
    {
        return $this->getTestViewFolder() . '/HelperTest';
    }

    public function getPublicTempFolder()
    {
        return $this->getPublicFolder() . '/_temp';
    }

    /**
    public function getTestFactoryFolder()
    {
        return $this->getTestUnitModuleFolder() . '/FactoryTest';
    }
    */

    public function getTestValueObjectFolder()
    {
        return $this->getTestUnitModuleFolder() . '/ValueObjectTest';
    }

    public function getControllerPluginFolder()
    {
        return $this->getControllerFolder() . '/Plugin';
    }

    public function getTestControllerPluginFolder()
    {
        return $this->getTestControllerFolder() . '/PluginTest';
    }

    public function getTestEntityFolder()
    {
        return $this->getTestUnitModuleFolder() . '/EntityTest';
    }

    public function getTestRepositoryFolder()
    {
        return $this->getTestUnitModuleFolder() . '/RepositoryTest';
    }

    public function getTestFormFolder()
    {
        return $this->getTestUnitModuleFolder() . '/FormTest';
    }

    public function getTestFilterFolder()
    {
        return $this->getTestUnitModuleFolder() . '/FilterTest';
    }

    public function getTestServiceFolder()
    {
        return $this->getTestUnitModuleFolder() . '/ServiceTest';
    }

    public function getControllerFolder()
    {
        return $this->getSrcModuleFolder() . '/Controller';
    }

    public function getServiceFolder()
    {
        return $this->getSrcModuleFolder() . '/Service';
    }

    public function getSearchFolder()
    {
        return $this->getFormFolder() . '/Search';
    }

    public function getEntityFolder()
    {
        return $this->getSrcModuleFolder() . '/Entity';
    }

    public function getFormFolder()
    {
        return $this->getSrcModuleFolder() . '/Form';
    }

    public function getTestSearchFolder()
    {
        return $this->getTestFormFolder() . '/SearchTest';
    }

    public function getFixtureFolder()
    {
        return $this->getSrcModuleFolder() . '/Fixture';
    }

    public function getRepositoryFolder()
    {
        return $this->getSrcModuleFolder() . '/Repository';
    }

    public function getViewErrorFolder()
    {
        return $this->getViewFolder() . '/error';
    }

    public function getViewLayoutFolder()
    {
        return $this->getViewFolder() . '/layout';
    }

    public function getViewModuleFolder()
    {
        return $this->getViewFolder() . '/' . $this->str('url', $this->getModuleName());
    }

    public function getViewIndexControllerFolder()
    {
        return $this->getViewModuleFolder() . '/index';
    }

    public function getFilterFolder()
    {
        return $this->getSrcModuleFolder() . '/Filter';
    }

    public function getSrcModuleFolder()
    {
        return $this->getSrcFolder();
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }

    public function getBasePath()
    {
        if (! isset($this->basePath)) {
            $this->basePath = $this->getModuleFolder();
        }
        return $this->basePath;
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
        return $this->getMainFolder() . '/build';
    }

    public function getConfigFolder()
    {
        return $this->getMainFolder() . '/config';
    }

    public function getScriptFolder()
    {
        return $this->getMainFolder() . '/script';
    }

    public function getConfigAutoloadFolder()
    {
        return $this->getConfigFolder() . '/autoload';
    }

    public function getConfigExtFolder()
    {
        return $this->getConfigFolder() . '/ext';
    }

    public function getConfigAclFolder()
    {
        return $this->getConfigFolder() . '/acl';
    }

    public function getSchema()
    {
        return $this->getMainFolder() . '/schema';
    }

    public function getSrcFolder()
    {
        return $this->getMainFolder() . '/src';
    }

    public function getViewFolder()
    {
        return $this->getMainFolder() . '/view';
    }

    public function getTestFolder()
    {
        return $this->getMainFolder() . '/test';
    }

    public function getTestDataFolder()
    {
        return $this->getTestFolder() . '/_data';
    }

    public function getTestSupportFolder()
    {
        return $this->getTestFolder() . '/_support';
    }

    public function getTestAcceptanceFolder()
    {
        return $this->getTestFolder() . '/acceptance';
    }

    public function getTestFunctionalFolder()
    {
        return $this->getTestFolder() . '/functional';
    }

    public function getTestAcceptanceStepsFolder()
    {
        return $this->getTestAcceptanceFolder() . '/_steps';
    }

    public function getTestFunctionalStepsFolder()
    {
        return $this->getTestFunctionalFolder() . '/_steps';
    }

    public function getTestPagesFolder()
    {
        return $this->getTestFolder() . '/Pages';
    }

    public function getTestUnitFolder()
    {
        return $this->getTestFolder() . '/unit';
    }

    public function getTestUnitModuleFolder()
    {
        return $this->getTestUnitFolder();
    }

    public function getSchemaFolder()
    {
        return $this->getMainFolder() . '/schema';
    }

    public function getDataFolder()
    {
        return $this->getMainFolder() . '/data';
    }

    public function getSessionFolder()
    {
        return $this->getDataFolder() . '/session';
    }

    public function getDataLogsFolder()
    {
        return $this->getDataFolder() . '/logs';
    }

    public function getDataFilesFolder()
    {
        return $this->getDataFolder() . '/_files';
    }

    public function getLanguageFolder()
    {
        return $this->getMainFolder() . '/language';
    }

    public function getLanguageRouteFolder()
    {
        return $this->getLanguageFolder() . '/route';
    }
}
