<?php
namespace GearTest\MvcTest\FilterTest;

use PHPUnit\Framework\TestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ScopeTrait;
use GearTest\MvcTest\FilterTest\FilterDataTrait;
use GearTest\UtilTestTrait;
use Gear\Column\ColumnManager;

/**
 * @group db-filter
 */
class FilterTestServiceTest extends TestCase
{
    use UtilTestTrait;
    use FilterDataTrait;
    use ScopeTrait;

    public function setUp() : void
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->vfsLocation = 'module/test/unit/MyModuleTest/FilterTest';
        $this->createVirtualDir($this->vfsLocation);

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');


        $this->string = new \Gear\Util\String\StringService();


        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/filter-test';

        $this->traitTestService = $this->prophesize('Gear\Mvc\TraitTestService');

        $this->codeTest = new \Gear\Creator\CodeTest;

        $this->fileCreator = $this->createFileCreator();

        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setFileCreator($this->fileCreator);
        $this->codeTest->setDirService(new \Gear\Util\Dir\DirService());
        $this->codeTest->setStringService($this->string);



        $this->filter = new \Gear\Mvc\Filter\FilterTestService();
        $this->filter->setStringService($this->string);
        $this->filter->setFileCreator($this->fileCreator);
        $this->filter->setModule($this->module->reveal());

        $this->filter->setCodeTest($this->codeTest);

        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->filter->setFactoryTestService($this->factory->reveal());
    }

    /**
     * @dataProvider tables
     * @group inter2
     */
    public function testInstrospectTable(
        $columns,
        $template,
        $unique,
        $nullable,
        $hasColumnImage,
        $hasTableImage,
        $tableName,
        $service,
        $namespace
    ) {
        $table = $this->string->str('class', $tableName);

        $db = new \Gear\Schema\Db\Db(['table' => sprintf('%sTable', $table)***REMOVED***);

        $this->module->getTestFilterFolder()->willReturn(vfsStream::url('module'));

        if ($namespace !== null) {

            $location = 'module/test/unit/MyModuleTest';

            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();

            $data = explode('\\', $namespace);

            foreach ($data as $item) {
                $location .= '/'.$item.'Test';
            }

        } else {

            $location = $this->vfsLocation;
            $this->module->map('FilterTest')->willReturn(vfsStream::url($location))->shouldBeCalled();
        }

        $this->module->getModuleName()->willReturn('MyModule');

        $src = new \Gear\Schema\Src\Src(
            [
                'name' => sprintf('%sFilter', $table),
                'type' => 'Filter',
                'service' => $service,
                'namespace' => $namespace
            ***REMOVED***
        );

        $this->schema = $this->prophesize('Gear\Schema\Schema\SchemaService');
        $this->schema->getSrcByDb($db, 'Filter')->willReturn($src);

        $this->filter->setSchemaService($this->schema->reveal());

        $columnManager = new ColumnManager($columns);
        $db->setColumnManager($columnManager);

        $this->factory->createFactoryTest($src)->shouldBeCalled();

        $file = $this->filter->createFilterTest($db);

        $this->assertEquals(file_get_contents($this->template.'/db/'.$template.'.phtml'), file_get_contents($file));

        $this->assertStringEndsWith($location.'/'.$src->getName().'Test.php', $file);
    }

    public function src()
    {
        $srcType = 'Filter';

        return $this->getScopeForm($srcType);
    }


    /**
     * @group src-mvc
     * @group src-mvc-filter-test
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestServiceFolder()->willReturn(vfsStream::url('module'));

        if (!empty($data->getNamespace())) {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));
        } else {
            $this->module->map('FilterTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->module->reveal());
        $serviceManager->setStringService($this->string);

        $this->filter->setServiceManager($serviceManager);

        $this->filter->setTraitTestService($this->traitTestService->reveal());

        $file = $this->filter->createFilterTest($data);

        $expected = $this->template.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
