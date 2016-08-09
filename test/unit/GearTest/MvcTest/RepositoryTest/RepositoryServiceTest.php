<?php
namespace GearTest\MvcTest\RepositoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

/**
 * @group src-mvc
 */
class RepositoryServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use \GearTest\ScopeTrait;

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

        $this->dirService = new \GearBase\Util\Dir\DirService();

        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/repository';

        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->code->setSrcDependency($this->srcDependency);
        $this->code->setDirService($this->dirService);




        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->traitService = $this->prophesize('Gear\Mvc\TraitService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);
    }

    public function src()
    {
        $srcType = 'Repository';

        return $this->getScope($srcType);
    }

    /**
     * @group src-mvc
     * @group src-mvc-repository
     *
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        } else {
            $this->module->map('Repository')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $this->repository = new \Gear\Mvc\Repository\RepositoryService();

        if ($data->getService() == 'factories' && $data->getAbstract() == false) {
            $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');

            if (!empty($data->getNamespace())) {
               $this->factory->createFactory(
                   $data,
                   vfsStream::url('module/src/MyModule').'/'.str_replace('\\', '/', $data->getNamespace())
               )->shouldBeCalled();
            } else {
                $this->factory->createFactory($data, vfsStream::url('module'))->shouldBeCalled();
            }


            $this->repository->setFactoryService($this->factory->reveal());
        }


        $this->repository->setFileCreator($this->fileCreator);
        $this->repository->setStringService($this->string);
        $this->repository->setModule($this->module->reveal());
        $this->repository->setCode($this->code);


        $this->repository->setTraitService($this->traitService->reveal());

        $srcDependency = $this->prophesize('Gear\Creator\SrcDependency');
        $this->repository->setSrcDependency($srcDependency->reveal());


        $this->repositoryTest = $this->prophesize('Gear\Mvc\Repository\RepositoryTestService');

        $this->repository->setRepositoryTestService($this->repositoryTest->reveal());

        $file = $this->repository->create($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );


        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        //$this->module->getRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
    }

    public function tables()
    {
        /**
        $db = new Db(['table' => 'Table'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'service' => new Service(['name' => 'Table', 'object' => '%s\Service\Table'***REMOVED***),
            'db' => $db
        ***REMOVED***);


        return [
            [$action, $this->getAllPossibleColumns(), '', true, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsNotNull(), '.not.null', false, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsUnique(), '.unique', true, true***REMOVED***,
            [$action, $this->getAllPossibleColumnsUniqueNotNull(), '.unique.not.null', false, true***REMOVED***,
        ***REMOVED***;
        */
        return [
            [$this->getAllPossibleColumns(), '', true***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     * @group db-docs
     * @group db-repository
     */
    public function testInstrospectTable($columns, $template, $nullable)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => 'Table'***REMOVED***);

        $this->repository = new \Gear\Mvc\Repository\RepositoryService();
        $this->repository->setFileCreator($this->fileCreator);
        $this->repository->setStringService($this->string);
        $this->repository->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(true);

        $this->repository->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getReferencedTableValidColumnName('Table')->willReturn('idMyController');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->repository->setTableService($this->table->reveal());

        $service = new \GearJson\Src\Src(['name' => 'TableRepository', 'type' => 'Repository'***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Repository')->willReturn($service);

        $this->repository->setCode($this->code);

        $this->repository->setSchemaService($schemaService->reveal());

        $this->repository->setTraitService($this->traitService->reveal());

        $srcDependency = $this->prophesize('Gear\Creator\SrcDependency');
        $this->repository->setSrcDependency($srcDependency->reveal());
        //$this->repository->setFactoryService

        $this->repositoryTest = $this->prophesize('Gear\Mvc\Repository\RepositoryTestService');

        $this->repository->setRepositoryTestService($this->repositoryTest->reveal());

        $mapping = new \Gear\Mvc\Repository\MappingService();
        $mapping->setStringService($this->string);
        $mapping->setColumnService($this->column->reveal());
        $mapping->setTableService($this->table->reveal());

        $this->table->getReferencedTableValidColumnName('foreign_key_column')->willReturn('idForeignKeyColumn');
        //$columns[9***REMOVED***->getConstraint()->getReferencedTableName()->willReturn('myTable');

        $this->table->getConstraintForeignKeyFromColumn($this->db->getTable(), $columns[9***REMOVED***->getColumn())->willReturn($columns[9***REMOVED***->getConstraint());

        $this->repository->setMappingService($mapping);

        $file = $this->repository->introspectFromTable($this->db);

        $expected = $this->templates.'/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
