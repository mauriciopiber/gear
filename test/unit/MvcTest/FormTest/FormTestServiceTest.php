<?php
namespace GearTest\MvcTest\FormTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;
use GearTest\MvcTest\FormTest\FormDataTrait;
use GearTest\UtilTestTrait;
use Gear\Column\ColumnManager;
use Gear\Schema\Schema\SchemaService;

/**
 * @group db-form
 */
class FormTestServiceTest extends TestCase
{
    use UtilTestTrait;
    use FormDataTrait;
    use ScopeTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->vfsLocation = 'module/test/unit/MyModuleTest/FilterTest';
        $this->createVirtualDir($this->vfsLocation);

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->string = new \Gear\Util\String\StringService();

        $this->fileCreator    = $this->createFileCreator();

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/form-test';

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');

        $this->form = new \Gear\Mvc\Form\FormTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->createCodeTest(),
            $this->table->reveal(),
            $this->createInjector()
        );

        $this->schema = $this->prophesize(SchemaService::class);
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
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestServiceFolder()->willReturn(vfsStream::url('module'));

        if (!empty($data->getNamespace())) {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));
        } else {
            $this->module->map('FormTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $file = $this->form->createFormTest($data);

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
     * @group inter2
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName, $service, $namespace)
    {
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $table = $this->string->str('class', $tableName);

        $db = new \Gear\Schema\Db\Db(['table' => $table***REMOVED***);

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

        $src = new \Gear\Schema\Src\Src(
            [
                'name' => $table.'Form',
                'type' => 'Form',
                'namespace' => $namespace,
                'service' => $service
            ***REMOVED***
        );

        $this->form->setSchemaService($this->schema->reveal());
        $this->schema->getSrcByDb($db, 'Form')->willReturn($src);

        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);

        $columnManager = new ColumnManager($columns);
        $db->setColumnManager($columnManager);

        $file = $this->form->createFormTest($db);

        $this->assertEquals(file_get_contents($this->template.'/db/'.$template.'.phtml'), file_get_contents($file));

        $this->assertStringEndsWith($location.'/'.$src->getName().'Test.php', $file);
    }
}
