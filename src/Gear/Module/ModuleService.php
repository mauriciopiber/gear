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

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
use Gear\Cache\CacheServiceTrait;
use Gear\Cache\CacheService;
use Gear\Mvc\View\ViewServiceTrait;
use Gear\Mvc\View\App\AppControllerServiceTrait;
use Gear\Mvc\View\App\AppControllerService;
use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\View\App\AppControllerSpecService;
use Gear\Mvc\Controller\ControllerServiceTrait as ControllerMvcTrait;
use Gear\Mvc\Controller\ControllerTestServiceTrait as ControllerMvcTestTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Controller\ControllerService as ControllerMvc;
use Gear\Mvc\Controller\ControllerTestService as ControllerMvcTest;
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\ConsoleController\ConsoleController;
use Gear\Mvc\ConsoleController\ConsoleControllerTrait;
use Gear\Mvc\Config\ConfigService;
use GearBase\RequestTrait;
use GearVersion\Service\VersionServiceTrait;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Schema\Loader\SchemaLoaderServiceTrait;
use GearJson\Controller\ControllerServiceTrait;
use GearJson\Action\ActionServiceTrait;
use Gear\Module\TestServiceTrait;
use Gear\Module\CodeceptionServiceTrait;
use Gear\Mvc\LanguageServiceTrait;
use Gear\Module\ComposerServiceTrait;
use Gear\Module\Node\GulpfileTrait;
use Gear\Module\Node\KarmaTrait;
use Gear\Module\Node\PackageTrait;
use Gear\Module\Node\ProtractorTrait;
use Gear\Module\Docs\DocsTrait;
use Gear\Creator\File;
use GearBase\Util\String\StringService;
use Gear\Module\BasicModuleStructure;
use Gear\Module\Docs\Docs;
use Gear\Module\CodeceptionService;
use Gear\Module\TestService;
use Gear\Module\ComposerService;
use Gear\Module\Node\Gulpfile;
use Gear\Module\Node\Karma;
use Gear\Module\Node\Package;
use Gear\Module\Node\Protractor;
use Gear\Mvc\LanguageService;
use GearJson\Schema\SchemaService as Schema;
use GearJson\Schema\Loader\SchemaLoaderService as SchemaLoader;
use GearJson\Controller\ControllerService as SchemaController;
use GearJson\Action\ActionService as SchemaAction;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Feature\FeatureTrait;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Spec\Step\StepTrait;
use Gear\Mvc\Spec\UnitTest\UnitTest;
use Gear\Mvc\Spec\UnitTest\UnitTestTrait;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Page\PageTrait;
use Gear\Creator\FileCreatorTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\ModuleAwareTrait;
use Gear\Mvc\View\ViewService;

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
class ModuleService
{
    use RequestTrait;
    use ConsoleControllerTrait;
    use ModuleAwareTrait;
    use FileCreatorTrait;
    use StringServiceTrait;
    use FeatureTrait;
    use StepTrait;
    use UnitTestTrait;
    use PageTrait;
    use DocsTrait;
    use GulpfileTrait;
    use KarmaTrait;
    use PackageTrait;
    use ProtractorTrait;
    use TestServiceTrait;
    use ComposerServiceTrait;
    use ViewServiceTrait;
    use AppControllerServiceTrait;
    use AppControllerSpecServiceTrait;
    use CacheServiceTrait;
    use VersionServiceTrait;
    use ConfigServiceTrait;
    use CodeceptionServiceTrait;
    use ControllerMvcTrait;
    use ControllerMvcTestTrait;
    use LanguageServiceTrait;
    use SchemaServiceTrait;
    use SchemaLoaderServiceTrait;
    use ControllerServiceTrait;
    use ActionServiceTrait;
    use ConsoleControllerTestTrait;

    protected $type;

    const MODULE_AS_PROJECT = 1;

    const MODULE = 2;

