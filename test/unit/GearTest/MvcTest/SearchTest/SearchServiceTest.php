<?php
namespace GearTest\MvcTest\SearchTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;
use GearTest\MvcTest\SearchTest\SearchDataTrait;
use GearTest\UtilTestTrait;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;

/**
 * @group db-namespace-factory
 * @group db-search
 */
class SearchServiceTest extends AbstractTestCase
{
    use UtilTestTrait;
    use SearchDataTrait;
    use ScopeTrait;

    public function setUp()
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Form/Search';
        $this->createVirtualDir($this->vfsLocation);

        //module
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        //string
        $this->string = new \GearBase\Util\String\StringService();

        //file-render
        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        //template
        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/search';

        //code
        $this->code = new \Gear\Creator\Code();
        $this->code->setModule($this->module->reveal());
        $this->code->setStringService($this->string);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());
        $constructorParams = new ConstructorParams($this->string);
        $this->code->setConstructorParams($constructorParams);

        //array
        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        //injector
        $this->injector = new \Gear\Creator\Injector\Injector($this->arrayService);

        $this->search = new \Gear\Mvc\Search\SearchService();

        $this->search->setFileCreator($this->fileCreator);
        $this->search->setStringService($this->string);
        $this->search->setModule($this->module->reveal());
        $this->search->setCode($this->code);

        //search-test
        $this->searchTest = $this->prophesize('Gear\Mvc\Search\SearchTestService');
        $this->search->setSearchTestService($this->searchTest->reveal());

        //trait
        $this->trait = $this->prophesize('Gear\Mvc\TraitService');
        $this->search->setTraitService($this->trait->reveal());

        //factory
        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->search->setFactoryService($this->factory->reveal());

        //interface
        $this->interface = $this->prophesize('Gear\Mvc\InterfaceService');
        $this->search->setInterfaceService($this->interface->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->search->setTableService($this->table->reveal());

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->search->setSchemaService($this->schemaService->reveal());


        $this->search->setCode($this->code);



        $this->search->setTraitService($this->trait->reveal());

        $this->searchTest = $this->prophesize('Gear\Mvc\Search\SearchTestService');

        $this->search->setSearchTestService($this->searchTest->reveal());

    }

    /**
     * @dataProvider tables
     * @group db-docs
     * @group db-search1
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName, $service, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if ($namespace === null) {
            $location = $this->vfsLocation;
            $this->module->map('SearchForm')->willReturn(vfsStream::url($location))->shouldBeCalled();
        } else {
            $location = 'module/src/MyModule';
            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();
            $location .= '/'.str_replace('\\', '/', $namespace);
        }

        $this->db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->table->hasUniqueConstraint($table)->willReturn(false);
        //$this->table->getReferencedTableValidColumnName('MyService')->willReturn(sprintf('id%s', $table));
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $search = new \GearJson\Src\Src(
            [
                'name' => sprintf('%sSearch', $table),
                'type' => 'SearchForm',
                'service' => $service,
                'namespace' => $namespace
            ***REMOVED***
        );

        $this->schemaService->getSrcByDb($this->db, 'SearchForm')->willReturn($search);

        $this->searchTest->createSearchFormTest($this->db)->shouldBeCalled();

        $this->db->setColumnManager(new ColumnManager($columns));

        $this->trait->createTrait($search)->shouldBeCalled();
        $this->factory->createFactory($search)->shouldBeCalled();

        $file = $this->search->createSearchForm($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$search->getName().'Form.php', $file);
    }
}
