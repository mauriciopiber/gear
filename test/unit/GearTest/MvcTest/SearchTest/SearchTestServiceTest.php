<?php
namespace GearTest\MvcTest\FormTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\SearchTest\SearchDataTrait;

/**
 * @group src-form
 * @group Search
 * @group db-search
 */
class SearchTestServiceTest extends AbstractTestCase
{
    use SearchDataTrait;

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

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/search-test';

        $this->form = new \Gear\Mvc\Search\SearchTestService();
        $this->form->setStringService($this->string);
        $this->form->setFileCreator($this->fileCreator);
        $this->form->setModule($this->module->reveal());

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');

        $this->form->setSchemaService($this->schema->reveal());


        $this->trait = $this->prophesize('Gear\Mvc\TraitTestService');

        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');

        $this->form->setFactoryTestService($this->factory->reveal());

        $this->form->setTraitTestService($this->trait->reveal());

        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setStringService($this->string);
        $serviceManager->setModule($this->module->reveal());

        $this->form->setServiceManager($serviceManager);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->form->setTableService($this->table->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->form->setColumnService($this->column->reveal());

        $this->codeTest = new \Gear\Creator\CodeTest();

        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setFileCreator($this->fileCreator);

        $this->srcDependency = new \Gear\Creator\SrcDependency;
        $this->srcDependency->setStringService($this->string);
        $this->srcDependency->setModule($this->module->reveal());

        $this->codeTest->setSrcDependency($this->srcDependency);
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());
        $this->codeTest->setStringService($this->string);

        $this->form->setCodeTest($this->codeTest);

    }

    /**
     * @dataProvider tables
     * @group n99
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName, $service, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->module->getTestSearchFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $src = new \GearJson\Src\Src(
            [
                'name' => $table.'SearchForm',
                'type' => 'SearchForm',
                'namespace' => $namespace,
                'service' => $service
            ***REMOVED***
        );

        $this->schema->getSrcByDb($db, 'SearchForm')->willReturn($src);

        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);

        $this->column->getColumns($db, true)->willReturn($columns);

        $file = $this->form->introspectFromTable($db);

        $this->assertEquals(file_get_contents($this->template.'/'.$template.'.phtml'), file_get_contents($file));
    }
}
