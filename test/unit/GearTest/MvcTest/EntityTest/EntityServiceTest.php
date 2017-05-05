<?php
namespace GearTest\MvcTest\EntityTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Mvc\Entity\EntityService;
use org\bovigo\vfs\vfsStream;
use GearJson\Src\Src;

/**
 * @group src-entity
 * @group Entity
 */
class EntityServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->doctrineService = $this->prophesize('Gear\Mvc\Entity\DoctrineService');
        $this->scriptService = $this->prophesize('Gear\Script\ScriptService');
        $this->entityTestService = $this->prophesize('Gear\Mvc\Entity\EntityTestService');
        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        //$this->srcService = $this->prophesize('Gear\Constructor\Src\SrcService');
        $this->srcService = $this->prophesize('GearJson\Src\SrcService');
        $this->serviceManager = $this->prophesize('Gear\Mvc\Config\ServiceManager');
        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');

        $this->schemaLoaderService = $this->prophesize('GearJson\Schema\Loader\SchemaLoaderService');
        $this->dirService = $this->prophesize('GearBase\Util\Dir\DirService');
        $this->globService = $this->prophesize('Gear\Util\Glob\GlobService');


        $this->entityFixerObject = $this->prophesize('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer');

        $this->moduleName = 'MyModule';

        $this->root = vfsStream::setUp('module');
        vfsStream::newDirectory('src')->at($this->root);
        vfsStream::newDirectory('src/'.$this->moduleName)->at($this->root);
        vfsStream::newDirectory('src/'.$this->moduleName.'/Entity')->at($this->root);

        $this->service = new EntityService(
            $this->module->reveal(),
            $this->doctrineService->reveal(),
            $this->scriptService->reveal(),
            $this->entityTestService->reveal(),
            $this->tableService->reveal(),
            $this->srcService->reveal(),
            $this->serviceManager->reveal(),
            $this->schemaService->reveal(),
            $this->dirService->reveal(),
            $this->globService->reveal(),
            $this->entityFixerObject->reveal()
        );
    }

    /**
     * @group me
     */
    public function testNoMappingToExcludeOnExcludeMapping()
    {
        //$this->assertFileExists(vfsStream::url('module/src/MyModule/Entity'));

        $this->module->getSrcFolder()->willReturn(vfsStream::url('module/src'))->shouldBeCalled();

        $this->globService->list(vfsStream::url('module/src').'/*')->willReturn([***REMOVED***);
        //$this->module->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();

        $this->assertTrue($this->service->excludeMapping());
    }


    /**
     * @group me1
     */
    public function testGetNames()
    {
        //$this->schemaService->__extractObject('src')->willReturn([***REMOVED***)->shouldBeCalled();
        //$this->schemaService->__extractObject('db')->willReturn([***REMOVED***)->shouldBeCalled();
        //$this->schemaService->__extract('db')->willReturn([***REMOVED***)->shouldBeCalled();
        //$this->schemaService->__extract('src')->willReturn([***REMOVED***)->shouldBeCalled();

        $this->schemaService->getSchemaLoaderService()->willReturn($this->schemaLoaderService->reveal())->shouldBeCalled();

        $this->schemaService->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();
        $this->assertEquals([***REMOVED***, $this->service->getNames());
    }


    /**
     * @group me
     */
    public function testExcludeEntities()
    {
        $this->module->getEntityFolder()->willReturn(vfsStream::url('module/src/MyModule/Entity'))->shouldBeCalled();

        $this->schemaService->getSchemaLoaderService()->willReturn($this->schemaLoaderService->reveal())->shouldBeCalled();
        $this->schemaService->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();

        $this->globService->list(vfsStream::url('module/src/MyModule/Entity').'/*.php')->willReturn([***REMOVED***);

        $this->assertTrue($this->service->excludeEntities());
    }

    public function testCreateEntities()
    {
        $srcs = [
            new Src([
                'name' => 'EntityOne',
                'type' => 'Entity'
            ***REMOVED***),
            new Src([
                'name' => 'EntityTwo',
                'type' => 'Entity'
            ***REMOVED***)
        ***REMOVED***;

        $this->module->getSrcFolder()->willReturn(vfsStream::url('module/src'))->shouldBeCalled();
        $this->module->getEntityFolder()->willReturn(vfsStream::url('module/src/MyModule/Entity'))->shouldBeCalled();

        $this->schemaService->getSchemaLoaderService()->willReturn($this->schemaLoaderService->reveal())->shouldBeCalled();
        $this->schemaService->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();


        $this->doctrineService->getOrmConvertMapping()->willReturn('orm-convert-mapping')->shouldBeCalled();
        $this->doctrineService->getOrmGenerateEntities()->willReturn('orm-generate-entities')->shouldBeCalled();


        $this->scriptService->run('orm-convert-mapping')->willReturn(true)->shouldBeCalled();
        $this->scriptService->run('orm-generate-entities')->willReturn(true)->shouldBeCalled();

        $this->assertTrue($this->service->createEntities($srcs));
        //$this->assertTrue(false);
    }
}
