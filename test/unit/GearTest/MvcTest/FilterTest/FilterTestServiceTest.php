<?php
namespace GearTest\MvcTest\FilterTest;

use GearBaseTest\AbstractTestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;

/**
 * @group working
 */
class FilterTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use ScopeTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');


        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/filter-test';

        $this->factoryTestService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->traitTestService = $this->prophesize('Gear\Mvc\TraitTestService');

        $this->codeTest = new \Gear\Creator\CodeTest;

        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setFileCreator($this->fileCreator);

        $this->srcDependency = new \Gear\Creator\SrcDependency;
        $this->srcDependency->setStringService($this->string);
        $this->srcDependency->setModule($this->module->reveal());

        $this->codeTest->setSrcDependency($this->srcDependency);
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());
        $this->codeTest->setStringService($this->string);



        $this->filter = new \Gear\Mvc\Filter\FilterTestService();
        $this->filter->setStringService($this->string);
        $this->filter->setFileCreator($this->fileCreator);
        $this->filter->setModule($this->module->reveal());

        $this->filter->setCodeTest($this->codeTest);
    }


    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', true, false, 'table', 'invokables', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-factory', true, false, 'table', 'factories', null***REMOVED***,
            [$this->getAllPossibleColumns(), 'all-columns-db-namespace', true, false, 'table', 'invokables', 'Custom\CustomNamespace'***REMOVED***,
            [$this->getAllPossibleColumnsNotNull(), 'all-columns-db-not-null', false, false, 'table_not_null', 'invokables', null***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), 'all-columns-db-unique', false, true, 'table_unique'***REMOVED***,
            [$this->getAllPossibleColumnsUniqueNotNull(), 'all-columns-db-unique-not-null', false, true, 'table_unique_not_null', 'invokables', null***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     */
    public function testCreateDb($columns, $expect, $nullable, $unique, $tableName, $service, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $db = new \GearJson\Db\Db(['table' => sprintf('%sTable', $table)***REMOVED***);

        $this->module->getTestFilterFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $src = new \GearJson\Src\Src(
            [
                'name' => sprintf('%sFilter', $table),
                'type' => 'Filter',
                'service' => $service,
                'namespace' => $namespace
            ***REMOVED***
        );

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schema->getSrcByDb($db, 'Filter')->willReturn($src);

        $this->filter->setSchemaService($this->schema->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($columns);

        $this->filter->setColumnService($this->column->reveal());


        $file = $this->filter->introspectFromTable($db);

        $this->assertEquals(file_get_contents($this->template.'/db/'.$expect.'.phtml'), file_get_contents($file));
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

        if ($data->getService() == 'factories') {
            $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
            $this->filter->setFactoryTestService($this->factory->reveal());
        }

        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->module->reveal());
        $serviceManager->setStringService($this->string);

        $this->filter->setServiceManager($serviceManager);

        $this->filter->setTraitTestService($this->traitTestService->reveal());

        $srcDependency = new \Gear\Creator\SrcDependency();
        $srcDependency->setModule($this->module->reveal());
        $this->filter->setSrcDependency($srcDependency);

        $file = $this->filter->create($data);

        $expected = $this->template.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
