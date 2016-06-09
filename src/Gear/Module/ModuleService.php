<?php
/**
 * Gear.
 *
 * Gear Is The Edge Project From PiberNetwork.
 *
 * PHP VERSION 5.6
 *
 *  @category   Schema
 *  @package    Gear
 *  @subpackage Gear
 *  @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 *  @copyright  2014-2016 Mauricio Piber Fão
 *  @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 *  @link       https://bitbucket.org/mauriciopiber/gear
 */

namespace Gear\Module;

use Zend\Console\ColorInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
use Gear\Service\AbstractJsonService;
use Gear\Cache\CacheServiceTrait;
use Gear\Mvc\View\ViewServiceTrait;
use Gear\Mvc\View\AngularServiceTrait;
use Gear\Mvc\Controller\ControllerServiceTrait as ControllerMvc;
use Gear\Mvc\Controller\ControllerTestServiceTrait as ControllerMvcTest;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;
use Gear\Mvc\Config\ConfigServiceTrait;
use GearVersion\Service\VersionServiceTrait;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Schema\Loader\SchemaLoaderServiceTrait;
use GearJson\Controller\ControllerServiceTrait;
use GearJson\Action\ActionServiceTrait;
use Gear\Project\DeployServiceTrait;
use Gear\Module\TestServiceTrait;
use Gear\Module\CodeceptionServiceTrait;
use Gear\Mvc\LanguageServiceTrait;
use Gear\Module\ComposerServiceTrait;
use Gear\Module\Node\GulpfileTrait;
use Gear\Module\Node\KarmaTrait;
use Gear\Module\Node\PackageTrait;
use Gear\Module\Node\ProtractorTrait;

