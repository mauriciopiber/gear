<?php
namespace GearTest\MvcTest\FormTest;

use PHPUnit\Framework\TestCase;
use Gear\Schema\Src\Src;
use Gear\Schema\Db\Db;
use Gear\Mvc\Form\FormService;
use Gear\Module;
use Gear\Table\TableService\TableService;
use Gear\Schema\Schema\SchemaService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Column\ColumnService;
use org\bovigo\vfs\vfsStream;
use GearTest\SingleDbTableTrait;
use GearTest\ScopeTrait;
use GearTest\MvcTest\FormTest\FormDataTrait;
use GearTest\UtilTestTrait;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;

/**
 * @group db-form
 */
class FormServiceTest extends TestCase
{
    use UtilTestTrait;
    use FormDataTrait;
    use ScopeTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Form';
        $this->createVirtualDir($this->vfsLocation);

        //module
        $this->module = $this->prophesize(ModuleStructure::class);

        //template
        $this->templates =  (new Module())->getLocation().'/../test/template/module/mvc/form';

        $this->form = new FormService(
            $this->module->reveal(),
            $this->createFileCreator(),
            $this->createString(),
            $this->createCode(),
            $this->createDirService(),
            //$this->factoryService->reveal(),
            $this->createTableService(),
            $this->createArrayService(),
            $this->createInjector()
        );
    }


    public function src()
    {
        $srcType = 'Form';

        return $this->getScopeForm($srcType);
    }


    /**
     * @group src-mvc
     * @group src-mvc-form
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        } else {
            $this->module->map('Form')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }


        $file = $this->form->createForm($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    /**
     * @dataProvider tables
     * @group db-docs
     * @group db-form1
     * @group inter2
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName, $service, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        if ($namespace === null) {
            $location = $this->vfsLocation;
            $this->module->map('Form')->willReturn(vfsStream::url($location))->shouldBeCalled();
        } else {
            $location = 'module/src/MyModule';
            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();
            $location .= '/'.str_replace('\\', '/', $namespace);
        }



        $this->db = new Db(['table' => $table***REMOVED***);


        $columnManager = new ColumnManager($columns);
        $this->db->setColumnManager($columnManager);


        //$this->column = $this->prophesize(ColumnService::class);
        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        //$this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);

        $this->table = $this->prophesize(TableService::class);
        $this->table->hasUniqueConstraint($table)->willReturn(false);
        //$this->table->getReferencedTableValidColumnName('MyService')->willReturn(sprintf('id%s', $table));
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->form->setTableService($this->table->reveal());

        $form = new Src(
            [
                'name' => sprintf('%sForm', $table),
                'type' => 'Form',
                'namespace' => $namespace,
                'service' => $service
            ***REMOVED***
        );

        $schemaService = $this->prophesize(SchemaService::class);
        $schemaService->getSrcByDb($this->db, 'Form')->willReturn($form);

        $this->form->setCode($this->code);

        $this->form->setSchemaService($schemaService->reveal());


        $file = $this->form->createForm($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$form->getName().'.php', $file);
    }
}
