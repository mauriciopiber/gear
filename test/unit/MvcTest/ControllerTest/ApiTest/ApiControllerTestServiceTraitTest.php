<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Controller\Api\ApiControllerTestServiceTrait;
use Gear\Mvc\Controller\Api\ApiControllerTestService;

/**
 * @group Gear
 * @group ApiControllerTestService
 * @group Service
 */
class ApiControllerTestServiceTraitTest extends TestCase
{
    use ApiControllerTestServiceTrait;

    public function testGetEmpty()
    {
        $apiControllerTest = $this->getApiControllerTestService();
        $this->assertNull($apiControllerTest);
    }

    public function testSet()
    {
        $this->setApiControllerTestService($this->apiControllerTestServiceMock->reveal());
        $apiControllerTest = $this->getApiControllerTestService();

        $this->assertInstanceOf(
            ApiControllerTestService::class,
            $apiControllerTest
        );

        $this->assertEquals(
            $this->apiControllerTestServiceMock->reveal(),
            $apiControllerTest
        );
    }
}
