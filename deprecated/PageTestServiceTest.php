<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group page
 */
class PageTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\PageTestServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestPagesFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestPagesFolder')->willReturn(__DIR__.'/_files');
        $this->getPageTestService()->setModule($module);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getPageTestService()->getTemplateService()->setRenderer($phpRenderer);
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


        $this->getPageTestService()->createAction($action);

        $expect  = file_get_contents(__DIR__.'/_expected/action/page-001.phtml');
        $actual  = file_get_contents(__DIR__.'/_files/ControllerNameMyActionPage.php');

        $this->assertFileExists(__DIR__.'/_files/ControllerNameMyActionPage.php');

        //$this->assertEquals($expect, $actual);
    }
}
