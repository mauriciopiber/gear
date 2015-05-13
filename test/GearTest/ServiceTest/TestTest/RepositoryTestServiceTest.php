<?php
namespace GearTest\RepositoryTest\TestTest;

use GearBaseTest\AbstractTestCase;

class RepositoryTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\RepositoryTestServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestRepositoryFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestRepositoryFolder')->willReturn(__DIR__.'/_files');
        $this->getRepositoryTestService()->setModule($module);

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);
        $this->getRepositoryTestService()->setGearSchema($schema);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../view');
        $this->getRepositoryTestService()->getTemplateService()->setRenderer($phpRenderer);

    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group test-repository-001
     */
    public function testCreate()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepository');
        $src->expects($this->any())->method('getType')->willReturn('Repository');

        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-001.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-repository-002
     */
    public function testCreateSrcDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-002.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryDependencyTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-repository-003
     */
    public function testCreateSrcMultiDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryMultiDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService', 'Service\AnotherService', 'Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-003.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryMultiDependencyTest.php');

        $this->assertEquals($expected, $actual);

    }

    /**
     * @group test-repository-004
     */
    public function testCreateSrcExtends()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryExtends');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Repository\AbstractRepository');
        $this->getRepositoryTestService()->createFromSrc($src);


        $expected = file_get_contents(__DIR__.'/_expected/repository/test-004.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtendsTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-repository-005
     */
    public function testCreateSrcDependencyExtends()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryExtendsDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Repository\AbstractRepository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryTestService()->createFromSrc($src);

        $expected = file_get_contents(__DIR__.'/_expected/repository/test-005.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtendsDependencyTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-repository-006
     */
    public function testCreateWithDb()
    {
        $table = $this->getMockSingleClass('Zend\Db\Metadata\Object\TableObject', array('getName'));
        $table->expects($this->any())->method('getName')->willReturn('my');

        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable', 'getTableObject', 'getTableColumnsMapping', 'getColumns'));
        $db->expects($this->any())->method('getTable')->willReturn('My');
        $db->expects($this->any())->method('getTableObject')->willReturn($table);
        $db->expects($this->any())->method('getTableColumnsMapping')->willReturn(array());
        $db->expects($this->at(0))->method('getColumns')->willReturn('{}');
        //$db->expects($this->at(1))->method('getColumns')->willReturn(array());
        //src with db
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency', 'getDb'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepository');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getDb')->willReturn($db);

        $metadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getColumns', 'getTable'));
        $metadata->expects($this->any())->method('getColumns')->willReturn(array());
        $metadata->expects($this->any())->method('getTable')->willReturn($table);

        $this->getRepositoryTestService()->setMetadata($metadata);
        $this->getRepositoryTestService()->setTableData(array());
       /*  $this->getRepositoryService()->setInstance($db);
        $this->getRepositoryService()->setTableData(array());
        $this->getRepositoryService()->getMappingService()->setInstance($db); */

        $this->getRepositoryTestService()->createFromSrc($src);

        $expected = file_get_contents(__DIR__.'/_expected/repository/test-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryTest.php');

        $this->assertEquals($expected, $actual);

    }

    /**
     * @group test-repository-007
     */
    public function testDb()
    {
        $table = $this->getMockSingleClass('Zend\Db\Metadata\Object\TableObject', array('getName'));
        $table->expects($this->any())->method('getName')->willReturn('my');

        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable', 'getTableObject', 'getTableColumnsMapping'));
        $db->expects($this->any())->method('getTable')->willReturn('My');
        $db->expects($this->any())->method('getTableObject')->willReturn($table);
        $db->expects($this->any())->method('getTableColumnsMapping')->willReturn(array());

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepository');
        $src->expects($this->any())->method('getType')->willReturn('Repository');

        $metadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getColumns', 'getTable'));
        $metadata->expects($this->any())->method('getColumns')->willReturn(array());
        $metadata->expects($this->any())->method('getTable')->willReturn($table);

        $this->getRepositoryTestService()->setMetadata($metadata);
        $this->getRepositoryTestService()->setTableData(array());


      /*   $this->getRepositoryService()->setInstance($db);
        $this->getRepositoryService()->setGearSchema($mockSchema);
        $this->getRepositoryService()->setTableData(array());
        $this->getRepositoryService()->getMappingService()->setInstance($db); */

        $this->getRepositoryTestService()->introspectFromTable($db);

        //die();

        $expected = file_get_contents(__DIR__.'/_expected/repository/test-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryTest.php');

        $this->assertEquals($expected, $actual);
    }
}
