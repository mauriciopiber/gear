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
        $this->module = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/script';

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $this->stringService  = new \GearBase\Util\String\StringService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

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


        $this->feature = $this->prophesize('Gear\Mvc\Spec\Feature\Feature');

        $this->unitTest = $this->prophesize('Gear\Mvc\Spec\UnitTest\UnitTest');

        $this->page = $this->prophesize('Gear\Mvc\Spec\Page\Page');

        $this->step = $this->prophesize('Gear\Mvc\Spec\Step\Step');

        $this->view = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->cache = $this->prophesize('Gear\Cache\CacheService');

        $this->request = $this->prophesize('Zend\Console\Request');
        //$this->moduleService->setFileCreator($fileCreator);
        //$this->moduleService->setStringService($stringService);
        $this->applicationConfig = $this->prophesize('Gear\Module\Config\ApplicationConfig');

        $this->autoload = $this->prophesize('Gear\Autoload\ComposerAutoload');

        $this->config = [
            'gear' => [
                'project' => [
                    'name' => 'GearProject'
                ***REMOVED***
            ***REMOVED***

        ***REMOVED***;

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
            $this->config
        );
    }

    /**
     * @group module1
     */
    public function testScriptDeploy()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->createModuleRealFiles();

        //$this->moduleService->setModule($this->module->reveal());
        $this->moduleService->getScriptDevelopment('cli');

        $expected = $this->templates.'/deploy-development-cli.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/deploy-development.sh'))
        );
    }

    /**
     * @group gitignore
     */
    public function testGitIgnoreWeb()
    {
        $this->createModuleRealFiles();

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        //$this->moduleService->setModule($this->module->reveal());
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

        //$this->moduleService->setModule($this->module->reveal());
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
     * @group mod1
     * @group mod4
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
        $this->schemaController->create($moduleName, 'IndexController', 'factories', 'Action')->willReturn(true)->shouldBeCalled();
        $this->schemaAction->create($moduleName, 'IndexController', 'Index')->willReturn(true)->shouldBeCalled();

        $this->consoleControllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->controllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->controllerTest->module()->shouldBeCalled();
        $this->controller->module()->shouldBeCalled();
        $this->controllerTest->moduleFactory()->shouldBeCalled();
        $this->controller->moduleFactory()->shouldBeCalled();

        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type)->shouldBeCalled();

        $this->languageService->create()->shouldBeCalled();

        $this->appController->createIndexController()->shouldBeCalled();
        $this->appControllerSpec->createTestIndexAction()->shouldBeCalled();

        $this->viewService->createIndexView()->shouldBeCalled();
        $this->viewService->createErrorView()->shouldBeCalled();
        $this->viewService->createDeleteView()->shouldBeCalled();
        $this->viewService->create404View()->shouldBeCalled();
        //$this->viewService->createLayoutView()->shouldBeCalled();
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

        $files = (new \Gear\Module())->getLocation().'/../../test/integration/module-files-web.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../test/integration/module-files-web.yml')
        );

        $this->fileCreator = $this->prophesize('Gear\Creator\File');

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
        $this->fileCreator = $this->prophesize('Gear\Creator\File');
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
            $this->config
        );


        $created = $this->moduleService->moduleAsProject($moduleName, $location);

        $this->assertTrue($created);
    }

    /**
     * @group create2
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
        $this->testService->createTests('web')->willReturn(true)->shouldBeCalled();


        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();
        $this->schemaController->create($moduleName, 'IndexController', 'factories', 'Action')->willReturn(true)->shouldBeCalled();
        $this->schemaAction->create($moduleName, 'IndexController', 'Index')->willReturn(true)->shouldBeCalled();

        $this->consoleControllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->controllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->controllerTest->module()->shouldBeCalled();
        $this->controller->module()->shouldBeCalled();
        $this->controllerTest->moduleFactory()->shouldBeCalled();
        $this->controller->moduleFactory()->shouldBeCalled();

        $this->codeception->appendIntoCodeceptionProject()->willReturn(true)->shouldBeCalled();
        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type)->shouldBeCalled();

        $this->languageService->create()->shouldBeCalled();

        $this->appController->createIndexController()->shouldBeCalled();
        $this->appControllerSpec->createTestIndexAction()->shouldBeCalled();

        $this->viewService->createIndexView()->shouldBeCalled();
        $this->viewService->createErrorView()->shouldBeCalled();
        $this->viewService->createDeleteView()->shouldBeCalled();
        $this->viewService->create404View()->shouldBeCalled();
        //$this->viewService->createLayoutView()->shouldBeCalled();
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

        /**
        $files = (new \Gear\Module())->getLocation().'/../../test/integration/module-files-web.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../test/integration/module-files-web.yml')
            );

        */
        $this->fileCreator = $this->prophesize('Gear\Creator\File');

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
         $this->fileCreator = $this->prophesize('Gear\Creator\File');
         $this->fileCreator->setTemplate('template/module/config/application.config.phtml')->shouldBeCalled();
         $this->fileCreator->setOptions(['module' => 'MyModule'***REMOVED***)->shouldBeCalled();
         $this->fileCreator->setLocation(vfsStream::url('module/my-module/config'))->shouldBeCalled();
         $this->fileCreator->setFileName('application.config.php')->shouldBeCalled();
         $this->fileCreator->render()->shouldBeCalled();
         */


        $this->feature->createIndexFeature('GearProject')->willReturn(true)->shouldBeCalled();
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
            $this->config
        );


        $created = $this->moduleService->create($moduleName, $type);

        $this->assertTrue($created);
    }

    /**
     * @group create1
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
        $this->testService->createTests($type)->willReturn(true)->shouldBeCalled();


        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();
        $this->schemaController->create($moduleName, 'IndexController', 'factories', 'Console')->willReturn(true)->shouldBeCalled();
        $this->schemaAction->create($moduleName, 'IndexController', 'Index')->willReturn(true)->shouldBeCalled();


        $this->consoleControllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->controllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->consoleControllerTest->module()->shouldBeCalled();
        $this->consoleController->module()->shouldBeCalled();
        $this->consoleControllerTest->moduleFactory()->shouldBeCalled();
        $this->consoleController->moduleFactory()->shouldBeCalled();

        $this->codeception->appendIntoCodeceptionProject()->willReturn(true)->shouldBeCalled();
        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type)->shouldBeCalled();

        $this->languageService->create()->shouldBeCalled();

        $this->docs->createConfig()->shouldBeCalled();
        $this->docs->createIndex()->shouldBeCalled();
        $this->docs->createReadme()->shouldBeCalled();


        /**
        $files = (new \Gear\Module())->getLocation().'/../../test/integration/module-files-cli.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../test/integration/module-files-cli.yml')
        );
        */

        $this->fileCreator = $this->prophesize('Gear\Creator\File');

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
         $this->fileCreator = $this->prophesize('Gear\Creator\File');
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
            $this->config
        );


        $created = $this->moduleService->create($moduleName, $type);

        $this->assertTrue($created);
    }

    /**
     * @group mod1
     * @group vamov
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
        $this->schemaController->create($moduleName, 'IndexController', 'factories', 'Console')->willReturn(true)->shouldBeCalled();
        $this->schemaAction->create($moduleName, 'IndexController', 'Index')->willReturn(true)->shouldBeCalled();


        $this->consoleControllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->controllerTest->generateAbstractClass()->shouldNotBeCalled();
        $this->consoleControllerTest->module()->shouldBeCalled();
        $this->consoleController->module()->shouldBeCalled();
        $this->consoleControllerTest->moduleFactory()->shouldBeCalled();
        $this->consoleController->moduleFactory()->shouldBeCalled();



        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService->module($type)->shouldBeCalled();

        $this->languageService->create()->shouldBeCalled();

        $this->docs->createConfig()->shouldBeCalled();
        $this->docs->createIndex()->shouldBeCalled();
        $this->docs->createReadme()->shouldBeCalled();

        $files = (new \Gear\Module())->getLocation().'/../../test/integration/module-files-cli.yml';

        $this->assertFileExists($files);

        $parser = new Parser();

        $files = $parser->parse(
            file_get_contents((new \Gear\Module())->getLocation().'/../../test/integration/module-files-cli.yml')
        );

        $this->fileCreator = $this->prophesize('Gear\Creator\File');

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
         $this->fileCreator = $this->prophesize('Gear\Creator\File');
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
            $this->config
        );


        $created = $this->moduleService->moduleAsProject($moduleName, $location, $type);

        $this->assertTrue($created);
    }
}