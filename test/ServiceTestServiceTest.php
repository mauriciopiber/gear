<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

class ServiceTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\ServiceTestServiceTrait;
    use \GearTest\ColumnsMockTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestServiceFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestServiceFolder')->willReturn(__DIR__.'/_files');

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');

        $this->getServiceTestService()->setModule($module);
        $this->getServiceTestService()->getTemplateService()->setRenderer($phpRenderer);
        $this->getServiceTestService()->setGearSchema($schema);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group test-service-001
     */
    public function testCreate()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('MyService');
        $src->expects($this->any())->method('getType')->willReturn('Service');

        $this->getServiceTestService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/service/test-001.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-service-002
     */
    public function testCreateWithDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceDependency');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getServiceTestService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/service/test-002.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceDependencyTest.php');

        $this->assertEquals($expected, $actual);
    }


    /**
     * @group test-service-003
     */
    public function testCreateWithMultiDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceMultiDependency');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService', 'Service\AnotherService', 'Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getServiceTestService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/service/test-003.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceMultiDependencyTest.php');

        $this->assertEquals($expected, $actual);

    }


    /**
     * @group test-service-004
     */
    public function testCreateWithExtends()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceExtends');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Service\AbstractService');

        $this->getServiceTestService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/service/test-004.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceExtendsTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-service-005
     */
    public function testCreateWithExtendsDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceExtendsDependency');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Service\AbstractService');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getServiceTestService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/service/test-005.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceExtendsDependencyTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-service-006
     */
    public function atestCreateWithDb()
    {
        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable'));
        $db->expects($this->any())->method('getTable')->willReturn('My');

        //src with db
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency', 'getDb'));
        $src->expects($this->any())->method('getName')->willReturn('MyService');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\MyRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);
        $src->expects($this->any())->method('getDb')->willReturn($db);

        $metadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getColumns', 'getTable'));
        $metadata->expects($this->any())->method('getColumns')->willReturn(array());
        $metadata->expects($this->any())->method('getTable')->willReturn($this->getColumnsMock());

        $mockSchema = $this->getMockSingleClass('Gear\Schema', array('getSrcByDb'));
        $mockSchema->expects($this->at(0))->method('getSrcByDb')->with($db)->willReturn($src);

        $this->getServiceTestService()->setMetadata($metadata);
        $this->getServiceTestService()->setGearSchema($mockSchema);
        $this->getServiceTestService()->setTableData(array());
        $this->getServiceTestService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/service/test-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-service-007
     */
    public function atestDb()
    {
        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable'));
        $db->expects($this->any())->method('getTable')->willReturn('My');

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyService');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Repository\MyRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $mockSchema = $this->getMockSingleClass('Gear\Schema', array('getSrcByDb'));
        $mockSchema->expects($this->at(0))->method('getSrcByDb')->with($db)->willReturn($src);

        $metadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getColumns', 'getTable'));
        $metadata->expects($this->any())->method('getColumns')->willReturn(array());
        $metadata->expects($this->any())->method('getTable')->willReturn($this->getColumnsMock());

        $this->getServiceTestService()->setMetadata($metadata);
        $this->getServiceTestService()->setGearSchema($mockSchema);
        $this->getServiceTestService()->setTableData(array());
        $this->getServiceTestService()->introspectFromTable($db);

        //db
        //src
        $expected = file_get_contents(__DIR__.'/_expected/service/test-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceTest.php');

        $this->assertEquals($expected, $actual);

    }

}
