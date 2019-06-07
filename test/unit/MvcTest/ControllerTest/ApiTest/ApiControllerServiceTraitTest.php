<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Controller\Api\ApiControllerServiceTrait;
use Gear\Mvc\Controller\Api\ApiControllerService;

/**
 * @group Gear
 * @group ApiControllerService
 * @group Service
 */
class ApiControllerServiceTraitTest extends TestCase
{
    use ApiControllerServiceTrait;

    public function setUp() : void
    {
        $this->apiControllerServiceMock = $this->prophesize(ApiControllerService::class);
    }

    public function testGetEmpty()
    {
        $apiControllerService = $this->getApiControllerService();
        $this->assertNull($apiControllerService);
    }

    public function testSet()
    {
        $this->setApiControllerService($this->apiControllerServiceMock->reveal());
        $apiControllerService = $this->getApiControllerService();

        $this->assertInstanceOf(
            ApiControllerService::class,
            $apiControllerService
        );

        $this->assertEquals(
            $this->apiControllerServiceMock->reveal(),
            $apiControllerService
        );
    }
}
