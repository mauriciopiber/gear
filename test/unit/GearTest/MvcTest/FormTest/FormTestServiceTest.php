<?php
namespace GearTest\MvcTest\FormTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;
use GearTest\MvcTest\FormTest\FormDataTrait;
use GearTest\UtilTestTrait;

/**
 * @group db-form
 */
class FormTestServiceTest extends AbstractTestCase
{
    use UtilTestTrait;
    use FormDataTrait;
    use ScopeTrait;

    public function setUp()
    {
        parent::setUp();

        $this->vfsLocation = 'module/test/unit/MyModuleTest/FilterTest';
        $this->createVirtualDir($this->vfsLocation);

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/form-test';

        $this->form = new \Gear\Mvc\Form\FormTestService();
        $this->form->setStringService($this->string);
        $this->form->setFileCreator($this->fileCreator);
        $this->form->setModule($this->module->reveal());

        $this->codeTest = new \Gear\Creator\CodeTest();

        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setFileCreator($this->fileCreator);
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());
        $this->codeTest->setStringService($this->string);

        $this->form->setCodeTest($this->codeTest);

        $this->traitTest = $this->prophesize('Gear\Mvc\TraitTestService');
        $this->form->setTraitTestService($this->traitTest->reveal());

        $this->factoryTest = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->form->setFactoryTestService($this->factoryTest->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->form->setTableService($this->table->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->form->setColumnService($this->column->reveal());

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->form->setSchemaService($this->schema->reveal());

        $this->serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $this->serviceManager->setStringService($this->string);
        $this->serviceManager->setModule($this->module->reveal());

        $this->form->setServiceManager($this->serviceManager);

    }

    public function src()
    {
        $srcType = 'Form';

        return $this->getScopeForm($srcType);
    }

    /**
     * @group src-mvc
     * @group src-mvc-form-test
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestServiceFolder()->willReturn(vfsStream::url('module'));

        if (!empty($data->getNamespace())) {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));
        } else {
            $this->module->map('FormTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->module->reveal());
        $serviceManager->setStringService($this->string);

        $this->form->setServiceManager($serviceManager);

        $this->form->setTraitTestService($this->traitTest->reveal());

        $file = $this->form->createFromSrc($data);

        $expected = $this->template.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider tables
     * @group n99
     * @group db-form2
     */
    public function testCreateDb($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName, $service, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->module->getModuleName()->willReturn('MyModule');

        if ($namespace !== null) {

            $location = 'module/test/unit/MyModuleTest';

            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();

            $data = explode('\\', $namespace);

            foreach ($data as $item) {
                $location .= '/'.$item.'Test';
            }

        } else {

            $location = $this->vfsLocation;
            $this->module->map('FormTest')->willReturn(vfsStream::url($location))->shouldBeCalled();
        }

        $src = new \GearJson\Src\Src(
            [
                'name' => $table.'Form',
                'type' => 'Form',
                'namespace' => $namespace,
                'service' => $service
            ***REMOVED***
        );

        $this->schema->getSrcByDb($db, 'Form')->willReturn($src);

        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);

        $this->column->getColumns($db)->willReturn($columns);

        $this->traitTest->createTraitTest($src, vfsStream::url($location))->shouldBeCalled();
        $this->factoryTest->createFactoryTest($src, vfsStream::url($location))->shouldBeCalled();

        $file = $this->form->introspectFromTable($db);

        $this->assertEquals(file_get_contents($this->template.'/db/'.$template.'.phtml'), file_get_contents($file));

        $this->assertStringEndsWith($location.'/'.$src->getName().'Test.php', $file);
    }
}
