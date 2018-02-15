<?php
namespace GearTest\MvcTest\EntityTest;

use PHPUnit\Framework\TestCase;
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

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->doctrineService = $this->prophesize('Gear\Mvc\Entity\DoctrineService');
        $this->scriptService = $this->prophesize('Gear\Script\ScriptService');
        $this->entityTestService = $this->prophesize('Gear\Mvc\Entity\EntityTestService');
        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        //$this->srcService = $this->prophesize('Gear\Constructor\Src\SrcConstructor');
        $this->srcService = $this->prophesize('GearJson\Src\SrcSchema');
        $this->serviceManager = $this->prophesize('Gear\Mvc\Config\ServiceManager');
        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');

        $this->schemaLoaderService = $this->prophesize('GearJson\Schema\Loader\SchemaLoaderService');
        $this->dirService = $this->prophesize('GearBase\Util\Dir\DirService');
        $this->globService = $this->prophesize('Gear\Util\Glob\GlobService');
        $this->stringService = new \GearBase\Util\String\StringService();


        $this->entityFixerObject = $this->prophesize('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer');

        $this->moduleName = 'MyModule';

        $this->root = vfsStream::setUp('module');
        vfsStream::newDirectory('src')->at($this->root);
        vfsStream::newDirectory('config')->at($this->root);
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
            $this->entityFixerObject->reveal(),
            $this->stringService
        );
    }

    /**
     * @group count1
     */
    public function testGetNames()
    {
        $this->schemaService->getSchemaLoaderService()->willReturn($this->schemaLoaderService->reveal())->shouldBeCalled();
        $this->schemaService->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();
        $this->assertEquals([***REMOVED***, $this->service->getNames());
    }

        /**
     * @group f2x
     */
    public function testCreateEntitiesPSR4()
    {
        $this->module->getModuleName()->willReturn('Gear\Module')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));


        file_put_contents(vfsStream::url('module/config/application.config.php'), <<<EOS
<?php
return [
    'modules' => [
        'MyModule'
    ***REMOVED***
***REMOVED***;

EOS
            );

        $this->scriptService->run('mv vfs://module/src/Gear/Module/Entity/* vfs://module/src/Entity/')->shouldBeCalled();

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

        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getSrcFolder()->willReturn(vfsStream::url('module/src'))->shouldBeCalled();
        $this->module->getEntityFolder()->willReturn(vfsStream::url('module/src/Entity'))->shouldBeCalled();

        $this->schemaService->getSchemaLoaderService()->willReturn($this->schemaLoaderService->reveal())->shouldBeCalled();
        $this->schemaService->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();


        $this->doctrineService->getOrmConvertMapping()->willReturn('orm-convert-mapping')->shouldBeCalled();
        $this->doctrineService->getOrmGenerateEntities()->willReturn('orm-generate-entities')->shouldBeCalled();


        $this->scriptService->run('orm-convert-mapping')->willReturn(true)->shouldBeCalled();
        $this->scriptService->run('orm-generate-entities')->willReturn(true)->shouldBeCalled();

        $this->service->setModule($this->module->reveal());

        $this->assertTrue($this->service->createEntities($srcs));
        //$this->assertTrue(false);
    }

    /**
     * @group f2x
     */
    public function testCreateEntities()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));


        file_put_contents(vfsStream::url('module/config/application.config.php'), <<<EOS
<?php
return [
    'modules' => [
        'MyModule'
    ***REMOVED***
***REMOVED***;

EOS
            );

        $this->scriptService->run('mv vfs://module/src/MyModule/Entity/* vfs://module/src/Entity/')->shouldBeCalled();

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

        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getSrcFolder()->willReturn(vfsStream::url('module/src'))->shouldBeCalled();
        $this->module->getEntityFolder()->willReturn(vfsStream::url('module/src/Entity'))->shouldBeCalled();

        $this->schemaService->getSchemaLoaderService()->willReturn($this->schemaLoaderService->reveal())->shouldBeCalled();
        $this->schemaService->getModuleName()->willReturn($this->moduleName)->shouldBeCalled();


        $this->doctrineService->getOrmConvertMapping()->willReturn('orm-convert-mapping')->shouldBeCalled();
        $this->doctrineService->getOrmGenerateEntities()->willReturn('orm-generate-entities')->shouldBeCalled();


        $this->scriptService->run('orm-convert-mapping')->willReturn(true)->shouldBeCalled();
        $this->scriptService->run('orm-generate-entities')->willReturn(true)->shouldBeCalled();

        $this->service->setModule($this->module->reveal());

        $this->assertTrue($this->service->createEntities($srcs));
        //$this->assertTrue(false);
    }
}
