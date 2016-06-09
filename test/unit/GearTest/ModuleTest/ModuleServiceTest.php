<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Module
 * @group ModuleServiceTest
 */
class ModuleServiceTest extends AbstractTestCase
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
        $stringService  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->dirService = new \GearBase\Util\Dir\DirService();
        $this->stringService = new \GearBase\Util\String\StringService();

        $this->moduleService = new \Gear\Module\ModuleService();
        $this->moduleService->setFileCreator($fileCreator);
        $this->moduleService->setStringService($stringService);
    }

    /**
     * @group create1
     */
    public function testScriptDeploy()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService->setModule($this->module->reveal());
        $this->moduleService->scriptDevelopment('cli');

        $expected = $this->templates.'/deploy-development-cli.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/deploy-development.sh'))
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
     */
    public function testCreateModuleAsProject($type = 'web')
    {
        $moduleName = 'MyModule';
        $location = vfsStream::url('module');

        $module = new \Gear\Module\BasicModuleStructure();
        $module->setRequestName($moduleName);
        $module->setDirService($this->dirService);
        $module->setStringService($this->stringService);

        $this->composer = $this->prophesize('Gear\Module\ComposerService');
        $this->composer->createComposerAsProject()->willReturn(true)->shouldBeCalled();

        $this->testService = $this->prophesize('Gear\Module\TestService');
        $this->testService->createTestsModuleAsProject()->willReturn(true)->shouldBeCalled();

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schema->create($moduleName)->willReturn(true)->shouldBeCalled();

        $this->schemaLoader = $this->prophesize('GearJson\Schema\Loader\SchemaLoaderService');
        $this->schemaLoader->loadSchema()->willReturn(true)->shouldBeCalled();

        $this->schemaController = $this->prophesize('GearJson\Controller\ControllerService');
        $this->schemaController->create($moduleName, 'IndexController')->willReturn(true)->shouldBeCalled();

        $this->schemaAction = $this->prophesize('GearJson\Action\ActionService');
        $this->schemaAction->create($moduleName, 'IndexController', 'Index')->willReturn(true)->shouldBeCalled();

        $this->consoleControllerTest = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleControllerTest');
        $this->consoleControllerTest->generateAbstractClass()->shouldBeCalled();

        $this->controllerTest = $this->prophesize('Gear\Mvc\Controller\ControllerTestService');
        $this->controllerTest->generateAbstractClass()->shouldBeCalled();
        $this->controllerTest->module()->shouldBeCalled();


        $this->controller = $this->prophesize('Gear\Mvc\Controller\ControllerService');
        $this->controller->module()->shouldBeCalled();

        $this->codeception = $this->prophesize('Gear\Module\CodeceptionService');
        $this->codeception->createFullSuite()->willReturn(true)->shouldBeCalled();

        $this->configService = $this->prophesize('Gear\Mvc\Config\ConfigService');
        $this->configService->module()->shouldBeCalled();

        $this->languageService = $this->prophesize('Gear\Mvc\LanguageService');
        $this->languageService->create()->shouldBeCalled();

        $this->angularService = $this->prophesize('Gear\Mvc\View\AngularService');
        $this->angularService->createIndexController()->shouldBeCalled();

        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');
        $this->viewService->createIndexView()->shouldBeCalled();
        $this->viewService->createErrorView()->shouldBeCalled();
        $this->viewService->createDeleteView()->shouldBeCalled();
        $this->viewService->create404View()->shouldBeCalled();
        //$this->viewService->createLayoutView()->shouldBeCalled();
        $this->viewService->createLayoutSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteSuccessView()->shouldBeCalled();
        $this->viewService->createLayoutDeleteFailView()->shouldBeCalled();
        $this->viewService->createBreadcrumbView()->shouldBeCalled();

        $this->moduleService->setViewService($this->viewService->reveal());

        $this->karma = $this->prophesize('Gear\Module\Node\Karma');
        $this->karma->create()->shouldBeCalled();
        $this->karma->createTestIndexAction()->shouldBeCalled();

        $this->protractor = $this->prophesize('Gear\Module\Node\Protractor');
        $this->protractor->create()->shouldBeCalled();
        $this->protractor->createTestIndexAction()->shouldBeCalled();

        $this->package = $this->prophesize('Gear\Module\Node\Package');
        $this->package->create()->shouldBeCalled();

        $this->gulpfile = $this->prophesize('Gear\Module\Node\Gulpfile');
        $this->gulpfile->create()->shouldBeCalled();

        $this->moduleService->setKarma($this->karma->reveal());
        $this->moduleService->setProtractor($this->protractor->reveal());
        $this->moduleService->setPackage($this->package->reveal());
        $this->moduleService->setGulpfile($this->gulpfile->reveal());

        $this->moduleService->setAngularService($this->angularService->reveal());

        $this->moduleService->setLanguageService($this->languageService->reveal());

        $this->moduleService->setConfigService($this->configService->reveal());
        $this->moduleService->setMvcController($this->controller->reveal());
        $this->moduleService->setConsoleControllerTest($this->consoleControllerTest->reveal());
        $this->moduleService->setControllerTestService($this->controllerTest->reveal());
        $this->moduleService->setComposerService($this->composer->reveal());
        $this->moduleService->setModule($module);
        $this->moduleService->setTestService($this->testService->reveal());

        $this->moduleService->setSchemaService($this->schema->reveal());
        $this->moduleService->setSchemaLoaderService($this->schemaLoader->reveal());

        $this->moduleService->setControllerService($this->schemaController->reveal());
        $this->moduleService->setActionService($this->schemaAction->reveal());
        $this->moduleService->setCodeceptionService($this->codeception->reveal());

        $created = $this->moduleService->moduleAsProject($moduleName, $location);

        $this->assertTrue($created);
    }

    /**
     * @group create1

    public function testCreateModuleAsProject()
    {
        //$this->moduleService->moduleAsProject('MyModule', vfsStream::url('module'));

    }

    public function testCreateModule()
    {

    }

    public function testDeleteModule()
    {

    }
    */
}