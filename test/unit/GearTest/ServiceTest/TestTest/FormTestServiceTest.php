<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

class FormTestServiceTest extends AbstractTestCase
{
    use \Gear\Mvc\Form\FormTestServiceTrait;

    use \GearTest\ColumnsMockTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getTestFormFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getTestFormFolder')->willReturn(__DIR__.'/_files');
        $this->getFormTestService()->setModule($module);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getFormTestService()->getTemplateService()->setRenderer($phpRenderer);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
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
