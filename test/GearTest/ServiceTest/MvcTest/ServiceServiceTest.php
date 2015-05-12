<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;

class ServiceServiceTest extends AbstractTestCase
{
    use \Gear\Common\ServiceServiceTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getServiceFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getServiceFolder')->willReturn(__DIR__.'/_files');
        $this->getServiceService()->setModule($module);

        $schema = new \Gear\Schema($module, $this->getServiceLocator());
        $schema->setName('/schema.json');
        $init = $schema->init();
        $schema->persistSchema($init);
        $this->getServiceService()->setGearSchema($schema);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../view');
        $this->getServiceService()->getTemplateService()->setRenderer($phpRenderer);


        $mockTest = $this->getMockSingleClass('Gear\Service\Test\ServiceTestService', array('introspectFromTable', 'create'));
        $mockTest->expects($this->any())->method('introspectFromTable')->willReturn(true);
        $mockTest->expects($this->any())->method('create')->willReturn(true);

        $this->getServiceService()->setServiceTestService($mockTest);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group src-service-001
     */
    public function testCreate()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('MyService');
        $src->expects($this->any())->method('getType')->willReturn('Service');

        $this->getServiceService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-001.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyService.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-001-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-service-002
     */
    public function testCreateWithDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceDependency');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getServiceService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-002.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceDependency.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-002-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceDependencyTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-service-003
     */
    public function testCreateWithMultiDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceMultiDependency');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService', 'Service\AnotherService', 'Repository\OtherRepository'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getServiceService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-003.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceMultiDependency.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-003-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceMultiDependencyTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-service-004
     */
    public function testCreateWithExtends()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceExtends');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Service\AbstractService');

        $this->getServiceService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-004.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceExtends.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-004-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceExtendsTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-service-005
     */
    public function testCreateWithExtendsDependency()
    {
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency'));
        $src->expects($this->any())->method('getName')->willReturn('MyServiceExtendsDependency');
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getExtends')->willReturn('GearBase\Service\AbstractService');
        $src->expects($this->any())->method('getDependency')->willReturn(array('Service\OtherService'));
        $src->expects($this->any())->method('hasDependency')->willReturn(true);

        $this->getServiceService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-005.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceExtendsDependency.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-005-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceExtendsDependencyTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-service-006
     */
    public function testCreateWithDb()
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

        $this->getServiceService()->setTableData(array());
        $this->getServiceService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyService.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-006-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceTrait.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-service-007
     */
    public function testDb()
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

        $this->getServiceService()->setGearSchema($mockSchema);
        $this->getServiceService()->setTableData(array());
        $this->getServiceService()->introspectFromTable($db);
        //db
        //src
        $expected = file_get_contents(__DIR__.'/_expected/src-service-006.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyService.php');

        $this->assertEquals($expected, $actual);

        $expected = file_get_contents(__DIR__.'/_expected/src-service-006-trait.phtml');
        $actual = file_get_contents(__DIR__.'/_files/MyServiceTrait.php');

        $this->assertEquals($expected, $actual);
    }
}