    public function __construct(
        File $fileCreator,
        StringService $stringService,
        BasicModuleStructure $module,
        Docs $docs,
        ComposerService $composer,
        CodeceptionService $codeception,
        TestService $test,
        Karma $karma,
        Protractor $protractor,
        Package $package,
        Gulpfile $gulpfile,
        LanguageService $language,
        Schema $schema,
        SchemaLoader $schemaLoader,
        SchemaController $schemaController,
        SchemaAction $schemaAction,
        ConfigService $config,
        ControllerMvc $controller,
        ControllerMvcTest $controllerTest,
        ConsoleController $consoleController,
        ConsoleControllerTest $consoleTest,
        ViewService $viewService,
        AppControllerService $appController,
        AppControllerSpecService $appControllerSpec,
        Feature $feature,
        Step $step,
        Page $page,
        UnitTest $unitTest,
        $request,
        CacheService $cache
    ) {
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->module = $module;
        $this->docs = $docs;
        $this->composerService = $composer;
        $this->codeception = $codeception;
        $this->testService = $test;

        $this->karma = $karma;
        $this->protractor = $protractor;
        $this->package = $package;
        $this->gulpfile = $gulpfile;
        $this->languageService = $language;

        $this->schemaService = $schema;
        $this->schemaLoaderService = $schemaLoader;
        $this->controllerService = $schemaController;
        $this->actionService = $schemaAction;

        $this->configService = $config;
        $this->mvcService = $controller;
        $this->controllerTestService = $controllerTest;
        $this->consoleControllerTest = $consoleTest;
        $this->consoleController = $consoleController;
        $this->viewService = $viewService;

        $this->appControllerService = $appController;
        $this->appControllerSpecService = $appControllerSpec;

        $this->feature = $feature;
        $this->step = $step;
        $this->page = $page;
        $this->unitTest = $unitTest;

        $this->request = $request;
        $this->cacheService = $cache;
    }

    /**
     * Cria Módulos dentro de Projetos Gear.
     *
     * Cria a estrutura básica do módulo, sem arquivos independentes.
     *
     * @param string $type Tipo Web|Cli
     *
     * @return boolean
     */
    public function create($module, $type = 'web')
    {
        $this->type = $type;
                //module structure
        $moduleStructure = $this->getModule();
        $moduleStructure->prepare($module)->write();

        //adiciona os componentes do módulo.
        $this->moduleComponents();

        //registra módulo no application.config.php
        $this->registerModule();

        //registra módulo no codeception.yaml
        $this->appendIntoCodeceptionProject();
        $this->dumpAutoload();
        $this->cache();

        return true;
    }

    /**
     * Cria módulos livres para ser utilizados as project.
     *
     * @param unknown $module Nome do Módulo
     * @param unknown $location Localização do Módulo
     * @param string $type Tipo Web|Cli
     *
     * @return boolean
     */
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

    /**
     * Função que cria os componentes básicos para todos módulos, pode ser dividida.
     *
     * @param number $collection
     *
     * @return boolean
     */
    public function moduleComponents($collection = 2)
    {

        if ($collection == 1) {
            $this->getComposerService()->createComposerAsProject($this->type);
            $this->createApplicationConfig($this->type);
            $this->createConfigGlobal();
            $this->createConfigLocal();
            $this->createIndex();
            $this->createInitAutoloader();
            $this->createDeploy();
            $this->getPhinxConfig();
            $this->getTestService()->createTestsModuleAsProject($this->type);
            //criar script de deploy para módulo
        }

        if ($collection == 2) {
            $this->getComposerService()->createComposer();
            //vaar_dump($this->type);die();
            $this->getTestService()->createTests($this->type);
        }


        //$this->buildpath();

        $this->registerJson();


        $codeceptionService = $this->getCodeceptionService();
        $codeceptionService->createFullSuite();

        $configService         = $this->getConfigService();
        $configService->module($this->type);


        switch ($this->type) {
            case 'web':
                $controllerTService = $this->getControllerTestService();
                $controllerService     = $this->getMvcController();
                $controllerTService->generateAbstractClass();
                $controllerTService->module();
                $controllerTService->moduleFactory();
                $controllerService->module();
                $controllerService->moduleFactory();

                $this->getKarmaConfig();
                $this->getProtractorConfig();
                $this->getProtractor()->report();
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

                $this->getAppControllerSpecService()->createTestIndexAction();
                $this->getAppControllerService()->createIndexController();

                $this->getFeature()->createIndexFeature();
                $this->getPage()->createIndexPage();
                $this->getStep()->createIndexStep();

                break;

            case 'cli':
                $consoleTest = $this->getConsoleControllerTest();
                $consoleController = $this->getConsoleController();
                $consoleTest->generateAbstractClass();
                $consoleTest->module();
                $consoleTest->moduleFactory();
                $consoleController->module();
                $consoleController->moduleFactory();


                break;
        }


        /* @var $configService \Gear\Service\Mvc\ConfigService */

        $languageService = $this->getLanguageService();
        $languageService->create();



        $this->getReadme();
        $this->getConfigDocs();
        $this->getIndexDocs();

        $this->createModuleFile();
        $this->createModuleFileAlias();

        return true;
    }

    /**
     * Cria o arquivo test/phpmd.xml
     */
    public function getPhpmdConfig()
    {
        return $this->getTestService()->copyphpmd();
    }

