<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;

class RepositoryServiceTest extends AbstractTestCase
{
    use \Gear\Common\RepositoryServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getRepositoryFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getRepositoryFolder')->willReturn(__DIR__.'/_files');
        $this->getRepositoryService()->setModule($module);

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);
        $this->getRepositoryService()->setGearSchema($schema);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getRepositoryService()->getTemplateService()->setRenderer($phpRenderer);


        $mockTest = $this->getMockSingleClass('Gear\Service\Test\RepositoryTestService', array('introspectFromTable', 'createFromSrc', 'createAbstract'));
        $mockTest->expects($this->any())->method('introspectFromTable')->willReturn(true);
        $mockTest->expects($this->any())->method('createFromSrc')->willReturn(true);
        $mockTest->expects($this->any())->method('createAbstract')->willReturn(true);

        $this->getRepositoryService()->setRepositoryTestService($mockTest);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }


    /**
     * @group src-repository-001
     */
    public function testCreate()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepository');
        $src->expects($this->any())->method('getType')->willReturn('Repository');

        $this->getRepositoryService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-001.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepository.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-001-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-repository-002
     */
    public function testCreateWithDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-002.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryDependency.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-002-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryDependencyTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-repository-003
     */
    public function testCreateWithMultiDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryMultiDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService', 'Service\AnotherService', 'Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-003.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryMultiDependency.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-003-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryMultiDependencyTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-repository-004
     */
    public function testCreateWithExtends()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryExtends');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Repository\AbstractRepository');

        $this->getRepositoryService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-004.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtends.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-004-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtendsTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-repository-005
     */
    public function testCreateWithExtendsDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyRepositoryExtendsDependency');
        $src->expects($this->any())->method('getType')->willReturn('Repository');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Repository\AbstractRepository');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getRepositoryService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-005.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtendsDependency.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-005-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryExtendsDependencyTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-repository-006
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

        $this->getRepositoryService()->setInstance($db);
        $this->getRepositoryService()->setTableData(array());
        $this->getRepositoryService()->getMappingService()->setInstance($db);

        $this->getRepositoryService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepository.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-006-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-repository-007
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

        $mockSchema = $this->getMockSingleClass('Gear\Schema', array('getSrcByDb'));
        $mockSchema->expects($this->at(0))->method('getSrcByDb')->with($db)->willReturn($src);

        $this->getRepositoryService()->setInstance($db);
        $this->getRepositoryService()->setGearSchema($mockSchema);
        $this->getRepositoryService()->setTableData(array());
        $this->getRepositoryService()->getMappingService()->setInstance($db);

        $this->getRepositoryService()->introspectFromTable($db);
        //db
        //src
        $expected = file_get_contents(__DIR__.'/_expected/src-repository-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepository.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-repository-006-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyRepositoryTrait.php');

        $this->assertEquals($expected, $actual);
    }

}
