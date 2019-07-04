<?php
namespace GearTest\IntegrationTest\SuiteTest\IntegrationTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Src\SrcSuite\SrcSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite;
use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite;
use Gear\Integration\Suite\Integration\Integration;

/**
 * @group Service
 */
class IntegrationTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->srcSuite = $this->prophesize(SrcSuite::class);
        $this->srcMvcSuite = $this->prophesize(SrcMvcSuite::class);
        $this->controllerSuite = $this->prophesize(ControllerSuite::class);
        $this->controllerMvcSuite = $this->prophesize(ControllerMvcSuite::class);
        $this->mvcSuite = $this->prophesize(MvcSuite::class);

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
