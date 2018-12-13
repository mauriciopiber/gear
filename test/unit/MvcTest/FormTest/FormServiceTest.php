<?php
namespace GearTest\MvcTest\FormTest;

use PHPUnit\Framework\TestCase;
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

    public function setUp()
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Form';
        $this->createVirtualDir($this->vfsLocation);

        //module
        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        //string
        $this->string = new \Gear\Util\String\StringService();

        //file-render
        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));
        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        //template
        $this->templates =  (new \Gear\Module())->getLocation().'/../test/template/module/mvc/form';


        //code
        $this->code = new \Gear\Creator\Code();
        $this->code->setModule($this->module->reveal());
        $this->code->setStringService($this->string);
        $this->code->setDirService(new \Gear\Util\Dir\DirService());
        $constructorParams = new ConstructorParams($this->string);
        $this->code->setConstructorParams($constructorParams);

        //array
        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        //injector
        $this->injector = new \Gear\Creator\Injector\Injector($this->arrayService);

        $this->form = new \Gear\Mvc\Form\FormService();

        $this->form->setFileCreator($this->fileCreator);
        $this->form->setStringService($this->string);
        $this->form->setModule($this->module->reveal());
        $this->form->setCode($this->code);


        //form-test
        $this->formTest = $this->prophesize('Gear\Mvc\Form\FormTestService');
        $this->form->setFormTestService($this->formTest->reveal());

        //trait
        $this->trait = $this->prophesize('Gear\Mvc\TraitService');
        $this->form->setTraitService($this->trait->reveal());

        //factory
        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->form->setFactoryService($this->factory->reveal());

        //interface
        $this->interface = $this->prophesize('Gear\Mvc\InterfaceService');
        $this->form->setInterfaceService($this->interface->reveal());
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

        if (!empty($data->getNamespace())) {

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        } else {
            $this->module->map('Form')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        if ($data->getService() == 'factories' && $data->getAbstract() == false) {

            if (!empty($data->getNamespace())) {
               $this->factory->createFactory(
                   $data,
                   vfsStream::url('module/src/MyModule').'/'.str_replace('\\', '/', $data->getNamespace())
               )->shouldBeCalled();
            } else {
                $this->factory->createFactory($data, vfsStream::url('module'))->shouldBeCalled();
            }
        }

        $this->formTest->createFormTest($data)->shouldBeCalled();

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

        if ($namespace === null) {
            $location = $this->vfsLocation;
            $this->module->map('Form')->willReturn(vfsStream::url($location))->shouldBeCalled();
        } else {
            $location = 'module/src/MyModule';
            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();
            $location .= '/'.str_replace('\\', '/', $namespace);
        }



        $this->db = new \Gear\Schema\Db\Db(['table' => $table***REMOVED***);


        $columnManager = new ColumnManager($columns);
        $this->db->setColumnManager($columnManager);


        //$this->column = $this->prophesize('Gear\Column\ColumnService');
        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        //$this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->hasUniqueConstraint($table)->willReturn(false);
        //$this->table->getReferencedTableValidColumnName('MyService')->willReturn(sprintf('id%s', $table));
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->form->setTableService($this->table->reveal());

        $form = new \Gear\Schema\Src\Src(
            [
                'name' => sprintf('%sForm', $table),
                'type' => 'Form',
                'namespace' => $namespace,
                'service' => $service
            ***REMOVED***
        );

        $schemaService = $this->prophesize('Gear\Schema\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Form')->willReturn($form);

        $this->form->setCode($this->code);

        $this->form->setSchemaService($schemaService->reveal());



        $this->trait->createTrait($form)->shouldBeCalled();
        $this->factory->createFactory($form)->shouldBeCalled();

        $this->formTest->createFormTest($this->db)->shouldBeCalled();

        $file = $this->form->createForm($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$form->getName().'.php', $file);
    }
}