    /**
     * Cria o arquivo test/phpcs-docs.xml
     */
    public function getPhpcsDocsConfig()
    {
        return $this->getTestService()->copyDocSniff();
    }

    /**
     * Cria o arquivo test/phpunit-benchmark.xml
     */
    public function getPhpunitBenchmarkConfig()
    {
        return $this->getTestService()->copyphpunitbenchmark();
    }

    /**
     * Cria o arquivo test/phpunit-coverage-benchmark.xml
     */
    public function getPhpunitCoverageBenchmarkConfig()
    {
        return $this->getTestService()->copyphpunitcoveragebenchmark();
    }

    /**
     * Criar o arquivo test/unit.suite.yml
     */
    public function getUnitSuiteConfig()
    {
        return $this->getCodeceptionService()->unitSuiteYml();
    }

    /**
     * cria o arquivo phpdox.xml
     */
    public function getPhpdoxConfig()
    {
        return $this->getTestService()->copyphpdox();
    }

    /**
     * Executa a limpeza do cache de arquivos onde está as configurações, pra próxima execução reconhcer o novo módulo.
     */
    public function cache()
    {
        $this->getCacheService()->renewFileCache();
    }

    /**
     * Cria arquivo config/application.config.php para módulos as project
     *
     * @param string $type Tipo do módulo Web|Cli
     *
     * @return string
     */
    public function createApplicationConfig($type = 'web')
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/config/application.config.%s.phtml', $type));
        $file->setOptions(['module' => $this->str('class', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('application.config.php');
        $file->setLocation($this->getModule()->getConfigFolder());
        return $file->render();
    }

    /**
     * Cria arquivo config/autoload/global.php para módulos as project
     *
     * @return string
     */
    public function createConfigGlobal()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/config/autoload/global.phtml');
        $file->setOptions(['module' => $this->str('uline', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('global.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        return $file->render();
    }

    /**
     * Cria arquivo config/autoload/local.php para módulos as project
     *
     * @return string
     */

    public function createConfigLocal()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/config/autoload/local.phtml');
        $file->setOptions(['module' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('local.php');
        $file->setLocation($this->getModule()->getConfigAutoloadFolder());
        return $file->render();
    }

    /**
     * Cria arquivo public/index.php e arquivo public/.htaccess para módulos as project
     *
     * @return string
     */
    public function createIndex()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/public/index.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('index.php');
        $file->setLocation($this->getModule()->getPublicFolder());
        $return = $file->render();


        $file = $this->getFileCreator();
        $file->setTemplate('template/module/public/htaccess.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('.htaccess');
        $file->setLocation($this->getModule()->getPublicFolder());
        $file->render();

        return $return;

    }

    /**
     * Cria arquivo init_autoloader.php para módulos as project
     *
     * @return string
     */
    public function createInitAutoloader()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/init_autoloader.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('init_autoloader.php');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();
    }

    /**
     * Cria script de deploy para ambiente de desenvolvimento
     *
     * @param string $type Tipo Web|Cli
     *
     * @return string
     */
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

    /**
     * Cria script de deploy para ambiente de teste
     *
     * @return string
     */
    public function getScriptTesting()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/deploy-testing.phtml');
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('deploy-testing.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }

    /**
     * Cria script de load, facilitador de sinalizador de atualizações completas no gear
     *
     * @return string
     */
    public function getScriptLoad()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/load.phtml');
        $file->setOptions([
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setFileName('load.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }

    /**
     * Cria todos scripts obrigatórios para o módulo.
     */
    public function createDeploy()
    {
        $this->getScriptDevelopment($this->type);
        $this->getScriptTesting($this->type);
        $this->getScriptLoad();
    }

    /**
     * Cria o arquivo phinx.xml para configuração das migrations
     *
     * @return string
     */
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

    /*
    public function buildpath()
    {
        $file = $this->getFileCreator();

        $template = 'template/module/buildpath.phtml';
        $filename = '.buildpath';
        $location = $this->getModule()->getMainFolder();

        file_put_contents($location.'/'.$filename, file_get_contents($template));

        //$file->setTemplate($template);
        //$file->setOptions([***REMOVED***);
        //$file->setFileName($filename);
        //$file->setLocation($location);

        return true;
    }
    */

    /**
     * Cria arquivo codeception.yml principal referência para os testes unitários
     *
     * @return string
     */
    public function getCodeception()
    {
        $codeceptionService = $this->getCodeceptionService();
        return $codeceptionService->codeceptYml();
    }

    /**
     * Cria arquivo README.md para informações principais do módulo
     *
     * @return string
     */
    public function getReadme()
    {
        return $this->getDocs()->createReadme();
    }

    /**
     * Cria arquivo mkdocs.yml para configuraçõa da documentação
     *
     * @return string
     */
    public function getConfigDocs()
    {
        return $this->getDocs()->createConfig();
    }

    /**
     * Cria arquivo docs/index.md para página inicial da configuração.
     *
     * @return string
     */
    public function getIndexDocs()
    {
        return $this->getDocs()->createIndex();
    }

    /**
     * Cria arquivo package.json para pacotes nodejs
     *
     * @return string
     */
    public function getPackageConfig()
    {
        return $this->getPackage()->create();
    }

    /**
     * Cria arquivo public/js/spec/karma.conf.js para testes unitários js
     *
     * @return string
     */
    public function getKarmaConfig()
    {
        return $this->getKarma()->create();
    }

    /**
     * Cria arquivo public/js/spec/end2end.conf.js para testes de integração end2end
     *
     * @return string
     */
    public function getProtractorConfig()
    {
        return $this->getProtractor()->create();
    }

    /**
     * Cria arquivo data/config.js para configuração do gulpfile.js.
     *
     * @return string
     */
    public function getGulpfileConfig()
    {
        return $this->getGulpfile()->createFileConfig();
    }

    /**
     * Cria arquivo gulpfile.js para integração de arquivos js e css.
     *
     * @return string
     */
    public function getGulpfileJs()
    {
        return $this->getGulpfile()->createFile();
    }

    /**
     * Cria css para módulo
     *
     * @deprecated
     */
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

    /**
     * Retira um módulo deletado do arquivo codeception.xml do projeto.
     *
     * @return NULL|boolean
     */
    public function dropFromCodeceptionProject()
    {
        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents(\GearBase\Module::getProjectFolder().'/codeception.yml'));

        if (!isset($value['include'***REMOVED***)) {
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

    /**
     * Adiciona um novo módulo ao arquivo de configuração codeception.yml
     *
     * @return boolean
     */
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

    /**
     * Adiciona o módulo ao autoload do vendor, como se fosse adicionado pelo próprio composer.
     *
     * @return boolean
     */
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

    /**
     * Cria aliase para usar o modulo tanto como PSR-0 como parte do projeto, localizado em Module.php
     *
     * @return string
     */
    public function createModuleFileAlias()
    {
        $moduleFile = file_put_contents(
            $this->getModule()->getMainFolder().'/Module.php',
            'require_once __DIR__.\'/src/'.$this->getModule()->getModuleName().'/Module.php\';'.PHP_EOL
        );

        return $moduleFile;
    }

    /**
     * Cria arquivo src/$module/Module.php, arquivo principal com bootstrap do módulo
     *
     * @return string
     */
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

    }

    /**
     * Cria teste unitário para classe Module, para garantir 100% de code coverage se necessário.
     *
     * @return string
     */
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

    /**
     * Carrega um módulo antes do outro
     *
     * @param array $data
     *
     * @return boolean
     */
    public function loadBefore($data)
    {
        $this->registerBeforeModule($data);
        return true;
    }

    /**
     * @ver 0.2.0 alias for registerModule
     *
     * @return boolean
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
     *
     * @return boolean
     */
    public function unload()
    {
        $this->unregisterModule();
        return true;
    }

    /**
     * Cria o arquivo schema/module.json básico para começar os trabalhos
     */
    public function getSchemaConfig()
    {
        $module = $this->getModule()->getModuleName();

        return $this->getSchemaService()->create($module);
    }

    /**
     * Cria os controllers e actions básicos para o módulo funcionar como Gear.
     *
     * @return array
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

    /**
     * Deleta o módulo todo, pela página principal
     *
     * @return boolean
     */
    public function deleteModuleFolder()
    {
        return $this->getDirService()->rmDir($this->getModule()->getMainFolder());
    }

    /**
     * Deletar todo módulo, com todas configurações e reiniciar as configurações do projeto para esquecer o módulo
     *
     * @return string
     */
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
     *
     * @return boolean
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

    /**
     * Adiciona um módulo após a ocorrencia de um outro módulo, para manter a organização
     *
     * @return boolean
     */
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

    /**
     * Adiciona um módulo antes da ocorrencia de um outro módulo, para manter a organização
     *
     * @return boolean
     */
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

    /**
     * Retorna o array de configurações de um módulo
     *
     * @return array
     */
    public function getApplicationConfigArray()
    {
        $applicationConfig = $this->getApplicationConfig();
        $data = include $applicationConfig;
        return $data;
    }

    /**
     * Carrega do disco o arquivo de configuração do módulo
     *
     * @throws \Exception
     *
     * @return string
     */
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
     *
     * @return boolean
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
}
