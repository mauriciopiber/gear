<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ModuleControllerTest extends AbstractConsoleControllerTestCase
{
    const CREATE       = 'gear module create PiberUnit';
    const LIGHT        = 'gear module create PHPUnit --light';
    const PUSH         = 'gear module push PHPUnit --description="Teste"';
    const UNLOAD       = 'gear module unload PiberUnit';
    const LOAD         = 'gear module load PiberUnit';
    const LOADBEFORE   = 'gear module load PiberUnit --before=Anthem';
    const LOADAFTER    = 'gear module load PiberUnit --after=After';
    const BUILD        = 'gear module build PiberUnit --trigger=dev';
    const DELETE       = 'gear module delete PiberUnit';


    const DUMP_ARRAY   = 'gear module dump %s --json';
    const DUMP_JSON    = 'gear module dump %s --array';
    const DUMP_NOTYPE  = 'gear module dump %s ';

    /** gear **/
    const SINGLE   = 'gear module build Admin --trigger="dev"';
    const COMPOSE  = 'gear module build admin --trigger="phpcs,phpmd,phpcpd"';

    const ENTITIES     = 'gear module entities %s';
    const ENTITY       = 'gear module entity %s --entity=%s';


    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php');

        parent::setUp();

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $controllerManager = $this->getApplication()
        ->getServiceManager()
        ->get('controllermanager');

        $this->moduleController = $controllerManager->get('Gear\Controller\Module');

        $mockModuleService = $this->getMockBuilder('Gear\Service\Module\ModuleService')
        ->disableOriginalConstructor()
        ->getMock();
        $mockModuleService->expects($this->any())
        ->method('create')
        ->willReturn('Módulo criado com sucesso');

        $mockModuleService->expects($this->any())
        ->method('light')
        ->willReturn('Módulo light criado com sucesso');

        $mockModuleService->expects($this->any())
        ->method('delete')
        ->willReturn('Módulo deletado com sucesso');
        $mockModuleService->expects($this->any())
        ->method('load')
        ->willReturn('Módulo carregado com sucesso');
        $mockModuleService->expects($this->any())
        ->method('unload')
        ->willReturn('Módulo descarregado com sucesso');

        $mockModuleService->expects($this->any())
        ->method('push')
        ->willReturn('Módulo descarregado com sucesso');

        $this->moduleController->setModuleService($mockModuleService);

        $mockModuleService = $this->getMockBuilder('Gear\Service\BuildService')
        ->disableOriginalConstructor()
        ->getMock();
        $mockModuleService->expects($this->any())
        ->method('build')
        ->willReturn('Build realizada com sucesso');

        $this->moduleController->setBuildService($mockModuleService);


        $mockModuleService = $this->getMockBuilder('Gear\Service\Constructor\JsonService')
        ->disableOriginalConstructor()
        ->getMock();
        $mockModuleService->expects($this->any())
        ->method('dump')
        ->willReturn('Dump realizada com sucesso');

        $this->moduleController->setJsonService($mockModuleService);

        $mockModuleService = $this->getMockBuilder('Gear\Service\Mvc\EntityService')
        ->disableOriginalConstructor()
        ->getMock();
        $mockModuleService->expects($this->any())
        ->method('setUpEntity')
        ->willReturn('Entity criada');
        $mockModuleService->expects($this->any())
        ->method('setUpEntities')
        ->willReturn('Entidades criadas');

        $this->moduleController->setEntityService($mockModuleService);

    }


    public function testSingleBuild()
    {
        $this->dispatch(self::SINGLE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('build');
        $this->assertMatchedRouteName('gear-module-build');
    }

    public function testComposeBuild()
    {
        $this->dispatch(self::COMPOSE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('build');
        $this->assertMatchedRouteName('gear-module-build');
    }

    public function testCreateModule()
    {
        $this->dispatch(self::CREATE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('create');
        $this->assertMatchedRouteName('gear-module-create');

    }

    public function testCreateLightModule()
    {
        $this->dispatch(self::LIGHT);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('light');
        $this->assertMatchedRouteName('gear-module-light');
    }

    public function testUnloadModule()
    {
        $this->dispatch(self::UNLOAD);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('unload');
        $this->assertMatchedRouteName('gear-module-unload');
    }

    public function testLoadModule()
    {
        $this->dispatch(self::LOAD);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('load');
        $this->assertMatchedRouteName('gear-module-load');
    }

    public function testLoadBeforeModule()
    {
        $this->dispatch(self::LOADBEFORE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('load');
        $this->assertMatchedRouteName('gear-module-load');
    }

    public function testLoadAfterModule()
    {
        $this->dispatch(self::LOADAFTER);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('load');
        $this->assertMatchedRouteName('gear-module-load');
    }

    public function testBuildModule()
    {
        $this->dispatch(self::BUILD);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('build');
        $this->assertMatchedRouteName('gear-module-build');
    }

    public function testPushModule()
    {
        $this->dispatch(self::PUSH);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('push');
        $this->assertMatchedRouteName('gear-module-push');
    }

    public function testDeleteModule()
    {
        $this->dispatch(self::DELETE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('delete');
        $this->assertMatchedRouteName('gear-module-delete');
    }

    public function testSetUpEntities()
    {
        $this->dispatch(sprintf(self::ENTITIES, 'Piber'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('entities');
        $this->assertMatchedRouteName('gear-module-entities');
    }

    public function testSetUpEntity()
    {
        $this->dispatch(sprintf(self::ENTITY, 'Piber', 'Module,Controller,Action'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('entity');
        $this->assertMatchedRouteName('gear-module-entity');
    }

    /**
     * @group rev3
     */
    public function testDumpSchemaAsArray()
    {
        $this->dispatch(sprintf(self::DUMP_ARRAY, 'Project'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('dump');
        $this->assertMatchedRouteName('gear-module-dump');
    }

    /**
     * @group rev3
     */
    public function testDumpSchemaAsJson()
    {
        $this->dispatch(sprintf(self::DUMP_JSON, 'TesteModule'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('dump');
        $this->assertMatchedRouteName('gear-module-dump');
    }

    /**
     * @group rev3
     */
    public function testDumpSchemaNoType()
    {
        $this->dispatch(sprintf(self::DUMP_NOTYPE, 'TesteModule'));
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('dump');
        $this->assertMatchedRouteName('gear-module-dump');
    }

}