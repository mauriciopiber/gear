<?php
namespace GearTest\IntegrationTest\UtilTest\ResolveNamesTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Suite\Src\SrcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\Src\SrcMajorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;
use Gear\Integration\Suite\Controller\ControllerMajorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group Service
 */
class ResolveNamesTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->stringService = $this->prophesize('Gear\Util\String\StringService');

        $this->service = new ResolveNames($this->stringService->reveal());
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Util\ResolveNames\ResolveNames', $this->service);
    }

}
