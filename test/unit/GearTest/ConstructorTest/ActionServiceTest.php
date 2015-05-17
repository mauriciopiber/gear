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

    public function testCreateAction()
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
}
