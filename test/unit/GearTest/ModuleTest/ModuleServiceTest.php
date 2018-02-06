<?php
namespace GearTest\ModuleTest;

use PHPUnit_Framework_TestCase as TestCase;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Yaml\Parser;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Gear\Module\BasicModuleStructure;
use Gear\Module\ComposerService;
use Gear\Module\TestService;
use GearJson\Schema\SchemaService;
use GearJson\Schema\Loader\SchemaLoaderService;
use GearJson\Controller\ControllerService as ControllerSchema;
use GearJson\Action\ActionService;
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\ConsoleController\ConsoleController;
use Gear\Mvc\Controller\ControllerTestService;
use Gear\Mvc\Controller\ControllerService;
use Gear\Module\CodeceptionService;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\View\App\AppControllerService;
use Gear\Mvc\View\App\AppControllerSpecService;
use Gear\Mvc\View\ViewService;
use Gear\Module\Node\Gulpfile;
use Gear\Module\Node\Package;
use Gear\Module\Node\Karma;
use Gear\Module\Node\Protractor;
use Gear\Module\Docs\Docs;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\UnitTest\UnitTest;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Step\Step;
use Gear\Cache\CacheService;
use Zend\Console\Request;
use Gear\Module\Config\ApplicationConfig;
use Gear\Autoload\ComposerAutoload;
use Gear\Module;
use Gear\Creator\Template\TemplateService;
use GearBase\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use GearBase\Util\Dir\DirService;
use GearBase\Util\String\StringService;
use Gear\Module\ModuleService;

/**
 * @group Module
 * @group ModuleService
 */
class ModuleServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->root = vfsStream::setup('module');

       $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/script';

        $template       = new TemplateService    ();
        $template->setRenderer($phpRenderer);

        $fileService    = new FileService();

        $this->fileCreator    = new FileCreator($fileService, $template);

        $this->stringService  = new StringService();
        $this->dirService = new DirService();


        $this->composer = $this->prophesize(ComposerService::class);
        $this->testService = $this->prophesize(TestService::class);

        $this->schema = $this->prophesize(SchemaService::class);

        $this->schemaLoader = $this->prophesize(SchemaLoaderService::class);

        $this->schemaController = $this->prophesize(ControllerSchema::class);

        $this->schemaAction = $this->prophesize(ActionService::class);

        $this->consoleControllerTest = $this->prophesize(ConsoleControllerTest::class);

        $this->consoleController = $this->prophesize(ConsoleController::class);

        $this->controllerTest = $this->prophesize(ControllerTestService::class);

        $this->controller = $this->prophesize(ControllerService::class);

        $this->codeception = $this->prophesize(CodeceptionService::class);

        $this->configService = $this->prophesize(ConfigService::class);

        $this->languageService = $this->prophesize(LanguageService::class);

        $this->appController = $this->prophesize(AppControllerService::class);

        $this->appControllerSpec = $this->prophesize(AppControllerSpecService::class);

        $this->viewService = $this->prophesize(ViewService::class);

        $this->gulpfile = $this->prophesize(Gulpfile::class);

        $this->package = $this->prophesize(Package::class);

        $this->karma = $this->prophesize(Karma::class);

        $this->protractor = $this->prophesize(Protractor::class);

        $this->docs = $this->prophesize(Docs::class);

        $this->dir = new DirService();

        $this->feature = $this->prophesize(Feature::class);

        $this->unitTest = $this->prophesize(UnitTest::class);

        $this->page = $this->prophesize(Page::class);

        $this->step = $this->prophesize(Step::class);

        $this->view = $this->prophesize(ViewService::class);

        $this->cache = $this->prophesize(CacheService::class);

        $this->request = $this->prophesize(Request::class);

        $this->applicationConfig = $this->prophesize(ApplicationConfig::class);

        $this->autoload = $this->prophesize(ComposerAutoload::class);

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'GearProject',
                    'git' => 'git@pibernetwork.com/gear-project.git',
                ***REMOVED***
            ***REMOVED***

        ***REMOVED***;

        $this->gearConfig = $this->prophesize('GearBase\Config\GearConfig');
    }

    public function getNamespaces() {

        return [
            ['MyNamespace', 'MyNamespace'***REMOVED***,
            ['MyBigNamespace', 'MyBigNamespace'***REMOVED***,
            ['MyBig\Namespace', 'MyBig\Namespace'***REMOVED***,
            ['MyBig', 'MyBig'***REMOVED***,
            ['My\Big', 'My\Big'***REMOVED***,

        ***REMOVED***;
    }

    /**
     * @dataProvider getNamespaces
     * @group namespaces
     */
    public function testModuleNamespace($data, $expected)
    {
        $this->module->getModuleName()->willReturn($data)->shouldBeCalled();
        $this->createModuleRealFiles();
        $this->assertEquals($expected, $this->moduleService->getModuleNamespace());

    }

    /**
     * Cria Zend\View\Renderer\PhpRenderer
     */
    public function mockPhpRenderer($templatePath)
    {
        $view = new PhpRenderer();

        $resolver = new AggregateResolver();

        $map = new TemplatePathStack([
            'script_paths' => [
                'template' => $templatePath,
            ***REMOVED***
        ***REMOVED***);

        $resolver->attach($map);

        $view->setResolver($resolver);

        return $view;
    }

    public function createModuleRealFiles()
    {
        $this->moduleService = new \Gear\Module\ModuleService(
            $this->fileCreator,
            $this->stringService,
            $this->module->reveal(),
            $this->docs->reveal(),
            $this->composer->reveal(),
            $this->codeception->reveal(),
            $this->testService->reveal(),
            $this->karma->reveal(),
            $this->protractor->reveal(),
            $this->package->reveal(),
            $this->gulpfile->reveal(),
            $this->languageService->reveal(),
            $this->schema->reveal(),
            $this->schemaLoader->reveal(),
            $this->schemaController->reveal(),
            $this->schemaAction->reveal(),
            $this->configService->reveal(),
            $this->controller->reveal(),
            $this->controllerTest->reveal(),
            $this->consoleController->reveal(),
            $this->consoleControllerTest->reveal(),
            $this->view->reveal(),
            $this->appController->reveal(),
            $this->appControllerSpec->reveal(),
            $this->feature->reveal(),
            $this->step->reveal(),
            $this->page->reveal(),
            $this->unitTest->reveal(),
            $this->request->reveal(),
            $this->cache->reveal(),
            $this->applicationConfig->reveal(),
            $this->autoload->reveal(),
            $this->config,
            $this->dir,
            $this->gearConfig->reveal()
        );
    }

    /**
     * @group module1
     */
    public function testScriptDeploy()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->createModuleRealFiles();

        $this->moduleService->getScriptDevelopment('cli');

        $expected = $this->templates.'/deploy-development-cli.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/deploy-development.sh'))
        );
    }

    /**
     * @group script2
     */
    public function testScriptInstallStaging()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->createModuleRealFiles();

        $this->moduleService->setStaging('gear-it.stag01.pibernetwork.com');
        $this->configService->getGit()->willReturn('git@bitbucket.org:mauriciopiber/gear-it.git')->shouldBeCalled();

        $this->moduleService->getInstallStagingScript();

        $expected = $this->templates.'/install-staging.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/install-staging.sh'))
        );

    }

    /**
     * @group script2
     */
    public function testScriptDeployStaging()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->createModuleRealFiles();

        $this->moduleService->setStaging('gear-it.stag01.pibernetwork.com');
        $this->moduleService->getStagingScript();

        $expected = $this->templates.'/deploy-staging.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/deploy-staging.sh'))
        );
    }

    /**
     * @group gitignore
     */
    public function testGitIgnoreWeb()
    {
        $this->createModuleRealFiles();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->moduleService->createGitIgnore('web');

        $expected = $this->templates.'/../gitignore-web';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/.gitignore'))
        );
    }

    /**
     * @group gitignore
     */
    public function testGitIgnoreCli()
    {
        $this->createModuleRealFiles();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService->createGitIgnore('cli');

        $expected = $this->templates.'/../gitignore-cli';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/.gitignore'))
        );
    }



    /**
     * @group mod2

    public function testCreateModule($type = 'web')
    {

        $this->moduleService->create();
    }
    */

    /**
     * @group cmap
     */
    public function testCreateModuleAsProjectWeb()
    {
        $type = 'web';
        $moduleName = 'MyModule';
        $location = vfsStream::url('module');

        $this->module = new \Gear\Module\BasicModuleStructure();
        $this->module->setRequestName($moduleName);
        $this->module->setDirService($this->dirService);
        $this->module->setStringService($this->stringService);


        $this->composer->createComposerAsProject($type)->willReturn(true)->shouldBeCalled();
        $this->testService->createTestsModuleAsProject($type)->willReturn(true)->shouldBeCalled();


        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();
        $this->schemaController->create($moduleName, ['name' => 'IndexController', 'services' => 'factories', 'type' => 'Action'***REMOVED***)->willReturn(true)->shouldBeCalled();
        $this->schemaAction->create($moduleName, ['controller' => 'IndexController', 'name' => 'Index'***REMOVED***, false)->willReturn(true)->shouldBeCalled();

        $this->controllerTest->module()->shouldBeCalled();
        $this->controller->module()->shouldBeCalled();
        $this->controllerTest->moduleFactory()->shouldBeCalled();
        $this->controller->moduleFactory()->shouldBeCalled();

        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type, null)->shouldBeCalled();

        $this->languageService->module()->shouldBeCalled();

        $this->appController->createIndexController()->shouldBeCalled();
        $this->appControllerSpec->createTestIndexAction()->shouldBeCalled();

        $this->viewService->createIndexView()->shouldBeCalled();
        $this->viewService->createErrorView()->shouldBeCalled();
        $this->viewService->createDeleteView()->shouldBeCalled();
        $this->viewService->create404View()->shouldBeCalled();
        $this->viewService->createLayoutSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteFailView()->shouldBeCalled();
        $this->viewService->createBreadcrumbView()->shouldBeCalled();



        $this->karma->create()->shouldBeCalled();


        $this->protractor->create()->shouldBeCalled();
        $this->protractor->report()->shouldBeCalled();

        $this->package->create()->shouldBeCalled();


        $this->gulpfile->createFile()->shouldBeCalled();
        $this->gulpfile->createFileConfig()->shouldBeCalled();


        $this->docs->createConfig()->shouldBeCalled();
        $this->docs->createIndex()->shouldBeCalled();
        $this->docs->createReadme()->shouldBeCalled();
        $this->docs->createChangelog()->shouldBeCalled();

        $files = __DIR__.'/_files/module-files-web.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents(__DIR__.'/_files/module-files-web.yml')
        );

        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        foreach ($files['files'***REMOVED*** as $file) {

            $this->fileCreator->setTemplate($file['template'***REMOVED***)->shouldBeCalled();
            if (isset($file['options'***REMOVED***)) {
                $this->fileCreator->setOptions($file['options'***REMOVED***)->shouldBeCalled();
            } else {
                $this->fileCreator->setOptions([***REMOVED***)->shouldBeCalled();
            }

            if (isset($file['location'***REMOVED***)) {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module/%s', $file['location'***REMOVED***)))->shouldBeCalled();
            } else {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module')))->shouldBeCalled();
            }

            $this->fileCreator->setFileName($file['filename'***REMOVED***)->shouldBeCalled();
            $this->fileCreator->render()->shouldBeCalled();

        }

        /**
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
        $this->fileCreator->setTemplate('template/module/config/application.config.phtml')->shouldBeCalled();
        $this->fileCreator->setOptions(['module' => 'MyModule'***REMOVED***)->shouldBeCalled();
        $this->fileCreator->setLocation(vfsStream::url('module/my-module/config'))->shouldBeCalled();
        $this->fileCreator->setFileName('application.config.php')->shouldBeCalled();
        $this->fileCreator->render()->shouldBeCalled();
         */


        $this->feature->createIndexFeature()->willReturn(true)->shouldBeCalled();
        $this->page->createIndexPage()->willReturn(true)->shouldBeCalled();
        $this->step->createIndexStep()->willReturn(true)->shouldBeCalled();

        $this->moduleService = new \Gear\Module\ModuleService(
            $this->fileCreator->reveal(),
            $this->stringService,
            $this->module,
            $this->docs->reveal(),
            $this->composer->reveal(),
            $this->codeception->reveal(),
            $this->testService->reveal(),
            $this->karma->reveal(),
            $this->protractor->reveal(),
            $this->package->reveal(),
            $this->gulpfile->reveal(),
            $this->languageService->reveal(),
            $this->schema->reveal(),
            $this->schemaLoader->reveal(),
            $this->schemaController->reveal(),
            $this->schemaAction->reveal(),
            $this->configService->reveal(),
            $this->controller->reveal(),
            $this->controllerTest->reveal(),
            $this->consoleController->reveal(),
            $this->consoleControllerTest->reveal(),
            $this->viewService->reveal(),
            $this->appController->reveal(),
            $this->appControllerSpec->reveal(),
            $this->feature->reveal(),
            $this->step->reveal(),
            $this->page->reveal(),
            $this->unitTest->reveal(),
            $this->request->reveal(),
            $this->cache->reveal(),
            $this->applicationConfig->reveal(),
            $this->autoload->reveal(),
            $this->config,
            $this->dir,
            $this->gearConfig->reveal()
        );


        $created = $this->moduleService->moduleAsProject($moduleName, $location);

        $this->assertTrue($created);
    }

    /**
     * @group create2
     * @group x1
     * @group x11
     */
    public function testCreateModuleWeb()
    {
        $type = 'web';
        $moduleName = 'MyModule';
        $location = vfsStream::url('module');

        $this->module = new \Gear\Module\BasicModuleStructure();
        $this->module->setRequestName($moduleName);
        $this->module->setDirService($this->dirService);
        $this->module->setStringService($this->stringService);
        $this->module->setBasePath(vfsStream::url('module'));


        $this->composer->createComposer()->willReturn(true)->shouldBeCalled();

        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();
        $this->schemaController->create($moduleName, ['name' => 'IndexController', 'services' => 'factories', 'type' => 'Action'***REMOVED***)->willReturn(true)->shouldBeCalled();
        $this->schemaAction->create($moduleName, ['controller' => 'IndexController', 'name' => 'Index'***REMOVED***, false)->willReturn(true)->shouldBeCalled();

        $this->controllerTest->module()->shouldBeCalled();
        $this->controller->module()->shouldBeCalled();
        $this->controllerTest->moduleFactory()->shouldBeCalled();
        $this->controller->moduleFactory()->shouldBeCalled();

        $this->codeception->addModuleToProject()->willReturn(true)->shouldBeCalled();
        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type, null)->shouldBeCalled();

        $this->languageService->module()->shouldBeCalled();

        $this->appController->createIndexController()->shouldBeCalled();
        $this->appControllerSpec->createTestIndexAction()->shouldBeCalled();

        $this->viewService->createIndexView()->shouldBeCalled();
        $this->viewService->createErrorView()->shouldBeCalled();
        $this->viewService->createDeleteView()->shouldBeCalled();
        $this->viewService->create404View()->shouldBeCalled();
        $this->viewService->createLayoutSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteFailView()->shouldBeCalled();
        $this->viewService->createBreadcrumbView()->shouldBeCalled();



        $this->karma->create()->shouldBeCalled();


        $this->protractor->create()->shouldBeCalled();
        $this->protractor->report()->shouldBeCalled();

        $this->package->create()->shouldBeCalled();


        $this->gulpfile->createFile()->shouldBeCalled();
        $this->gulpfile->createFileConfig()->shouldBeCalled();


        $this->docs->createConfig()->shouldBeCalled();
        $this->docs->createIndex()->shouldBeCalled();
        $this->docs->createReadme()->shouldBeCalled();
        $this->docs->createChangelog()->shouldBeCalled();

        /**
        $files = (new \Gear\Module())->getLocation().'/../../test/integration/module-files-web.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../test/integration/module-files-web.yml')
            );

        */
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        /**
        foreach ($files['files'***REMOVED*** as $file) {

            $this->fileCreator->setTemplate($file['template'***REMOVED***)->shouldBeCalled();
            if (isset($file['options'***REMOVED***)) {
                $this->fileCreator->setOptions($file['options'***REMOVED***)->shouldBeCalled();
            } else {
                $this->fileCreator->setOptions([***REMOVED***)->shouldBeCalled();
            }

            if (isset($file['location'***REMOVED***)) {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module/%s', $file['location'***REMOVED***)))->shouldBeCalled();
            } else {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module')))->shouldBeCalled();
            }

            $this->fileCreator->setFileName($file['filename'***REMOVED***)->shouldBeCalled();
            $this->fileCreator->render()->shouldBeCalled();

        }

        /**
         $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
         $this->fileCreator->setTemplate('template/module/config/application.config.phtml')->shouldBeCalled();
         $this->fileCreator->setOptions(['module' => 'MyModule'***REMOVED***)->shouldBeCalled();
         $this->fileCreator->setLocation(vfsStream::url('module/my-module/config'))->shouldBeCalled();
         $this->fileCreator->setFileName('application.config.php')->shouldBeCalled();
         $this->fileCreator->render()->shouldBeCalled();
         */


        $this->feature->createIndexFeature('Gear Project')->willReturn(true)->shouldBeCalled();
        $this->page->createIndexPage()->willReturn(true)->shouldBeCalled();
        $this->step->createIndexStep()->willReturn(true)->shouldBeCalled();


        $this->moduleService = new \Gear\Module\ModuleService(
            $this->fileCreator->reveal(),
            $this->stringService,
            $this->module,
            $this->docs->reveal(),
            $this->composer->reveal(),
            $this->codeception->reveal(),
            $this->testService->reveal(),
            $this->karma->reveal(),
            $this->protractor->reveal(),
            $this->package->reveal(),
            $this->gulpfile->reveal(),
            $this->languageService->reveal(),
            $this->schema->reveal(),
            $this->schemaLoader->reveal(),
            $this->schemaController->reveal(),
            $this->schemaAction->reveal(),
            $this->configService->reveal(),
            $this->controller->reveal(),
            $this->controllerTest->reveal(),
            $this->consoleController->reveal(),
            $this->consoleControllerTest->reveal(),
            $this->viewService->reveal(),
            $this->appController->reveal(),
            $this->appControllerSpec->reveal(),
            $this->feature->reveal(),
            $this->step->reveal(),
            $this->page->reveal(),
            $this->unitTest->reveal(),
            $this->request->reveal(),
            $this->cache->reveal(),
            $this->applicationConfig->reveal(),
            $this->autoload->reveal(),
            $this->config,
            $this->dir,
            $this->gearConfig->reveal()
        );


        $created = $this->moduleService->create($moduleName, $type);

        $this->assertTrue($created);
    }

    /**
     * @group create1
     * @group ppx1
     */
    public function testCreateModuleCli()
    {
        $type = 'cli';
        $moduleName = 'MyModule';
        $location = vfsStream::url('module');

        $this->module = new \Gear\Module\BasicModuleStructure();
        $this->module->setRequestName($moduleName);
        $this->module->setDirService($this->dirService);
        $this->module->setStringService($this->stringService);

        $this->composer->createComposer()->willReturn(true)->shouldBeCalled();

        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();
        $this->schemaController->create($moduleName, ['name' => 'IndexController', 'services' => 'factories', 'type' => 'Console'***REMOVED***)->willReturn(true)->shouldBeCalled();
        $this->schemaAction->create($moduleName, ['controller' => 'IndexController', 'name' => 'Index'***REMOVED***, false)->willReturn(true)->shouldBeCalled();

        $this->consoleControllerTest->module()->shouldBeCalled();
        $this->consoleController->module()->shouldBeCalled();
        $this->consoleControllerTest->moduleFactory()->shouldBeCalled();
        $this->consoleController->moduleFactory()->shouldBeCalled();

        $this->codeception->addModuleToProject()->willReturn(true)->shouldBeCalled();
        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type, null)->shouldBeCalled();

        $this->docs->createConfig()->shouldBeCalled();
        $this->docs->createIndex()->shouldBeCalled();
        $this->docs->createReadme()->shouldBeCalled();
        $this->docs->createChangelog()->shouldBeCalled();


        /**
        $files = (new \Gear\Module())->getLocation().'/../../test/integration/module-files-cli.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../test/integration/module-files-cli.yml')
        );
        */

        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        /**
        foreach ($files['files'***REMOVED*** as $file) {

            $this->fileCreator->setTemplate($file['template'***REMOVED***)->shouldBeCalled();
            if (isset($file['options'***REMOVED***)) {
                $this->fileCreator->setOptions($file['options'***REMOVED***)->shouldBeCalled();
            } else {
                $this->fileCreator->setOptions([***REMOVED***)->shouldBeCalled();
            }

            if (isset($file['location'***REMOVED***)) {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module/%s', $file['location'***REMOVED***)))->shouldBeCalled();
            } else {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module')))->shouldBeCalled();
            }

            $this->fileCreator->setFileName($file['filename'***REMOVED***)->shouldBeCalled();
            $this->fileCreator->render()->shouldBeCalled();

        }
        */

        /**
         $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
         $this->fileCreator->setTemplate('template/module/config/application.config.phtml')->shouldBeCalled();
         $this->fileCreator->setOptions(['module' => 'MyModule'***REMOVED***)->shouldBeCalled();
         $this->fileCreator->setLocation(vfsStream::url('module/my-module/config'))->shouldBeCalled();
         $this->fileCreator->setFileName('application.config.php')->shouldBeCalled();
         $this->fileCreator->render()->shouldBeCalled();
         */

        $this->module->setBasePath(vfsStream::url('module'));

        $this->moduleService = new \Gear\Module\ModuleService(
            $this->fileCreator->reveal(),
            $this->stringService,
            $this->module,
            $this->docs->reveal(),
            $this->composer->reveal(),
            $this->codeception->reveal(),
            $this->testService->reveal(),
            $this->karma->reveal(),
            $this->protractor->reveal(),
            $this->package->reveal(),
            $this->gulpfile->reveal(),
            $this->languageService->reveal(),
            $this->schema->reveal(),
            $this->schemaLoader->reveal(),
            $this->schemaController->reveal(),
            $this->schemaAction->reveal(),
            $this->configService->reveal(),
            $this->controller->reveal(),
            $this->controllerTest->reveal(),
            $this->consoleController->reveal(),
            $this->consoleControllerTest->reveal(),
            $this->viewService->reveal(),
            $this->appController->reveal(),
            $this->appControllerSpec->reveal(),
            $this->feature->reveal(),
            $this->step->reveal(),
            $this->page->reveal(),
            $this->unitTest->reveal(),
            $this->request->reveal(),
            $this->cache->reveal(),
            $this->applicationConfig->reveal(),
            $this->autoload->reveal(),
            $this->config,
            $this->dir,
            $this->gearConfig->reveal()
        );


        $created = $this->moduleService->create($moduleName, $type);

        $this->assertTrue($created);
    }

    /**
     * @group mod1
     * @group vamov
     * @group ppx1
     * @group cmap
     */
    public function testCreateModuleAsProjectCli()
    {
        $type = 'cli';
        $moduleName = 'MyModule';
        $location = vfsStream::url('module');

        $this->module = new \Gear\Module\BasicModuleStructure();
        $this->module->setRequestName($moduleName);
        $this->module->setDirService($this->dirService);
        $this->module->setStringService($this->stringService);


        $this->composer->createComposerAsProject($type)->willReturn(true)->shouldBeCalled();
        $this->testService->createTestsModuleAsProject($type)->willReturn(true)->shouldBeCalled();


        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();
        $this->schemaController->create(
            $moduleName,
            [
                "name" => "IndexController",
                "services" => "factories",
                "type" => "Console"
            ***REMOVED***
        )->willReturn(true)->shouldBeCalled();

        $this->schemaAction->create($moduleName, ["controller" => "IndexController", "name" => "Index"***REMOVED***, false)->willReturn(true)->shouldBeCalled();

        $this->consoleControllerTest->module()->shouldBeCalled();
        $this->consoleController->module()->shouldBeCalled();
        $this->consoleControllerTest->moduleFactory()->shouldBeCalled();
        $this->consoleController->moduleFactory()->shouldBeCalled();

        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type, null)->shouldBeCalled();

        $this->docs->createConfig()->shouldBeCalled();
        $this->docs->createIndex()->shouldBeCalled();
        $this->docs->createReadme()->shouldBeCalled();
        $this->docs->createChangelog()->shouldBeCalled();

        $files = __DIR__.'/_files/module-files-cli.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents($files)
        );

        $this->moduleService = $this->mockModuleFakeCreator();

        //$this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        foreach ($files['files'***REMOVED*** as $file) {

            $this->fileCreator->setTemplate($file['template'***REMOVED***)->shouldBeCalled();
            if (isset($file['options'***REMOVED***)) {
                $this->fileCreator->setOptions($file['options'***REMOVED***)->shouldBeCalled();
            } else {
                $this->fileCreator->setOptions([***REMOVED***)->shouldBeCalled();
            }

            if (isset($file['location'***REMOVED***)) {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module/%s', $file['location'***REMOVED***)))->shouldBeCalled();
            } else {
                $this->fileCreator->setLocation(vfsStream::url(sprintf('module/my-module')))->shouldBeCalled();
            }

            $this->fileCreator->setFileName($file['filename'***REMOVED***)->shouldBeCalled();
            $this->fileCreator->render()->shouldBeCalled();

        }

        $created = $this->moduleService->moduleAsProject($moduleName, $location, $type);

        $this->assertTrue($created);
    }


    /**
     * @group abcd
     * @group abcd1
     */
    public function testAddModuleToProject()
    {
        $this->moduleService = $this->mockModuleFakeCreator();

        $this->applicationConfig->addModuleToProject()->shouldBeCalled();
        $this->autoload->addModuleToProject()->shouldBeCalled();
        $this->codeception->addModuleToProject()->shouldBeCalled();
        $this->cache->renewFileCache()->shouldBeCalled();

        $this->assertTrue($this->moduleService->addModuleToProject());
    }


    /**
     * @group abcd
     */
    public function testDeleteModuleNotExist()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module/fake'))->shouldBeCalled();

        $this->moduleService = $this->mockModuleFakeCreator();

        $this->applicationConfig->removeModuleFromProject()->shouldNotBeCalled();
        $this->autoload->removeModuleFromProject()->shouldNotBeCalled();
        $this->codeception->removeModuleFromProject()->shouldNotBeCalled();


        $this->assertFalse($this->moduleService->removeModuleFromProject());
    }

    /**
     * @group fix1
     */
    public function testDeleteModuleFromProject()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService = $this->mockModuleFakeCreator();

        $this->applicationConfig->removeModuleFromProject()->shouldBeCalled();
        $this->autoload->removeModuleFromProject()->shouldBeCalled();
        $this->codeception->removeModuleFromProject()->shouldBeCalled();

        $this->assertTrue($this->moduleService->removeModuleFromProject());
    }

    public function mockModuleFakeCreator()
    {
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
        return $this->mockModule($this->fileCreator->reveal());
    }

    public function mockModuleRealCreator()
    {
        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/script';

        $template       = new TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new FileService();

        $this->fileCreator    = new FileCreator($fileService, $template);

        return $this->mockModule($this->fileCreator);
    }

    public function mockModule($fileCreator) {
        return new ModuleService(
            $fileCreator,
            $this->stringService,
            ($this->module instanceof \Prophecy\Prophecy\ObjectProphecy) ? $this->module->reveal() : $this->module,
            $this->docs->reveal(),
            $this->composer->reveal(),
            $this->codeception->reveal(),
            $this->testService->reveal(),
            $this->karma->reveal(),
            $this->protractor->reveal(),
            $this->package->reveal(),
            $this->gulpfile->reveal(),
            $this->languageService->reveal(),
            $this->schema->reveal(),
            $this->schemaLoader->reveal(),
            $this->schemaController->reveal(),
            $this->schemaAction->reveal(),
            $this->configService->reveal(),
            $this->controller->reveal(),
            $this->controllerTest->reveal(),
            $this->consoleController->reveal(),
            $this->consoleControllerTest->reveal(),
            $this->viewService->reveal(),
            $this->appController->reveal(),
            $this->appControllerSpec->reveal(),
            $this->feature->reveal(),
            $this->step->reveal(),
            $this->page->reveal(),
            $this->unitTest->reveal(),
            $this->request->reveal(),
            $this->cache->reveal(),
            $this->applicationConfig->reveal(),
            $this->autoload->reveal(),
            $this->config,
            $this->dir,
            $this->gearConfig->reveal()
        );
    }
}