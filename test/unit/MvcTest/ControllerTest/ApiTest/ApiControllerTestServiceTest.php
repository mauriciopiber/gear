<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Mvc\Controller\Api\ApiControllerTestService;

/**
 * @group Service
 */
class ApiControllerTestServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->service = new ApiControllerTestService();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Mvc\Controller\Api\ApiControllerTestService', $this->service);
    }
}
