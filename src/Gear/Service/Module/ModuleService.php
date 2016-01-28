<?php
namespace Gear\Service\Module;

use Zend\Db\Adapter\Adapter;
use Zend\Console\ColorInterface;
use Gear\Model\TestGear;
use Doctrine\ORM\Mapping\Entity;
use Gear\ValueObject\Config\Config;
use Gear\Service\Filesystem\DirService;
use Gear\Service\Filesystem\FileService;
use Gear\Service\AbstractJsonService;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
use Gear\ValueObject\StandaloneModuleStructure;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ModuleService extends AbstractJsonService
{
    const MODULE_AS_PROJECT = 1;

    const MODULE = 2;

    use \Gear\ContinuousIntegration\JenkinsTrait;

    use \Gear\Common\TestServiceTrait;

    use \GearVersion\Service\VersionServiceTrait;

    use \Gear\Service\DeployServiceTrait;

    use \Gear\Service\CacheServiceTrait;



    //rodar os testes no final do processo, alterando o arquivo application.config.php do sistema principal.
    public function create()
    {
        $this->build    = $this->getRequest()->getParam('build', null);
        $this->layout   = $this->getRequest()->getParam('layout', null);
        $this->noLayout = $this->getRequest()->getParam('no-layout', null);

        //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $module = $moduleStructure->prepare()->write();

        //adiciona os componentes do módulo.
        $this->moduleComponents();

        //registra módulo no application.config.php
        $this->registerModule();

        /* $jenkins = $this->getJenkins();

        $job = new \Gear\ContinuousIntegration\Jenkins\Job();
        $job->setName($this->str('url', $this->getModule()->getModuleName()));
        $job->setPath($this->getModule()->getMainFolder());
        $job->setStandard($jenkins->jobConfigMap('module-codeception'));

        $jenkins->createJob($job); */

        //registra módulo no codeception.yaml
        $this->appendIntoCodeceptionProject();
        $this->dumpAutoload();
        $this->build();
        $this->cache();


        return true;
    }

    public function cache()
    {
    	$this->getCacheService()->renewFileCache();
    }

    public function build()
    {
        $console = $this->getServiceLocator()->get('Console');

        if (isset($this->build) && null !== $this->build) {
            $buildService = $this->getServiceLocator()->get('buildService');
            $output = $buildService->build($this->build);
            $console->writeLine("$output", ColorInterface::RESET, 3);
        }
    }

    public function upgrade()
    {
        (new \Gear\Module\Upgrade\Composer($this->serviceLocator))->upgrade();
        (new \Gear\Module\Upgrade\Build($this->serviceLocator))->upgrade();
        (new \Gear\Module\Upgrade\Phpdox($this->serviceLocator))->upgrade();





        //conferir build.xml se está programado pras 3 possibilidades e pra rodar no jenkins singleton.
        //conferir se tem public/index.php
        //conferir se tem init_autoloader.php
        //conferir se tem codeception.yaml
        //conferir se tem config/application.config.php
        //conferir se tem config/autoload/global.config.php
        //conferir se tem config/autoload/local.config.php

    }

    public function createAngular()
    {
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $module = $moduleStructure->prepare()->writeAngular();

        //composer to use module as service of bitbucket
        /* @var $composerService \Gear\Service\Module\ComposerService */
        $composerService = $this->getServiceLocator()->get('composerService');
        $composerService->createComposer();

        $this->registerJson();
        //CONTROLLER -> ACTION

        /* @var $controllerTService \Gear\Service\Mvc\ControllerTService */
        $controllerTService = $this->getServiceLocator()->get('controllerTestService');
        $controllerTService->generateAbstractClass();
        $controllerTService->generateForEmptyModule();

        /* @var $controllerService \Gear\Service\Mvc\ControllerService */
        $controllerService     = $this->getServiceLocator()->get('controllerService');
        $controllerService->generateForEmptyModule();

        /* @var $configService \Gear\Service\Mvc\ConfigService */
        $configService         = $this->getServiceLocator()->get('configService');
        $configService->generateForAngular();


        /* @var $viewService \Gear\Service\Mvc\ViewService */
        $viewService = $this->getServiceLocator()->get('viewService');
        $viewService->createIndexAngularView();
        $viewService->angularLayout();


        $this->moduleCss();
        $this->moduleAngular();

        //$viewService->copyBasicLayout();

        $this->createAngularModuleFile();
        $this->createModuleFileAlias();
        $this->registerModule();

        $this->appendIntoCodeceptionProject();

        $this->dumpAutoload();

        //modificar codeception.yml

        return true;

    }

    public function getComposerService()
    {
        return  $this->getServiceLocator()->get('composerService');
    }

    public function createApplicationConfig()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/config/application.config.phtml');
        $file->setOptions(['module' => $this->str('class', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('application.config.php');
        $file->setLocation($this->getModule()->getConfigFolder());
        $file->render();
    }

    public function createConfigGlobal()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/config/autoload/global.phtml');
        $file->setOptions(['module' => $this->str('uline', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('global.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        $file->render();
    }

    public function createConfigLocal()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/config/autoload/local.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('local.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        $file->render();
    }

    public function createIndex()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/public/index.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('index.php');
        $file->setLocation($this->getModule()->getPublicFolder());
        $file->render();


        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/public/htaccess.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('.htaccess');
        $file->setLocation($this->getModule()->getPublicFolder());
        $file->render();

    }

    public function createInitAutoloader()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/init_autoloader.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('init_autoloader.php');
        $file->setLocation($this->getModule()->getMainFolder());
        $file->render();
    }

    public function createDeploy()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/script/deploy-development.phtml');
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);

        $file->setFileName('deploy-development.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        $file->render();

        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/script/deploy-testing.phtml');
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('deploy-testing.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        $file->render();

        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/script/load.phtml');
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('load.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        $file->render();
    }

    public function createPhinx()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setTemplate('template/module/phinx.phtml');
        $file->setOptions(['module' => $this->str('uline', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('phinx.yml');
        $file->setLocation($this->getModule()->getMainFolder());
        $file->render();
    }

    public function getTestService()
    {
        return $this->getServiceLocator()->get('testService');
    }

    public function moduleComponents($collection = 2)
    {

        if ($collection == 1) {
            $this->getComposerService()->createComposerAsProject();


            $this->createApplicationConfig();
            $this->createConfigGlobal();
            $this->createConfigLocal();
            $this->createIndex();
            $this->createInitAutoloader();

            $this->createDeploy();

            $this->createPhinx();

            $this->getTestService()->createTestsModuleAsProject();
            //criar script de deploy para módulo

        }

        if ($collection == 2) {
            $this->getComposerService()->createComposer();
            $this->getTestService()->createTests();

        }

        $this->registerJson();

        /* @var $codeceptionService \Gear\Service\Test\CodeceptionService */
        $codeceptionService = $this->getServiceLocator()->get('codeceptionService');
        $codeceptionService->createFullSuite();

        $buildService = $this->getServiceLocator()->get('buildService');
        $buildService->copy();


        //CONTROLLER -> ACTION

        /* @var $controllerTService \Gear\Service\Mvc\ControllerTService */
        $controllerTService = $this->getServiceLocator()->get('controllerTestService');
        $controllerTService->generateAbstractClass();
        $controllerTService->generateForEmptyModule();

        /* @var $controllerService \Gear\Service\Mvc\ControllerService */
        $controllerService     = $this->getServiceLocator()->get('controllerService');
        $controllerService->generateForEmptyModule();

        /* @var $configService \Gear\Service\Mvc\ConfigService */
        $configService         = $this->getServiceLocator()->get('configService');
        $configService->generateForEmptyModule();

        $languageService = $this->getServiceLocator()->get('languageService');
        $languageService->create();


        $gitignore = $this->getServiceLocator()->get('Gear\Module\GitIgnore');
        $gitignore->create();

        $angular = $this->getServiceLocator()->get('Gear\Service\Mvc\AngularService');
        $angular->createIndexController();

        $karma = $this->getServiceLocator()->get('Gear\Javascript\Module\Karma');
        $karma->createTestIndexAction();
        $karma->create();

        $protractor = $this->getServiceLocator()->get('Gear\Javascript\Module\Protractor');
        $protractor->createTestIndexAction();
        $protractor->create();

        $package = $this->getServiceLocator()->get('Gear\Javascript\Module\Package');
        $package->create();


        $gulpfile = $this->getServiceLocator()->get('Gear\Javascript\Module\Gulpfile');
        $gulpfile->create();

        /* @var $viewService \Gear\Service\Mvc\ViewService */
        $viewService = $this->getServiceLocator()->get('viewService');
        $viewService->createIndexView();
        $viewService->createErrorView();
        $viewService->createDeleteView();
        $viewService->create404View();
        //$viewService->createLayoutView();
        $viewService->createLayoutSuccessView();
        $viewService->createLayoutDeleteSuccessView();
        $viewService->createLayoutDeleteFailView();
        $viewService->createBreadcrumbView();
        //$viewService->copyBasicLayout();

        $this->createModuleFile();
        $this->createModuleFileAlias();

    }

    public function moduleAsProject()
    {
       //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');

        $module = $this->getRequest()->getParam('module');
        $location = $this->getRequest()->getParam('basepath');

        if (!empty($location)) {

        	$str = new \Gear\Service\Type\StringService();

        	$mainFolder = realpath($location).'/'.$str->str('url', $module);
            $moduleStructure->setMainFolder($mainFolder);
        }

        $module = $moduleStructure->prepare()->write();


    	//$module = $standaloneStructure->write();


    	$this->moduleComponents(self::MODULE_AS_PROJECT);
    	//location

    	//name
    	//die('1');
    }

    public function moduleCss()
    {
        $cssName = sprintf('%s.css', $this->str('point', $this->getModule()->getModuleName()));

        return $this->createFileFromTemplate(
            'template/css/empty-css.phtml',
            [***REMOVED***,
            $cssName,
            $this->getModule()->getPublicCssFolder()
        );
    }

    public function moduleAngular()
    {
        $jsName = sprintf('%sModule.js', $this->str('class', $this->getModule()->getModuleName()));

        return $this->createFileFromTemplate(
            'template/module-angular/js/module-angular.phtml',
            [
                'module' => $this->str('class', $this->getModule()->getModuleName())
            ***REMOVED***,
            $jsName,
            $this->getModule()->getPublicJsAppFolder()
        );
    }


    public function dropFromCodeceptionProject()
    {
        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents(\GearBase\Module::getProjectFolder().'/codeception.yml'));

        if (!isset( $value['include'***REMOVED***)) {
            return null;
        }

        $key = array_search('module/'.$this->getModule()->getModuleName(), $value['include'***REMOVED***);

        if (!$key) {
            return null;
        }

        unset($value['include'***REMOVED***[$key***REMOVED***);

        $dumper = new Dumper();

        $yaml = $dumper->dump($value, 4);

        file_put_contents(\GearBase\Module::getProjectFolder().'/codeception.yml', $yaml);

        return true;
    }

    public function appendIntoCodeceptionProject()
    {

        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents(\GearBase\Module::getProjectFolder().'/codeception.yml'));


        if (!isset($value['include'***REMOVED***)) {
            $value['include'***REMOVED*** = [***REMOVED***;
        }

        if (in_array('module/'.$this->getModule()->getModuleName(), $value['include'***REMOVED***)) {
            return true;
        }

        $value['include'***REMOVED***[***REMOVED*** = 'module/'.$this->getModule()->getModuleName();

        $dumper = new Dumper();

        $yaml = $dumper->dump($value, 4);

        file_put_contents(\GearBase\Module::getProjectFolder().'/codeception.yml', $yaml);

        return true;
    }

    public function dumpAutoload()
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

    public function createJenkinsJob()
    {

    }

    public function deleteJenkinsJob()
    {

    }

    public function createLight($options = array())
    {

        $this->setOptions();
        //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $moduleStructure->minimal()->writeMinimal($this->getOptions());

        /* @var $configService \Gear\Service\Mvc\ConfigService */
        $configService         = $this->getServiceLocator()->get('Gear\Service\Mvc\ConfigService');
        $configService->generateForLightModule($this->getOptions());

        $this->createLightModuleFile();
        $this->createModuleFileAlias();
        $this->registerModule();

        if ($this->hasOptions('gear')) {

            $this->registerJson();
        }

        if ($this->hasOptions('ci')) {
            $buildService = $this->getServiceLocator()->get('buildService');
            $buildService->copy();
        }

        if ($this->hasOptions('unit')) {
            /* @var $testService \Gear\Service\Module\TService */
            $testService = $this->getTestService();
            $testService->createTests();

            $codeceptionService = $this->getServiceLocator()->get('codeceptionService');
            $codeceptionService->mainBootstrap();
            $codeceptionService->unitBootstrap();
        }
        /* $module = $moduleStructure->prepare()->write(); */
    }

    public function hasOptions($optionName)
    {
        return in_array($optionName, $this->getOptions());
    }

    public function createLightModuleFile()
    {
        return $this->createFileFromTemplate(
            'template/src/light-module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'Module.php',
            $this->getModule()->getSrcModuleFolder()
        );
    }



    public function createModuleFileAlias()
    {
        $moduleFile = $this->getFileService()->mkPHP(
            $this->getModule()->getMainFolder(),
            'Module',
            'require_once __DIR__.\'/src/'.$this->getModule()->getModuleName().'/Module.php\';'.PHP_EOL
        );
        return $moduleFile;
    }

    public function createModuleFile()
    {
        $request = $this->getServiceLocator()->get('request');

        $layoutName = $request->getParam('layoutName', null);

        if ($layoutName == 'auto') {
            $layoutName = $this->str('url', $this->getModule()->getModuleName());
        } elseif ($layoutName == null) {
            $layoutName = 'gear-admin-interno';
        }

        $this->createModuleFileTest();

        return $this->createFileFromTemplate(
            'template/src/module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'layout' => $layoutName
            ),
            'Module.php',
            $this->getModule()->getSrcModuleFolder()
        );
    }



    public function createAngularModuleFile()
    {
        $request = $this->getServiceLocator()->get('request');

        $layoutName = $request->getParam('layoutName', null);
        $layoutName = $this->str('url', $this->getModule()->getModuleName());


        $this->createModuleFileTest();

        return $this->createFileFromTemplate(
            'template/src/module-angular.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'layout' => $layoutName
            ),
            'Module.php',
            $this->getModule()->getSrcModuleFolder()
        );
    }

    public function createModuleFileTest()
    {
        return $this->createFileFromTemplate(
            'template/test/unit/module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'ModuleTest.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
    }

    public function loadBefore($data)
    {
        $this->registerBeforeModule($data);
        return true;
    }

    /**
     * @ver 0.2.0 alias for registerModule
     */
    public function load()
    {
        $this->after  = $this->getRequest()->getParam('after', null);
        $this->before = $this->getRequest()->getParam('before', null);

        $this->registerModule();
        return true;
    }

    /**
     * @ver 0.2.0 alias for unregisterModule
     */
    public function unload()
    {
        $this->unregisterModule();
        return true;
    }

    public function registerJson()
    {

        $json = $this->getGearSchema()->registerJson();
        return $json;
    }

    public function dump($type)
    {
        return $this->getGearSchema()->dump($type);
    }


    public function deleteModuleFolder()
    {
        return $this->getDirService()->rmDir($this->getModule()->getMainFolder());
    }

    public function delete()
    {
        $this->unregisterModule();
        $this->deleteModuleFolder();

        //$this->getJenkins()->deleteItem($this->str('url', $this->getModule()->getModuleName()));

        $autoloadNamespace = new \Gear\Autoload\Namespaces();

        $autoloadNamespace
          ->deleteNamespaceFromComposer($this->getModule()->getModuleName())
          ->deleteNamespaceFromComposer($this->getModule()->getModuleName().'Test')
        ->write();

        $this->dropFromCodeceptionProject();

        return sprintf('Módulo %s deletado', $this->getModule()->getModuleName());
    }

    /**
     * Função responsável por alterar o application.config.php e adicionar o novo módulo
     */
    public function registerModule()
    {

        if (isset($this->before) && $this->before !== null) {
            return $this->registerBeforeModule();
        }

        if (isset($this->after) && $this->after !== null) {
            return $this->registerAfterModule();
        }


        $applicationConfig = $this->getApplicationConfig();

        $data = include $applicationConfig;

        $addValue = $this->getModule()->getModuleName();

        if (empty($addValue)) {
            throw new \Exception('Please inform us what module to register!');
        }

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $data['modules'***REMOVED***[***REMOVED*** = $addValue;

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        $dataArray = str_replace("'".\GearBase\Module::getProjectFolder().'/config/', "__DIR__.'/", $dataArray);

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

        $this->getCacheService()->renewFileCache();

        return true;
    }

    public function registerAfterModule()
    {
        $after = $this->after;

        $data = $this->getApplicationConfigArray();

        $addValue = $this->getModule()->getModuleName();

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $keyAfter = array_search($after, $data['modules'***REMOVED***);

        if ($keyAfter !== false) {
            $data['modules'***REMOVED*** = array_merge
            (
                array_slice($data['modules'***REMOVED***, 0, ($keyAfter+1)),
                array($addValue),
                array_slice($data['modules'***REMOVED***, ($keyAfter+1), null)
            );
        } else {
            $data['modules'***REMOVED***[***REMOVED*** = $addValue;
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        $dataArray = str_replace("'".\GearBase\Module::getProjectFolder().'/config/', "__DIR__.'/", $dataArray);


        file_put_contents($this->getApplicationConfig(), '<?php return ' . $dataArray . '; ?>');
        $this->getCacheService()->renewFileCache();
        return true;
    }

    public function registerBeforeModule()
    {
        $before = $this->before;

        $data = $this->getApplicationConfigArray();

        $addValue = $this->getModule()->getModuleName();

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $keyAfter = array_search($before, $data['modules'***REMOVED***);

        if ($keyAfter !== false) {
            $data['modules'***REMOVED*** = array_merge
            (
                array_slice($data['modules'***REMOVED***, 0, $keyAfter),
                array($addValue),
                array_slice($data['modules'***REMOVED***, $keyAfter, null)
            );
        } else {
            $data['modules'***REMOVED***[***REMOVED*** = $addValue;
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));
        $dataArray = str_replace("'".\GearBase\Module::getProjectFolder().'/config/', "__DIR__.'/", $dataArray);

        file_put_contents($this->getApplicationConfig(), '<?php return ' . $dataArray . '; ?>');
        $this->getCacheService()->renewFileCache();
        return true;
    }

    public function getApplicationConfigArray()
    {
        $applicationConfig = $this->getApplicationConfig();
        $data = include $applicationConfig;
        return $data;
    }

    public function getApplicationConfig()
    {

        /**
         * 2 possibilidades
         */
        $module = __DIR__.'/../../../../../../config/application.config.php';

        if (is_file($module)) {
            return $module;
        }

        $vendor = __DIR__.'/../../../../../../../config/application.config.php';

        if (is_file($vendor)) {
            return $vendor;
        }

        throw new Exception('Gear can\'t get application.config.php from project');

    }


    /**
     * Função responsável por alterar o application.config.php e deletar o módulo escolhido
     */
    public function unregisterModule()
    {
        $applicationConfig = $this->getApplicationConfig();

        $data = include $applicationConfig;



        $delValue = $this->getModule()->getModuleName();

        if (empty($delValue)) {
            throw new \Exception('Please inform us what module to unregister!');
        }

        if (($key = array_search($delValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

        return true;
    }

    public function bumpModuleVersion()
    {
        $config = $this->getModule()->getConfigFolder();

        if (!is_file($config.'/module.config.php')) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $moduleConfig = require $config.'/module.config.php';

        if (!isset($moduleConfig['gear'***REMOVED***['version'***REMOVED***)) {
            throw new \Exception(sprintf('Module %s was not ready for versioning', $this->getModule()->getModuleName()));
        }

        $version = $this->getVersionService()->bump($moduleConfig['gear'***REMOVED***['version'***REMOVED***);
        $this->replaceInFile($config.'/module.config.php', $moduleConfig['gear'***REMOVED***['version'***REMOVED***, $version);

        $folder = $this->getModule()->getMainFolder();
        $this->getDeployService()->push($folder, $version, $this->description);
    }

    public function push()
    {
        $this->description = $this->getRequest()->getParam('description', null);
        $this->bump = $this->getRequest()->getParam('bump', null);

        if ($this->bump) {
            $this->bumpModuleVersion();
            return;
        }




        $this->prefix = $this->getRequest()->getParam('prefix', null);
        $this->suffix = $this->getRequest()->getParam('suffix', null);

        $this->noIncrement = $this->sufix = $this->getRequest()->getParam('no-increment', false);

        $config = $this->getModule()->getConfigFolder();

        if (!is_file($config.'/module.config.php')) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $moduleConfig = require $config.'/module.config.php';

        if (!isset($moduleConfig['gear'***REMOVED***['version'***REMOVED***)) {
            throw new \Exception(sprintf('Module %s was not ready for versioning', $this->getModule()->getModuleName()));
        }

        if (false == $this->noIncrement) {
            $version = $this->getVersionService()->increment($moduleConfig['gear'***REMOVED***['version'***REMOVED***);
            $this->replaceInFile($config.'/module.config.php', $moduleConfig['gear'***REMOVED***['version'***REMOVED***, $version);

        } else {
            if (empty($this->prefix) && empty($this->suffix)) {
                throw new \Exception('Ao executar um push, você deve especificar um sufixo/prefixo para versão atual ou permitir o incremento da versão');
            }

            //caso tenha prefixo, é usado primeiro o prefixo.

            if (!empty($this->prefix)) {
                $version = $this->prefix.$moduleConfig['gear'***REMOVED***['version'***REMOVED***;
            } elseif (!empty($this->suffix)) {
                $version = $moduleConfig['gear'***REMOVED***['version'***REMOVED***.$this->suffix;
            }
        }

        $folder = $this->getModule()->getMainFolder();

        $this->getDeployService()->push($folder, $version, $this->description);

        return true;
    }

    public function setOptions($optionsParam = array())
    {
        $request = $this->getRequest();

        $options = [***REMOVED***;

        if ($request->getParam('doctrine')) {
            $options[***REMOVED*** = 'doctrine';
        }
        if ($request->getParam('doctrine-fixture')) {
            $options[***REMOVED*** = 'doctrine-fixture';
        }
        if ($request->getParam('unit')) {
            $options[***REMOVED*** = 'unit';
        }
        if ($request->getParam('codeception')) {
            $options[***REMOVED*** = 'codeception';
        }
        if ($request->getParam('ci')) {
            $options[***REMOVED*** = 'ci';
        }

        if ($request->getParam('gear')) {
            $options[***REMOVED*** = 'gear';
        }

        if ($request->getParam('repository')) {
            $options[***REMOVED*** = 'repository';
        }

        if ($request->getParam('service')) {
            $options[***REMOVED*** = 'service';
        }

        $this->options = array_merge($optionsParam, $options);
        return $this;
    }


}
