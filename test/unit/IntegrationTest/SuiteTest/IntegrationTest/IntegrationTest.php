<?php
namespace GearTest\IntegrationTest\SuiteTest\IntegrationTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Integration\Integration;

/**
 * @group Service
 */
class IntegrationTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->srcSuite = $this->prophesize('Gear\Integration\Suite\Src\SrcSuite\SrcSuite');
        $this->srcMvcSuite = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite');
        $this->controllerSuite = $this->prophesize('Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite');
        $this->controllerMvcSuite = $this->prophesize('Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite');
        $this->mvcSuite = $this->prophesize('Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite');

        $this->service = new Integration(
            $this->srcSuite->reveal(),
            $this->srcMvcSuite->reveal(),
            $this->controllerSuite->reveal(),
            $this->controllerMvcSuite->reveal(),
            $this->mvcSuite->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Suite\Integration\Integration', $this->service);
    }
}
