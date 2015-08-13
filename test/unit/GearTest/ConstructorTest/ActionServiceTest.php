<?php
namespace GearTest\ServiceTest\ConstructorTest;

use GearBaseTest\AbstractTestCase;
use Gear\Service\Constructor\ActionServiceTrait;

/**
 * @group action
 */
class ActionServiceTest extends AbstractTestCase
{
    use ActionServiceTrait;

    public function setUp()
    {
        parent::setUp();
        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $this->module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');

        $this->getActionService()->setModule($this->module);

        $this->schemaJson = file_get_contents(__DIR__.'/_include/schema-controller.json');
    }


    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group Test2
     */
    public function testCreateActionInvalid()
    {
        $action = $this->getActionService()->create(array());
        $this->assertFalse($action);
    }

    public function testControllerNoExist()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->schema = $this->getMockSingleClass('Gear\Schema', array('getControllerByName'));
        $this->schema->expects($this->any())->method('getControllerByName')->willReturn(false);
        $this->getActionService()->setGearSchema($this->schema);

        $action = ['controller' => 'WrongNameController', 'module' => 'SchemaModule', 'name' => 'NoValidController'***REMOVED***;

        $action = $this->getActionService()->create($action);
    }

    /**
     * @group action
     */
    public function testCreateAction()
    {
        $mockAcceptance = $this->getMockSingleClass('Gear\Service\Test\AcceptanceTestService', array('createAction'));
        $mockAcceptance->expects($this->any())->method('createAction')->willReturn(true);

        $this->getActionService()->setAcceptanceTestService($mockAcceptance);

        $mockFunctional = $this->getMockSingleClass('Gear\Service\Test\FunctionalTestService', array('createAction'));
        $mockFunctional->expects($this->any())->method('createAction')->willReturn(true);

        $this->getActionService()->setFunctionalTestService($mockFunctional);

        $mockPage = $this->getMockSingleClass('Gear\Service\Test\PageTestService', array('createAction'));
        $mockPage->expects($this->any())->method('createAction')->willReturn(true);

        $this->getActionService()->setPageTestService($mockPage);

        $mockControllerTest = $this->getMockSingleClass('Gear\Service\Test\ControllerTestService', array('implement'));
        $mockControllerTest->expects($this->any())->method('implement')->willReturn(true);

        $this->getActionService()->setControllerTestService($mockControllerTest);

        $mockView = $this->getMockSingleClass('Gear\Service\Test\ViewService', array('createFromPage', 'getTimeTest'));
        $mockView->expects($this->any())->method('createFromPage')->willReturn(true);
        $mockView->expects($this->any())->method('getTimeTest')->willReturn(true);

        $this->getActionService()->setViewService($mockView);

        $mockController = $this->getMockSingleClass('Gear\Service\Mvc\ControllerService', array('implement'));
        $mockController->expects($this->any())->method('implement')->willReturn(true);

        $this->getActionService()->setControllerService($mockController);

        $mockConfig = $this->getMockSingleClass('Gear\Service\Mvc\ConfigService', array('mergeRouterConfig', 'mergeNavigationConfig'));
        $mockConfig->expects($this->any())->method('mergeRouterConfig')->willReturn(true);
        $mockConfig->expects($this->any())->method('mergeNavigationConfig')->willReturn(true);

        $this->getActionService()->setConfigService($mockConfig);


        $controllerMockObject = $this->getMockSingleClass('Gear\ValueObject\Controller');

        $this->schema = $this->getMockSingleClass('Gear\Schema', array('getControllerByName', 'overwrite'));
        $this->schema->expects($this->any())->method('getControllerByName')->willReturn($controllerMockObject);
        $this->schema->expects($this->any())->method('overwrite')->willReturn(true);
        $this->getActionService()->setGearSchema($this->schema);


        $action = ['controller' => 'Internacional', 'module' => 'SchemaModule', 'name' => 'CampeaoDoMundo'***REMOVED***;

        $action = $this->getActionService()->create($action);

        $this->assertTrue($action);
    }
}
