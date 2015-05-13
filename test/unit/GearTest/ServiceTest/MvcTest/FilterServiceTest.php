<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;

class FilterServiceTest extends AbstractTestCase
{
    use \Gear\Common\FilterServiceTrait;

    use \GearTest\ColumnsNotNullMockTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName', 'getFilterFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getFilterFolder')->willReturn(__DIR__.'/_files');
        $this->getFilterService()->setModule($module);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getFilterService()->getTemplateService()->setRenderer($phpRenderer);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }


    /**
     * @group src-filter-007
     */
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

        $this->getFilterService()->setGearSchema($mockSchema);

        $this->getFilterService()->introspectFromTable($db);

        $expected = file_get_contents(__DIR__.'/_expected/filter/src-007.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/ColumnsNotNullFilter.php');

        $this->assertEquals($expected, $actual);
    }

    public function testCreateDbWithColumnsNotNullSpeciality()
    {

    }




}
