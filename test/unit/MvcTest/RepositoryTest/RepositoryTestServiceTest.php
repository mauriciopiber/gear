<?php
namespace GearTest\MvcTest\RepositoryTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Schema\Db\Db;
use Gear\Mvc\Repository\RepositoryTestService;
use Gear\Module;
use Gear\Table\TableService\TableService;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;
use GearTest\MvcTest\RepositoryTest\RepositoryDataTrait;
use GearTest\UtilTestTrait;
use Gear\Schema\Src\Src;
use Gear\Column\ColumnManager;
use Gear\Schema\Schema\SchemaService;

/**
 * @group src-mvc
 * @group db-repository
 */
class RepositoryTestServiceTest extends TestCase
{
    use UtilTestTrait;
    use ScopeTrait;
    use RepositoryDataTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->vfsLocation = 'module/test/unit/MyModuleTest/RepositoryTest';
        $this->createVirtualDir($this->vfsLocation);

        $this->templates =  (new Module())->getLocation().'/../test/template/module/mvc/repository-test';

        $this->module = $this->prophesize(ModuleStructure::class);

        $this->string = new StringService();

        $this->fileCreator = $this->createFileCreator();

        $this->table = $this->prophesize(TableService::class);

        $this->schemaService = $this->prophesize(SchemaService::class);


        $this->repository = new RepositoryTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->createCodeTest(),
            $this->table->reveal(),
            $this->createInjector()
        );
        $this->repository->setSchemaService($this->schemaService->reveal());
    }

    /**
     * @group fix-dependency2
     */
    public function testCreateRepositoryTestWithSpecialDependency()
    {
        $data = new Src(require __DIR__.'/../_gearfiles/repository-with-special-dependency.php');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));

        $file = $this->repository->createRepositoryTest($data);

        $expected = $this->templates.'/src/repository-with-special-dependency.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }


    public function src()
    {
        return $this->getScope('Repository');
    }

    /**
     * @group src-mvc-repository-test
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));
        } else {
            $this->module->map('RepositoryTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $file = $this->repository->createRepositoryTest($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider tables
     * @group inter
     */
    public function testInstrospectTable($columns, $template, $nullable, $tableName, $namespace, $service)
    {
        $table = $this->string->str('class', $tableName);

        $this->db = new Db(['table' => sprintf('%s', $table)***REMOVED***);

        $repository = new Src(
            [
                'name' => sprintf('%sRepository', $table),
                'type' => 'Repository',
                'namespace' => $namespace,
                'service' => $service,
                'dependency' => [
                    'doctrine.entitymanager.orm_default' => 'Doctrine\ORM\EntityManager',
                    'GearBase\Repository\QueryBuilder'
                ***REMOVED***
            ***REMOVED***
        );

        if ($namespace !== null) {

            $location = 'module/test/unit/MyModuleTest';

            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();

            $data = explode('\\', $namespace);

            foreach ($data as $item) {
                $location .= '/'.$item.'Test';
            }

        } else {

            $location = $this->vfsLocation;
            $this->module->map('RepositoryTest')->willReturn(vfsStream::url($location))->shouldBeCalled();
        }

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->db->setColumnManager(new ColumnManager($columns));

        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        //$this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(false);

        $this->table->verifyTableAssociation($this->db->getTable())->willReturn(false);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);
        $this->table->getPrimaryKeyColumnName($this->db->getTable())->willReturn('idMyController')->shouldBeCalled();

        $this->schemaService->getSrcByDb($this->db, 'Repository')->willReturn($repository);

        $file = $this->repository->createRepositoryTest($this->db);

        $expected = $this->templates.'/db/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$repository->getName().'Test.php', $file);
    }
}
