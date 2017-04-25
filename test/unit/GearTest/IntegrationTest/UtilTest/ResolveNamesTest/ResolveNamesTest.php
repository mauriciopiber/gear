<?php
namespace GearTest\IntegrationTest\UtilTest\ResolveNamesTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Util\ResolveNames\ResolveNames;

/**
 * @group Service
 */
class ResolveNamesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');

        $this->service = new ResolveNames(
            $this->stringService->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Integration\Util\ResolveNames\ResolveNames', $this->service);
    }
}
