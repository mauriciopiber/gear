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

use Gear\Module\Config\ApplicationConfig;
use Gear\Module\Config\ApplicationConfigTrait;
use Gear\Autoload\ComposerAutoload;
use Gear\Autoload\ComposerAutoloadTrait;
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
use Gear\Creator\FileCreator\FileCreatorTrait;
use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\Dir\DirServiceTrait;
use GearBase\Util\Dir\DirService;
use Gear\Module\ModuleAwareTrait;
use Gear\Mvc\View\ViewService;
use Gear\Module\ModuleProjectConnectorInterface;
use GearBase\Config\GearConfig;
use GearBase\Config\GearConfigTrait;

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
class ModuleService implements ModuleProjectConnectorInterface
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
    use ApplicationConfigTrait;
    use ComposerAutoloadTrait;
    use DirServiceTrait;
    use GearConfigTrait;

    protected $type;

    protected $staging;

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
        ConfigService $configService,
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
        CacheService $cache,
        ApplicationConfig $applicationConfig,
        ComposerAutoload $autoload,
        array $config,
        DirService $dirService,
        GearConfig $gearConfig
    ) {
        $this->gearConfig = $gearConfig;
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

        $this->configService = $configService;
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

        $this->applicationConfig = $applicationConfig;
        $this->composerAutoload = $autoload;
        $this->config = $config;

        $this->dirService = $dirService;
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
        $moduleStructure->prepare($module, $type)->write();

        $this->moduleComponents();

        return $this->addModuleToProject();
    }

    public function addModuleToProject()
    {
        $this->getApplicationConfig()->addModuleToProject();
        //karma
        //end2end
        //gulpfile
        $this->getCodeceptionService()->addModuleToProject();
        $this->getComposerAutoload()->addModuleToProject();
        $this->getCacheService()->renewFileCache();

        return true;
    }


    /**
     * Deletar todo módulo, com todas configurações e reiniciar as configurações do projeto para esquecer o módulo
     *
     * @return string
     */
    public function removeModuleFromProject()
    {
        if (!is_dir($this->getModule()->getMainFolder())) {
            return false;
        }

        $this->getDirService()->rmDir($this->getModule()->getMainFolder());

        $this->getApplicationConfig()->removeModuleFromProject();

        $this->getComposerAutoload()->removeModuleFromProject();

        $this->getCodeceptionService()->removeModuleFromProject();

        return true;
        //return sprintf('Módulo %s deletado', $this->getModule()->getModuleName());
    }

    public function delete()
    {
        return $this->removeModuleFromProject();
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
    public function moduleAsProject($module, $location, $type = 'web', $staging = null)
    {
        $this->type = $type;
        $this->staging = $staging;

        $moduleStructure = $this->getModule();
        //module structure

        if (!empty($location)) {
            $str = $this->getStringService();

            $mainFolder = $location.'/'.$str->str('url', $module);
            $moduleStructure->setMainFolder($mainFolder);
        }

        $module = $moduleStructure->prepare($module, $type)->write();

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
        $configService         = $this->getConfigService();
        $configService->module($this->type, $this->staging);

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
            //$this->getTestService()->createTests($this->type);
        }


        //$this->buildpath();

        $this->registerJson();

        $codeceptionService = $this->getCodeceptionService();
        $codeceptionService->createFullSuite();

        switch ($this->type) {
            case 'web':
                $controllerTService = $this->getControllerTestService();
                $controllerService     = $this->getMvcController();

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

                if ($collection == 2) {
                    $this->getFeature()->createIndexFeature(
                        $this->str('label', $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***)
                    );
                } else {
                    $this->getFeature()->createIndexFeature();
                }

                $this->getPage()->createIndexPage();
                $this->getStep()->createIndexStep();

                if ($collection==1 && !empty($this->staging)) {
                    $this->getStagingScript();
                    $this->getInstallStagingScript();
                }

                $languageService = $this->getLanguageService();
                $languageService->create();

                break;

            case 'cli':
                $consoleTest = $this->getConsoleControllerTest();
                $consoleController = $this->getConsoleController();
                $consoleTest->module();
                $consoleTest->moduleFactory();
                $consoleController->module();
                $consoleController->moduleFactory();



                break;
        }

        $this->createGitIgnore($this->type);

        /* @var $configService \Gear\Service\Mvc\ConfigService */





        $this->getReadme();
        $this->getConfigDocs();
        $this->getIndexDocs();
        $this->getChangelogDocs();

        $this->createModuleFile();
        $this->createModuleFileAlias();


        $this->createJenkinsFile($this->type);

        return true;
    }

    public function createGitIgnore($type)
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/gitignore-%s.phtml', $type));
        $file->setOptions([***REMOVED***);
        $file->setFileName('.gitignore');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();
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
     * Executa a limpeza do cache de arquivos onde está as configurações,
     * pra próxima execução reconhcer o novo módulo.
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
    public function createJenkinsFile($type = 'web')
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/jenkinsfile-%s.phtml', $type));
        $file->setOptions(['moduleUrl' => $this->str('url', $this->getModule()->getModuleName())***REMOVED***);
        $file->setFileName('Jenkinsfile');
        $file->setLocation($this->getModule()->getMainFolder());
        return $file->render();
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


    public function getStagingScript()
    {
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());

        $options = [***REMOVED***;
        $options['host'***REMOVED*** = $this->getStaging();
        $options['moduleUrl'***REMOVED*** = $moduleUrl;

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/deploy-staging.phtml');
        $file->setOptions($options);
        $file->setFileName('deploy-staging.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }

    public function getStaging()
    {
        if (empty($this->staging)) {
            $this->staging = $this->getGearConfig()->getCurrentStaging();
        }
        return $this->staging;
    }

    public function setStaging($staging)
    {
        $this->staging = $staging;
        return $this;
    }

    public function getInstallStagingScript()
    {
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());

        $options = [***REMOVED***;
        $options['host'***REMOVED*** = $this->getStaging();
        $options['moduleUrl'***REMOVED*** = $moduleUrl;
        $options['git'***REMOVED*** = $this->getConfigService()->getGit();
        $options['module'***REMOVED*** = $this->str('class', $this->getModule()->getModuleName());
        $options['dbFile'***REMOVED*** = sprintf('%s.mysql.sql', $moduleUrl);

        $file = $this->getFileCreator();
        $file->setTemplate('template/module/script/install-remote-staging.phtml');
        $file->setOptions($options);
        $file->setFileName('install-staging.sh');
        $file->setLocation($this->getModule()->getScriptFolder());
        return $file->render();
    }


    /**
     * Cria script de deploy para ambiente de teste
     *
     * @return string
     */
    public function getScriptTesting($type)
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/script/deploy-testing-%s.phtml', $type));
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
    public function getScriptLoad($type)
    {
        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/script/load-%s.phtml', $type));
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
        $this->getScriptLoad($this->type);
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
    public function getChangelogDocs()
    {
        return $this->getDocs()->createChangelog();
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
     * Cria aliase para usar o modulo tanto como PSR-0 como parte do projeto, localizado em Module.php
     *
     * @return string
     */
    public function createModuleFileAlias()
    {
        $moduleFile = file_put_contents(
            $this->getModule()->getMainFolder().'/Module.php',
            '<?php require_once __DIR__.\'/src/'.$this->getModule()->getModuleName().'/Module.php\';'.PHP_EOL
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

        $type = ($this->type == 'web') ? 'Action' : 'Console';

        $this->getControllerService()->create($module, 'IndexController', 'factories', $type);
        $this->getActionService()->create($module, 'IndexController', 'Index');

        $json = $this->getSchemaLoaderService()->loadSchema();
        return $json;
    }
}
