<?php
namespace GearTest;

use GearBaseTest\AbstractTestCase;

class SchemaTest extends AbstractTestCase
{
    public function setUp()
    {

        parent::setUp();
        unset($this->srcService);
        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    public function testInitSchema()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schemaInit = $schema->init();

        $this->assertArrayHasKey('SchemaModule', $schemaInit);
        $this->assertArrayHasKey('src', $schemaInit['SchemaModule'***REMOVED***);
        $this->assertArrayHasKey('controller', $schemaInit['SchemaModule'***REMOVED***);
        $this->assertArrayHasKey('db', $schemaInit['SchemaModule'***REMOVED***);
    }

    public function testPersistSchema()
    {
        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getMainFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getMainFolder')->willReturn(__DIR__.'/_files');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');

        $init = $schema->init();

        $schema->persistSchema($init);

        $this->assertFileExists(__DIR__.'/_files/schema.json');
    }
}
