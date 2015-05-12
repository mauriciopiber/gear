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

    public function testCreateWithDb()
    {
        $this->assertTrue(true);
    }

    public function testDb()
    {
        $this->assertTrue(true);
    }
}
