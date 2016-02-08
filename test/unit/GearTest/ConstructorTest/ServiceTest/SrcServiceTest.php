<?php
namespace GearTest\ConstructorTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Service\SrcServiceTrait;

/**
 * @group NOW
 */
class SrcServiceTest extends AbstractTestCase
{
    use SrcServiceTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\Service\SrcService', $this->getSrcService());
    }


    public function testCreateServiceSrc()
    {
        $schema = $this->getMockSingleClass('Gear\Schema', ['insertSrc'***REMOVED***);
        $schema->expects($this->any())->method('insertSrc')->willReturn(true);

        $repository = $this->getMockSingleClass('Gear\Mvc\Service\ServiceService', ['create'***REMOVED***);
        $repository->expects($this->any())->method('create')->willReturn(true);

        $config = $this->getMockSingleClass('Gear\Mvc\Config\EntityManager', ['mergeFromSrc'***REMOVED***);
        $config->expects($this->any())->method('mergeFromSrc')->willReturn(true);

        $srcService = new \Gear\Constructor\Service\SrcService();
        $srcService->setGearSchema($schema);
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
        $schema = $this->getMockSingleClass('Gear\Schema', ['insertSrc'***REMOVED***);
        $schema->expects($this->any())->method('insertSrc')->willReturn(true);

        $repository = $this->getMockSingleClass('Gear\Mvc\Repository\RepositoryService', ['create'***REMOVED***);
        $repository->expects($this->any())->method('create')->willReturn(true);

        $config = $this->getMockSingleClass('Gear\Mvc\Config\EntityManager', ['mergeFromSrc'***REMOVED***);
        $config->expects($this->any())->method('mergeFromSrc')->willReturn(true);

        $srcService = new \Gear\Constructor\Service\SrcService();
        $srcService->setGearSchema($schema);
        $srcService->setRepositoryService($repository);
        $srcService->setServiceManager($config);

        $srcData = [
            'type' => 'Repository',
            'name' => 'MyRepository'
        ***REMOVED***;

        $create = $srcService->create($srcData);
        $this->assertTrue($create);
    }

    public function testDeleteSrc()
    {
        $srcService = new \Gear\Constructor\Service\SrcService();
        $delete = $srcService->delete();
        $this->assertTrue($delete);
    }
}
