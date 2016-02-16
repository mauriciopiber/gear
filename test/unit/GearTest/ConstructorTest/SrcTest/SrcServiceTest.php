<?php
namespace GearTest\ConstructorTest\SrcTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Src\SrcServiceTrait;

/**
 * @group module
 */
class SrcServiceTest extends AbstractTestCase
{
    use SrcServiceTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\Src\SrcService', $this->getSrcService());
    }


    public function testCreateServiceSrc()
    {
        $src = $this->getMockSingleClass('GearJson\Src\Src', ['getName', 'getType'***REMOVED***);
        $src->expects($this->any())->method('getName')->willReturn('MyService');
        $src->expects($this->any())->method('getType')->willReturn('Service');

        $schema = $this->getMockSingleClass('GearJson\Src\SrcService', ['create'***REMOVED***);
        $schema->expects($this->any())->method('create')->willReturn($src);

        $repository = $this->getMockSingleClass('Gear\Mvc\Service\ServiceService', ['create'***REMOVED***);
        $repository->expects($this->any())->method('create')->willReturn(true);

        $config = $this->getMockSingleClass('Gear\Mvc\Config\ServiceManager', ['create'***REMOVED***);
        $config->expects($this->any())->method('create')->willReturn(true);

        $module = $this->getMockSingleClass('Gear\Module\BasicModuleStructure', ['getModuleName'***REMOVED***);
        $module->expects($this->any())->method('getModuleName')->willReturn('Piber');

        $srcService = new \Gear\Constructor\Src\SrcService();
        $srcService->setSrcService($schema);
        $srcService->setModule($module);
        $srcService->setServiceService($repository);
        $srcService->setServiceManager($config);

        $srcData = [
            'type' => 'Service',
            'name' => 'MyService'
        ***REMOVED***;

        $create = $srcService->create($srcData);
        $this->assertTrue($create);
    }

    public function testCreateRepositorySrc()
    {
        $src = $this->getMockSingleClass('GearJson\Src\Src', ['getName', 'getType'***REMOVED***);
        $src->expects($this->any())->method('getName')->willReturn('MyRepository');
        $src->expects($this->any())->method('getType')->willReturn('Repository');

        $schema = $this->getMockSingleClass('GearJson\Src\SrcService', ['create'***REMOVED***);
        $schema->expects($this->any())->method('create')->willReturn($src);

        $repository = $this->getMockSingleClass('Gear\Mvc\Repository\RepositoryService', ['create'***REMOVED***);
        $repository->expects($this->any())->method('create')->willReturn(true);

        $config = $this->getMockSingleClass('Gear\Mvc\Config\ServiceManager', ['create'***REMOVED***);
        $config->expects($this->any())->method('create')->willReturn(true);

        $module = $this->getMockSingleClass('Gear\Module\BasicModuleStructure', ['getModuleName'***REMOVED***);
        $module->expects($this->any())->method('getModuleName')->willReturn('Piber');

        $srcService = new \Gear\Constructor\Src\SrcService();
        $srcService->setSrcService($schema);
        $srcService->setModule($module);
        $srcService->setRepositoryService($repository);
        $srcService->setServiceManager($config);

        $srcData = [
            'type' => 'Repository',
            'name' => 'MyRepository'
        ***REMOVED***;

        $create = $srcService->create($srcData);
        $this->assertTrue($create);
    }

    /*
    public function testDeleteSrc()
    {
        $srcService = new \Gear\Constructor\Service\SrcService();
        $delete = $srcService->delete();
        $this->assertTrue($delete);
    }
    */
}
