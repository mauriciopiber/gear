<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;

class EntityServiceTest extends AbstractTestCase
{
    use \Gear\Common\EntityServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getSrcFolder', 'getEntityFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getSrcFolder')->willReturn(__DIR__.'/_files');
        $module->expects($this->any())->method('getEntityFolder')->willReturn(__DIR__.'/_files/SchemaModule/Entity');
        $this->getEntityService()->setModule($module);
        $this->getEntityService()->getDoctrineService()->setModule($module);

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);
        $this->getEntityService()->setGearSchema($schema);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../view');
        $this->getEntityService()->getTemplateService()->setRenderer($phpRenderer);


        $mockTest = $this->getMockSingleClass('Gear\Service\Test\EntityTestService', array('createUnitTest'));
        $mockTest->expects($this->any())->method('createUnitTest')->willReturn(true);

        $this->getEntityService()->setEntityTestService($mockTest);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }
    /**
     * @group src-entity-006
     */
    public function testCreateSrcWithDb()
    {
        $table = $this->getMockSingleClass('Zend\Db\Metadata\Object\TableObject', array('getName'));
        $table->expects($this->any())->method('getName')->willReturn('Columns');

        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable', 'getTableObject', 'getTableColumnsMapping', 'getColumns'));
        $db->expects($this->any())->method('getTable')->willReturn('Columns');
        $db->expects($this->any())->method('getTableObject')->willReturn($table);

        //src with db
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDb'));
        $src->expects($this->any())->method('getName')->willReturn('Columns');
        $src->expects($this->any())->method('getType')->willReturn('Entity');
        $src->expects($this->any())->method('getDb')->willReturn($db);

        $this->getEntityService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/entity/src-006.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/SchemaModule/Entity/Columns.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-entity-007
     */
    public function testCreateDb()
    {
        $table = $this->getMockSingleClass('Zend\Db\Metadata\Object\TableObject', array('getName'));
        $table->expects($this->any())->method('getName')->willReturn('Columns');

        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable', 'getTableObject', 'getTableColumnsMapping'));
        $db->expects($this->any())->method('getTable')->willReturn('Columns');
        $db->expects($this->any())->method('getTableObject')->willReturn($table);

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('Columns');
        $src->expects($this->any())->method('getType')->willReturn('Entity');

        $mockSchema = $this->getMockSingleClass('Gear\Schema', array('getSrcByDb', '__extractObject'));
        //$mockSchema->expects($this->at(0))->method('getSrcByDb')->with($db)->willReturn($src);
        $mockSchema->expects($this->at(0))->method('__extractObject')->with('db')->willReturn(array());
        $mockSchema->expects($this->at(1))->method('__extractObject')->with('src')->willReturn(array($src));

        $this->getEntityService()->setGearSchema($mockSchema);

        $this->getEntityService()->introspectFromTable($db);

        $this->assertFileExists(__DIR__.'/_files/SchemaModule/Entity/Columns.php');

        $expected = file_get_contents(__DIR__.'/_expected/entity/src-006.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/SchemaModule/Entity/Columns.php');

        $this->assertEquals($expected, $actual);
    }

    public function testCantCreateWithoutDb()
    {
        $this->setExpectedException('Gear\Exception\InvalidArgumentException');

        //src with db
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDb'));
        $src->expects($this->any())->method('getName')->willReturn('Columns');
        $src->expects($this->any())->method('getType')->willReturn('Entity');
        $src->expects($this->any())->method('getDb')->willReturn(null);

        $this->getEntityService()->create($src);
    }
}
