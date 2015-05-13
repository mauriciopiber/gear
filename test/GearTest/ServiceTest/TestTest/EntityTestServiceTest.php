<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

class EntityTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\EntityTestServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestEntityFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestEntityFolder')->willReturn(__DIR__.'/_files/');
        $this->getEntityTestService()->setModule($module);

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);
        $this->getEntityTestService()->setGearSchema($schema);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../view');
        $this->getEntityTestService()->getTemplateService()->setRenderer($phpRenderer);

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

        $this->getEntityTestService()->create($src);

        $this->assertFileExists(__DIR__.'/_files/ColumnsTest.php');

        $expected = file_get_contents(__DIR__.'/_expected/entity/test-006.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/ColumnsTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-entity-007
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

        $this->getEntityTestService()->introspectFromTable($db);

        $this->assertFileExists(__DIR__.'/_files/ColumnsTest.php');

        $expected = file_get_contents(__DIR__.'/_expected/entity/test-006.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/ColumnsTest.php');

        $this->assertEquals($expected, $actual);

    }
}
