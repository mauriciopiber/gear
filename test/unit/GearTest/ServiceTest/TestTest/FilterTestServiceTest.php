<?php
namespace GearTest\ServiceTest\TestTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group test-filter
 * @group filter
 */
class FilterTestServiceTest extends AbstractTestCase
{
    use \Gear\Common\FilterTestServiceTrait;

    use \GearTest\ColumnsNotNullMockTrait;

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

    /**
     * @group test-filter-001
     */
    public function testCreateSrc()
    {
        //src with db
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('MyFilter');
        $src->expects($this->any())->method('getType')->willReturn('Filter');

        $this->getFilterTestService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/filter/test-001.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/MyFilterTest.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group test-filter-006

    public function testCreateSrcWithDb()
    {
        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable', 'getTableObject'));
        $db->expects($this->any())->method('getTable')->willReturn('ColumnsNotNull');
        $db->expects($this->any())->method('getTableObject')->willReturn($this->getColumnsNotNullMock());

        //src with db
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency', 'getDb'));
        $src->expects($this->any())->method('getName')->willReturn('ColumnsNotNullFilter');
        $src->expects($this->any())->method('getType')->willReturn('Filter');
        $src->expects($this->any())->method('getDb')->willReturn($db);

        $this->getFilterTestService()->create($src);
        $this->getFilterTestService()->setTableData(array());

        $expected = file_get_contents(__DIR__.'/_expected/filter/test-006.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/ColumnsNotNullFilterTest.php');

        $this->assertEquals($expected, $actual);
    }
  */
    /**
     * @group test-filter-007

    public function testCreateDb()
    {
        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getTable', 'getTableObject'));
        $db->expects($this->any())->method('getTable')->willReturn('ColumnsNotNull');
        $db->expects($this->any())->method('getTableObject')->willReturn($this->getColumnsNotNullMock());

          //src with db
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency', 'getDb'));
        $src->expects($this->any())->method('getName')->willReturn('ColumnsNotNullFilter');
        $src->expects($this->any())->method('getType')->willReturn('Filter');
        $src->expects($this->any())->method('getDb')->willReturn($db);

        $mockSchema = $this->getMockSingleClass('Gear\Schema', array('getSrcByDb'));
        $mockSchema->expects($this->at(0))->method('getSrcByDb')->with($db)->willReturn($src);

        $this->getFilterTestService()->setGearSchema($mockSchema);
        $this->getFilterTestService()->setTableData(array());

        $this->getFilterTestService()->introspectFromTable($db);

        $expected = file_get_contents(__DIR__.'/_expected/filter/test-006.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/ColumnsNotNullFilterTest.php');

        $this->assertEquals($expected, $actual);
    }
     */
}
