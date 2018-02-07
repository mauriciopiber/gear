<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Mvc\Controller\Api\ApiControllerService;

/**
 * @group Service
 */
class ApiControllerServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->service = new ApiControllerService();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Mvc\Controller\Api\ApiControllerService', $this->service);
    }
}
