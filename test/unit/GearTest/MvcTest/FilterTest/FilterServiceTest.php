<?php
namespace GearTest\MvcTest\FilterTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group src-filter
 * @group filter
 * @group Filter
 */
class FilterServiceTest extends AbstractTestCase
{
    use \Gear\Mvc\Filter\FilterServiceTrait;

    use \GearTest\ColumnsNotNullMockTrait;

    public function setUp()
    {
        parent::setUp();

        $dirFiles = __DIR__.'/_files';

        if (!is_dir($dirFiles)) {
            mkdir($dirFiles, 0777);
        }

        $module = $this->getMockSingleClass('Gear\Module\BasicModuleStructure', array('getModuleName', 'getFilterFolder'));
        $module->expects($this->any())->method('getModuleName')->willReturn('SchemaModule');
        $module->expects($this->any())->method('getFilterFolder')->willReturn(__DIR__.'/_files');
        $this->getFilterService()->setModule($module);

        $phpRenderer = $this->mockPhpRenderer(__DIR__ . '/../../../../../view');
        $this->getFilterService()->getTemplateService()->setRenderer($phpRenderer);

        $mockTest = $this->getMockSingleClass('Gear\Mvc\Filter\FilterTestService', array('create', 'introspectFromTable'));
        $mockTest->expects($this->any())->method('create')->willReturn(true);
        $mockTest->expects($this->any())->method('introspectFromTable')->willReturn(true);
        $this->getFilterService()->setFilterTestService($mockTest);
    }

    public function tearDown()
    {
        parent::tearDown();
        $dirFiles = __DIR__.'/_files';
        $this->removeDirectory($dirFiles);
    }

    /**
     * @group src-filter-001
     */
    public function testCreateSrc()
    {
        //src with db
        $src = $this->getMockSingleClass('GearJson\Src\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('MyFilter');
        $src->expects($this->any())->method('getType')->willReturn('Filter');
        $src->expects($this->any())->method('getDb')->willReturn(null);

        $mockTrait = $this->getMockSingleClass('Gear\Mvc\TraitService', ['createTrait'***REMOVED***);
        $mockTrait->expects($this->any())->method('createTrait')->willReturn(true);

        $mockInterface = $this->getMockSingleClass('Gear\Mvc\InterfaceService', ['createInterface'***REMOVED***);
        $mockInterface->expects($this->any())->method('createInterface')->willReturn(true);

        $this->getFilterService()->setTraitService($mockTrait);
        $this->getFilterService()->setInterfaceService($mockInterface);

        //$this->getFilterService()->create($src);

        //$expected = file_get_contents(__DIR__.'/_expected/filter/src-001.phtml');
        //$actual   = file_get_contents(__DIR__.'/_files/MyFilter.php');

        //$this->assertEquals($expected, $actual);
    }

    /**
     * @group src-filter-006
     */
    public function atestCreateSrcWithDb()
    {
        $db = $this->getMockSingleClass('GearJson\Db\Db', array('getTable', 'getTableObject'));
        $db->expects($this->any())->method('getTable')->willReturn('ColumnsNotNull');
        $db->expects($this->any())->method('getTableObject')->willReturn($this->getColumnsNotNullMock());

        //src with db
        $src = $this->getMockSingleClass('GearJson\Src\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency', 'getDb'));
        $src->expects($this->any())->method('getName')->willReturn('ColumnsNotNullFilter');
        $src->expects($this->any())->method('getType')->willReturn('Filter');
        $src->expects($this->any())->method('getDb')->willReturn($db);

        $this->getFilterService()->create($src);

        $expected = file_get_contents(__DIR__.'/_expected/filter/src-007.phtml');
        $actual   = file_get_contents(__DIR__.'/_files/ColumnsNotNullFilter.php');

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group src-filter-007
     */
    public function atestCreateDb()
    {
        $db = $this->getMockSingleClass('GearJson\Db\Db', array('getTable', 'getTableObject'));
        $db->expects($this->any())->method('getTable')->willReturn('ColumnsNotNull');
        $db->expects($this->any())->method('getTableObject')->willReturn($this->getColumnsNotNullMock());

          //src with db
        $src = $this->getMockSingleClass('GearJson\Src\Src', array('getName', 'getType', 'getExtends', 'getDependency', 'hasDependency', 'getDb'));
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
