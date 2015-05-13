<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

class FilterTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\FilterTestServiceTrait;

    use \GearTest\ColumnsMockTrait;

    public function setUp()
    {
        parent::setUp();
        $dirFiles = __DIR__.'/_files';
        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestFilterFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestFilterFolder')->willReturn(__DIR__.'/_files');
        $this->getFilterTestService()->setModule($module);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getFilterTestService()->getTemplateService()->setRenderer($phpRenderer);
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->removeDirectory(__DIR__.'/_files');
    }

    public function testCreateSrc()
    {
        $this->assertTrue(true);
    }

    public function testCreateSrcWithDb()
    {
        $this->assertTrue(true);
    }

    public function testCreateDb()
    {
        $this->assertTrue(true);
    }
}