/**
 *
 * Classe principal para Criação de Módulos.
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas,
 * Bem como a classe Module.php e suas dependências.
 *
 * @category   Schema
 * @package    Gear
 * @subpackage Gear
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class ModuleService extends AbstractJsonService
{
    use GulpfileTrait;
    use KarmaTrait;
    use PackageTrait;
    use ProtractorTrait;
    use TestServiceTrait;
    use ComposerServiceTrait;
    use ViewServiceTrait;
    use AngularServiceTrait;
    use CacheServiceTrait;
    use VersionServiceTrait;
    use ConfigServiceTrait;
    use DeployServiceTrait;
    use CodeceptionServiceTrait;
    use ControllerMvc;
    use ControllerMvcTest;
    use LanguageServiceTrait;
    use SchemaServiceTrait;
    use SchemaLoaderServiceTrait;
    use ControllerServiceTrait;
    use ActionServiceTrait;
    use ConsoleControllerTestTrait;

    //use \Gear\ContinuousIntegration\JenkinsTrait;

    protected $type;

    const MODULE_AS_PROJECT = 1;
    const MODULE = 2;

    //rodar os testes no final do processo, alterando o arquivo application.config.php do sistema principal.
    public function create()
    {
        $this->build    = $this->getRequest()->getParam('build', null);
        $this->layout   = $this->getRequest()->getParam('layout', null);
        $this->noLayout = $this->getRequest()->getParam('no-layout', null);

        //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $moduleStructure->prepare()->write();

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


    /*
    public function createAngular()
    {
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $module = $moduleStructure->prepare()->writeAngular();

        //composer to use module as service of bitbucket

        $composerService = $this->getServiceLocator()->get('composerService');
        $composerService->createComposer();

        $this->registerJson();
        //CONTROLLER -> ACTION

         $controllerTService = $this->getServiceLocator()->get('controllerTestService');
        $controllerTService->generateAbstractClass();
                $controllerTService->generateForEmptyModule();

        $controllerService     = $this->getServiceLocator()->get('controllerService');
        $controllerService->generateForEmptyModule();

        $configService         = $this->getConfigService();
        $configService->generateForAngular();


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
    */

    public function createApplicationConfig()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/config/application.config.phtml');
        $file->setOptions(['module' => $this->str('class', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('application.config.php');
        $file->setLocation($this->getModule()->getConfigFolder());
        $file->render();
    }

    public function createConfigGlobal()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/config/autoload/global.phtml');
        $file->setOptions(['module' => $this->str('uline', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('global.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        $file->render();
    }

    public function createConfigLocal()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/config/autoload/local.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('local.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        $file->render();
    }

    public function createIndex()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/public/index.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('index.php');
        $file->setLocation($this->getModule()->getPublicFolder());
        $file->render();


        $file = $this->getFileCreator();
        $file->setTemplate('template/module/public/htaccess.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('.htaccess');
        $file->setLocation($this->getModule()->getPublicFolder());
        $file->render();

    }

    public function createInitAutoloader()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/init_autoloader.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('init_autoloader.php');
        $file->setLocation($this->getModule()->getMainFolder());
        $file->render();
    }

    public function getScriptDevelopment($type)
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/script/deploy-development-%s.phtml', $type));
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);

        $file->setFileName('deploy-development.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }

    public function createDeploy()
    {
        $this->getScriptDevelopment($this->type);

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/deploy-testing.phtml');
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('deploy-testing.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        $file->render();

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/load.phtml');
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('load.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        $file->render();
    }

    public function getPhinxConfig()
    {
        $moduleUline = $this->str('uline', $this->getModule()->getModuleName());

        $template = 'template/module/phinx.phtml';
        $options = ['module' => $moduleUline***REMOVED***;
        $fileName = 'phinx.yml';
        $location = $this->getModule()->getMainFolder();

        $file = $this->getFileCreator();
        $file->setTemplate($template);
        $file->setOptions($options);
        $file->setFileName($fileName);
        $file->setLocation($location);

        return $file->render();

    }

    public function buildpath()
    {
        $file = $this->getFileCreator();

        $template = 'template/module/buildpath.phtml';
        $filename = '.buildpath';
        $location = $this->getModule()->getMainFolder();

        $file->setTemplate($template);
        $file->setOptions([***REMOVED***);
        $file->setFileName($filename);
        $file->setLocation($location);

        return $file->render();
    }

    /**
     * Cria arquivo codeception.yml que é a principal referência para os testes unitários.
     */
    public function getCodeception()
    {
        /* @var $codeceptionService \Gear\Service\Test\CodeceptionService */
        $codeceptionService = $this->getCodeceptionService();
        $codeceptionService->createFullSuite();
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
            $this->getPhinxConfig();
            $this->getTestService()->createTestsModuleAsProject();
            //criar script de deploy para módulo

        }

        if ($collection == 2) {
            $this->getComposerService()->createComposer();
            $this->getTestService()->createTests();
        }


        $this->buildpath();

        $this->registerJson();


        $this->getCodeception();

        //CONTROLLER -> ACTION

        $consoleControllerTest = $this->getConsoleControllerTest();
        $consoleControllerTest->generateAbstractClass();

        /* @var $controllerTService \Gear\Service\Mvc\ControllerTService */
        $controllerTService = $this->getControllerTestService();
        $controllerTService->generateAbstractClass();
        $controllerTService->module();

        /* @var $controllerService \Gear\Service\Mvc\ControllerService */
        $controllerService     = $this->getMvcController();
        $controllerService->module();


        /* @var $configService \Gear\Service\Mvc\ConfigService */
        $configService         = $this->getConfigService();
        $configService->module();

        $languageService = $this->getLanguageService();
        $languageService->create();

        $this->getAngularService()->createIndexController();

        $this->getKarmaConfig();
        $this->getKarma()->createTestIndexAction();

        $this->getProtractorConfig();
        $this->getProtractor()->createTestIndexAction();

        $this->getPackageConfig();

        $this->getGulpFileConfig();
        $this->getGulpFileJs();



        /* @var $viewService \Gear\Service\Mvc\ViewService */
        $viewService = $this->getViewService();
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

        return true;
    }

    public function getPackageConfig()
    {
        return $this->getPackage()->create();
    }

    public function getKarmaConfig()
    {
        return $this->getKarma()->create();
    }

    public function getProtractorConfig()
    {
        return $this->getProtractor()->create();
    }

    public function getGulpfileConfig()
    {
        return $this->getGulpfile()->createFileConfig();
    }

    public function getGulpfileJs()
    {
        return $this->getGulpfile()->createFile();
    }

    public function moduleAsProject($module, $location, $type = 'web')
    {
        $this->type = $type;

        $moduleStructure = $this->getModule();
       //module structure

        if (!empty($location)) {

            $str = $this->getStringService();

            $mainFolder = $location.'/'.$str->str('url', $module);
            $moduleStructure->setMainFolder($mainFolder);
        }

        $module = $moduleStructure->prepare($module)->write();

        return $this->moduleComponents(self::MODULE_AS_PROJECT);
    }

    public function moduleCss()
    {
        $cssName = sprintf('%s.css', $this->str('point', $this->getModule()->getModuleName()));

        return $this->getFileCreator()->createFile(
            'template/module/public/css/empty-css.phtml',
            [***REMOVED***,
            $cssName,
            $this->getModule()->getPublicCssFolder()
        );
    }

    public function moduleAngular()
    {
        $jsName = sprintf('%sModule.js', $this->str('class', $this->getModule()->getModuleName()));

        return $this->getFileCreator()->createFile(
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

    /*
    public function createLight($options = array())
    {

        $this->setOptions();
        //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $moduleStructure->minimal()->writeMinimal($this->getOptions());

        $configService         = $this->getConfigService();
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

            $testService = $this->getTestService();
            $testService->createTests();

            $codeceptionService = $this->getServiceLocator()->get('codeceptionService');
            $codeceptionService->mainBootstrap();
            $codeceptionService->unitBootstrap();
        }


    }

    public function hasOptions($optionName)
    {
        return in_array($optionName, $this->getOptions());
    }

    public function createLightModuleFile()
    {
        return $this->getFileCreator()->createFile(
            'template/src/light-module.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'Module.php',
            $this->getModule()->getSrcModuleFolder()
        );
    }

*/

    public function createModuleFileAlias()
    {
        $moduleFile = file_put_contents(
            $this->getModule()->getMainFolder().'/Module.php',
            'require_once __DIR__.\'/src/'.$this->getModule()->getModuleName().'/Module.php\';'.PHP_EOL
        );

        return $moduleFile;
    }

    public function createModuleFile()
    {
        /*
        $request = $this->getServiceLocator()->get('request');

        $layoutName = $request->getParam('layoutName', null);

        if ($layoutName == 'auto') {
            $layoutName = $this->str('url', $this->getModule()->getModuleName());
        } elseif ($layoutName == null) {
            $layoutName = 'gear-admin-interno';
        }
        */
        $layoutName = 'gear-admin-interno';

        $this->createModuleFileTest();

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/module.phtml');
        $file->setOptions([
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'layout' => $layoutName
        ***REMOVED***);

        $file->setFileName('Module.php');
        $file->setLocation($this->getModule()->getSrcModuleFolder());

        return $file->render();

        /**
        return $this->getFileCreator()->createFile(
            'template/src/module.phtml',
            ,
            'Module.php',

        );
        */
    }



    public function createAngularModuleFile()
    {
        $request = $this->getServiceLocator()->get('request');

        $layoutName = $request->getParam('layoutName', null);
        $layoutName = $this->str('url', $this->getModule()->getModuleName());


        $this->createModuleFileTest();

        return $this->getFileCreator()->createFile(
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
        $file = $this->getFileCreator();

        $file->setTemplate('template/module/test/module-test.phtml');
        $file->setOptions(
            array(
                'module' => $this->getModule()->getModuleName(),
            )
        );
        $file->setLocation($this->getModule()->getTestUnitModuleFolder());
        $file->setFileName('ModuleTest.php');

        return $file->render();
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

    /**
     * @TODO NOW
     * @return unknown
     */

    public function registerJson()
    {
        $module = $this->getModule()->getModuleName();

        $this->getSchemaService()->create($module);
        $this->getControllerService()->create($module, 'IndexController');
        $this->getActionService()->create($module, 'IndexController', 'Index');

        $json = $this->getSchemaLoaderService()->loadSchema();
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
            $data['modules'***REMOVED*** = array_merge(
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
            $data['modules'***REMOVED*** = array_merge(
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
        $module = \GearBase\Module::getProjectFolder().'/config/application.config.php';

        if (is_file($module)) {
            return $module;
        }

        throw new \Exception('Gear can\'t get application.config.php from project');
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
