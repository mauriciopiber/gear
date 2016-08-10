<?php
namespace GearTest\MvcTest\RepositoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\ScopeTrait;

/**
 * @group repository-1
 */
class RepositoryTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use ScopeTrait;


    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/repository-test';

        $this->repository = new \Gear\Mvc\Repository\RepositoryTestService();

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->repository->setModule($this->module->reveal());

        $this->string = new \GearBase\Util\String\StringService();
        $this->repository->setStringService($this->string);

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);
        $this->repository->setFileCreator($this->fileCreator);

        $this->serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $this->serviceManager->setModule($this->module->reveal());
        $this->serviceManager->setStringService($this->string);
        $this->repository->setServiceManager($this->serviceManager);

        $this->traitTestService = $this->prophesize('Gear\Mvc\TraitTestService');
        $this->repository->setTraitTestService($this->traitTestService->reveal());

        $this->codeTest = new \Gear\Creator\CodeTest;
        $this->codeTest->setStringService($this->string);
        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());
        $this->repository->setCodeTest($this->codeTest);

        $this->factoryTest = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->repository->setFactoryTestService($this->factoryTest->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->repository->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->repository->setTableService($this->table->reveal());

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->repository->setSchemaService($this->schemaService->reveal());

        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->repository->setSrcDependency($this->srcDependency);
    }


    public function src()
    {
        return $this->getScope('Repository');
    }

    /**
     * @group src-mvc
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

        $file = $this->repository->createFromSrc($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), '', true, 'table', null***REMOVED***,
            [$this->getAllPossibleColumns(), '-namespace', true, 'table', 'Custom\CustomNamespace'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     * @group RepositoryMvc
     * @group fixit
     */
    public function testInstrospectTable($columns, $template, $nullable, $tableName, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $this->db = new \GearJson\Db\Db(['table' => sprintf('%s', $table)***REMOVED***);

        $repository = new \GearJson\Src\Src(
            [
                'name' => sprintf('%sRepository', $table),
                'type' => 'Repository',
                'namespace' => $namespace
            ***REMOVED***
        );

        if (!empty($repository->getNamespace())) {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));
        } else {
            $this->module->map('RepositoryTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(false);
        $this->column->renderColumnPart('staticTest')->willReturn('');

        $this->table->verifyTableAssociation($this->db->getTable())->willReturn(false);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);
        $this->table->getPrimaryKeyColumnName($this->db->getTable())->willReturn('idMyController')->shouldBeCalled();

        $this->schemaService->getSrcByDb($this->db, 'Repository')->willReturn($repository);

        $file = $this->repository->introspectFromTable($this->db);

        $expected = $this->templates.'/db/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
