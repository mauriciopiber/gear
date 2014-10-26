<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ModuleControllerTest extends AbstractConsoleControllerTestCase
{
    const CREATE       = 'gear module create PiberUnit';
    const UNLOAD       = 'gear unload PiberUnit';
    const LOAD         = 'gear load PiberUnit';
    const LOADBEFORE   = 'gear load PiberUnit';
    const BUILD        = 'gear build PiberUnit --build=dev';
    const DELETE       = 'gear module delete PiberUnit';

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
        ->method('delete')
        ->willReturn('Módulo deletado com sucesso');
        $mockModuleService->expects($this->any())
        ->method('load')
        ->willReturn('Módulo carregado com sucesso');
        $mockModuleService->expects($this->any())
        ->method('unload')
        ->willReturn('Módulo descarregado com sucesso');

        $this->moduleController->setModuleService($mockModuleService);
    }

    public function testCreateModule()
    {
        $this->dispatch(self::CREATE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('module');
        $this->assertMatchedRouteName('gear-module');
    }

    public function testUnloadModule()
    {
        $this->dispatch(self::UNLOAD);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('load');
        $this->assertMatchedRouteName('gear-load');
    }

    public function testLoadModule()
    {
        $this->dispatch(self::LOAD);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('load');
        $this->assertMatchedRouteName('gear-load');
    }

    public function testLoadBeforeModule()
    {
        $this->dispatch(self::LOADBEFORE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('load');
        $this->assertMatchedRouteName('gear-load');
    }
/*
    public function testBuildModule()
    {
        $this->dispatch(self::BUILD);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('build');
        $this->assertMatchedRouteName('gear-build');
    }
 */
    public function testDeleteModule()
    {
        $this->dispatch(self::DELETE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('ModuleController');
        $this->assertControllerName('Gear\Controller\Module');
        $this->assertActionName('module');
        $this->assertMatchedRouteName('gear-module');
    }
}