<?php
namespace GearTest\MvcTest\SearchTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\SearchTest\SearchDataTrait;
use GearTest\UtilTestTrait;
use Gear\Column\ColumnManager;

/**
 * @group src-form
 * @group Search
 * @group db-search
 */
class SearchTestServiceTest extends TestCase
{
    use UtilTestTrait;
    use SearchDataTrait;

    public function setUp()
    {
        parent::setUp();


        $this->vfsLocation = 'module/test/unit/MyModuleTest/FormTest/SearchTest';
        $this->createVirtualDir($this->vfsLocation);

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');


        $this->string = new \Gear\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));
        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/search-test';

        $this->form = new \Gear\Mvc\Search\SearchTestService();
        $this->form->setStringService($this->string);
        $this->form->setFileCreator($this->fileCreator);
        $this->form->setModule($this->module->reveal());

        $this->schema = $this->prophesize('Gear\Schema\Schema\SchemaService');

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

        $this->codeTest = new \Gear\Creator\CodeTest();

        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setFileCreator($this->fileCreator);

        $this->codeTest->setDirService(new \Gear\Util\Dir\DirService());
        $this->codeTest->setStringService($this->string);

        $this->form->setCodeTest($this->codeTest);

    }

    /**
     * @dataProvider tables
     * @group db-search2
     * @group n99
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName, $service, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if ($namespace !== null) {

            $location = 'module/test/unit/MyModuleTest';

            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();

            $data = explode('\\', $namespace);

            foreach ($data as $item) {
                $location .= '/'.$item.'Test';
            }

        } else {

            $location = $this->vfsLocation;
            $this->module->map('SearchFormTest')->willReturn(vfsStream::url($location))->shouldBeCalled();
        }

        $db = new \Gear\Schema\Db\Db(['table' => $table***REMOVED***);

        $src = new \Gear\Schema\Src\Src(
            [
                'name' => $table.'SearchForm',
                'type' => 'SearchForm',
                'namespace' => $namespace,
                'service' => $service
            ***REMOVED***
        );

        $this->schema->getSrcByDb($db, 'SearchForm')->willReturn($src);

        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);

        $db->setColumnManager(new ColumnManager($columns));

        $this->trait->createTraitTest($src)->shouldBeCalled();
        $this->factory->createFactoryTest($src)->shouldBeCalled();

        $file = $this->form->createSearchFormTest($db);

        $this->assertEquals(file_get_contents($this->template.'/'.$template.'.phtml'), file_get_contents($file));

        $this->assertStringEndsWith($location.'/'.$src->getName().'Test.php', $file);
    }
}
