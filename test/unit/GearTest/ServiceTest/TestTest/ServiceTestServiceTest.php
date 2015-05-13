<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

class ServiceTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\ServiceTestServiceTrait;

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

    public function testCreateWithDb()
    {
        $this->assertTrue(true);
    }

    public function testDb()
    {
        $this->assertTrue(true);
    }
}
