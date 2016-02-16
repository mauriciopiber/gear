<?php
namespace GearTest\ServiceTest\ConstructorTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Action\ActionServiceTrait;

/**
 * @group module
 */
class ActionServiceTest extends AbstractTestCase
{
    use ActionServiceTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\Action\ActionService', $this->getActionConstructor());
    }

    /*
    public function setUp()
    {
        parent::setUp();
        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $this->module = $this->getMockSingleClass('Gear\Module\BasicModuleStructure', array('getModuleName'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');

        $this->getActionConstructor()->setModule($this->module);

        $this->schemaJson = file_get_contents(__DIR__.'/_include/schema-controller.json');
    }


    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    public function testCreateActionInvalid()
    {
        $action = $this->getActionConstructor()->createControllerAction(array());
        $this->assertFalse($action);
    }
    */
}
