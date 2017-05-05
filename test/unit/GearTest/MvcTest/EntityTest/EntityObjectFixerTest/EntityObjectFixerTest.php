<?php
namespace GearTest\MvcTest\EntityTest\EntityObjectFixerTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer;

/**
 * @group Service
 */
class EntityObjectFixerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');

        $this->service = new EntityObjectFixer(
            $this->stringService->reveal()
        );
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer', $this->service);
    }
}
