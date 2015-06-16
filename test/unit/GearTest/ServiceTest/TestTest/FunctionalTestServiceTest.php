<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

class FunctionalTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\FunctionalTestServiceTrait;


    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestFunctionalFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestFunctionalFolder')->willReturn(__DIR__.'/_files');
        $this->getFunctionalTestService()->setModule($module);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getFunctionalTestService()->getTemplateService()->setRenderer($phpRenderer);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group action
     */
    public function testCreateAction()
    {
        $controller = $this->getMockSingleClass('Gear\ValueObject\Controller', array('getName', 'getObject'));
        $controller->expects($this->any())->method('getName')->willReturn('ControllerName');
        $controller->expects($this->any())->method('getObject')->willReturn('\%\Controller\ControllerName');

        $action = $this->getMockSingleClass('Gear\ValueObject\Action', array('getController', 'getName', 'getRoute'));
        $action->expects($this->any())->method('getController')->willReturn($controller);
        $action->expects($this->any())->method('getName')->willReturn('MyAction');
        $action->expects($this->any())->method('getRoute')->willReturn('my-action');


        $this->getFunctionalTestService()->createAction($action);

        $this->assertFileExists(__DIR__.'/_files/ControllerNameMyActionCest.php');

        //$this->assertEquals($expect, $actual);
    }
}
