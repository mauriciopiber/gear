<?php
namespace GearTest\MvcTest\RepositoryTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;
use GearTest\MvcTest\RepositoryTest\RepositoryDataTrait;
use GearTest\UtilTestTrait;
use Gear\Schema\Src\Src;
use Gear\Column\ColumnManager;

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


        $this->templates =  (new \Gear\Module())->getLocation().'/../test/template/module/mvc/repository-test';

        $this->repository = new \Gear\Mvc\Repository\RepositoryTestService();

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->repository->setModule($this->module->reveal());

        $this->string = new \Gear\Util\String\StringService();
        $this->repository->setStringService($this->string);

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));
        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);
        $this->repository->setFileCreator($this->fileCreator);

        $this->serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $this->serviceManager->setModule($this->module->reveal());
        $this->serviceManager->setStringService($this->string);
        $this->repository->setServiceManager($this->serviceManager);

        $this->traitTest = $this->prophesize('Gear\Mvc\TraitTestService');
        $this->repository->setTraitTestService($this->traitTest->reveal());

        $this->codeTest = new \Gear\Creator\CodeTest;
        $this->codeTest->setStringService($this->string);
        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setDirService(new \Gear\Util\Dir\DirService());
        $this->repository->setCodeTest($this->codeTest);

        $this->factoryTest = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->repository->setFactoryTestService($this->factoryTest->reveal());

        //$this->column = $this->prophesize('Gear\Column\ColumnService');
        //$this->repository->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->repository->setTableService($this->table->reveal());

        $this->schemaService = $this->prophesize('Gear\Schema\Schema\SchemaService');
        $this->repository->setSchemaService($this->schemaService->reveal());
    }

    /**
     * @group fix-dependency2
     */
    public function testCreateRepositoryTestWithSpecialDependency()
    {
        $data = new Src(require __DIR__.'/../_gearfiles/repository-with-special-dependency.php');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

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

        $this->db = new \Gear\Schema\Db\Db(['table' => sprintf('%s', $table)***REMOVED***);

        $repository = new \Gear\Schema\Src\Src(
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

        $this->traitTest->createTraitTest($repository)->shouldBeCalled();

        $this->factoryTest->createFactoryTest($repository)->shouldBeCalled();

        $file = $this->repository->createRepositoryTest($this->db);

        $expected = $this->templates.'/db/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$repository->getName().'Test.php', $file);
    }
}
