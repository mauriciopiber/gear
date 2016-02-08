<?php
namespace GearTest\ConstructorTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Service\SrcServiceTrait;

/**
 * @group action
 */
class SrcServiceTest extends AbstractTestCase
{
    use SrcServiceTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\Service\SrcService', $this->getSrcService());
    }

    public function testCreateSrc()
    {
        $srcService = new \Gear\Constructor\Service\SrcService();

        $srcData = [
            'type' => 'Service',
            'name' => 'MyService'
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
