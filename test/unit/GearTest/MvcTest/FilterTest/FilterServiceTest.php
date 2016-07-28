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
     * @group DateFilter
     */
    public function testDateTimeFormatter()
    {

        $date = '1990-09-21';
        //$date = '21/09/1990';

        $formatter = new \Zend\Filter\DateTimeFormatter();
        $formatter->setFormat('d/m/Y');

        //$expected = '1900-09-21';
        $expected = '21/09/1990';


        $this->assertEquals($expected, $formatter->filter($date));
    }

    /**
     * @group src-filter-001
     */
    public function testCreateSrc()
    {
        //src with db
        $src = $this->getMockSingleClass('GearJson\Src\Src', array('getName', 'getType', 'getDb'));
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
}
