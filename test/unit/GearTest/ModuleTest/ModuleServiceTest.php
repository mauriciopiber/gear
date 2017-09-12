<?php
namespace GearTest\ModuleTest;

use PHPUnit_Framework_TestCase as TestCase;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Yaml\Parser;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;

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

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/script';

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $this->stringService  = new \GearBase\Util\String\StringService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->dirService = new \GearBase\Util\Dir\DirService();
        $this->stringService = new \GearBase\Util\String\StringService();


        $this->composer = $this->prophesize('Gear\Module\ComposerService');
        $this->testService = $this->prophesize('Gear\Module\TestService');

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');

        $this->schemaLoader = $this->prophesize('GearJson\Schema\Loader\SchemaLoaderService');

        $this->schemaController = $this->prophesize('GearJson\Controller\ControllerService');

        $this->schemaAction = $this->prophesize('GearJson\Action\ActionService');

        $this->consoleControllerTest = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleControllerTest');

        $this->consoleController = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleController');

        $this->controllerTest = $this->prophesize('Gear\Mvc\Controller\ControllerTestService');

        $this->controller = $this->prophesize('Gear\Mvc\Controller\ControllerService');

        $this->codeception = $this->prophesize('Gear\Module\CodeceptionService');

        $this->configService = $this->prophesize('Gear\Mvc\Config\ConfigService');

        $this->languageService = $this->prophesize('Gear\Mvc\LanguageService');

        $this->appController = $this->prophesize('Gear\Mvc\View\App\AppControllerService');

        $this->appControllerSpec = $this->prophesize('Gear\Mvc\View\App\AppControllerSpecService');

        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->gulpfile = $this->prophesize('Gear\Module\Node\Gulpfile');

        $this->package = $this->prophesize('Gear\Module\Node\Package');

        $this->karma = $this->prophesize('Gear\Module\Node\Karma');

        $this->protractor = $this->prophesize('Gear\Module\Node\Protractor');

        $this->docs = $this->prophesize('Gear\Module\Docs\Docs');

        $this->dir = new \GearBase\Util\Dir\DirService();

        $this->feature = $this->prophesize('Gear\Mvc\Spec\Feature\Feature');

        $this->unitTest = $this->prophesize('Gear\Mvc\Spec\UnitTest\UnitTest');

        $this->page = $this->prophesize('Gear\Mvc\Spec\Page\Page');

        $this->step = $this->prophesize('Gear\Mvc\Spec\Step\Step');

        $this->view = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->cache = $this->prophesize('Gear\Cache\CacheService');

        $this->request = $this->prophesize('Zend\Console\Request');

        $this->applicationConfig = $this->prophesize('Gear\Module\Config\ApplicationConfig');

        $this->autoload = $this->prophesize('Gear\Autoload\ComposerAutoload');

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

    /**
     * Cria Zend\View\Renderer\PhpRenderer
     */
    public function mockPhpRenderer($templatePath)
    {
        $view = new PhpRenderer();

        $resolver = new AggregateResolver();

        $map = new TemplatePathStack(array(
            'script_paths' => array(
                'template' => $templatePath,
            )
        ));

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
     * @group p1p2
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


        $created = $this->moduleService->moduleAsProject($moduleName, $location, $type);

        $this->assertTrue($created);
    }


    public function createModuleService()
    {
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        $this->moduleService = new \Gear\Module\ModuleService(
            $this->fileCreator->reveal(),
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

    /**
     * @group abcd
     * @group abcd1
     */
    public function testAddModuleToProject()
    {

        $this->createModuleService();

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
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        $this->module->getMainFolder()->willReturn(vfsStream::url('module/fake'))->shouldBeCalled();

        $this->moduleService = new \Gear\Module\ModuleService(
            $this->fileCreator->reveal(),
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

        $this->applicationConfig->removeModuleFromProject()->shouldNotBeCalled();
        $this->autoload->removeModuleFromProject()->shouldNotBeCalled();
        $this->codeception->removeModuleFromProject()->shouldNotBeCalled();


        $this->assertFalse($this->moduleService->removeModuleFromProject());
    }


    /**
     * @group abcd
     */
    public function testDeleteModuleFromProject()
    {
        $this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService = new \Gear\Module\ModuleService(
            $this->fileCreator->reveal(),
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

        $this->applicationConfig->removeModuleFromProject()->shouldBeCalled();
        $this->autoload->removeModuleFromProject()->shouldBeCalled();
        $this->codeception->removeModuleFromProject()->shouldBeCalled();

        $this->assertTrue($this->moduleService->removeModuleFromProject());
    }

}