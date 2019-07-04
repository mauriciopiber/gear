<?php
namespace GearTest\CodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Code\AbstractCodeTest;

/**
 * @group Service
 */
class AbstractCodeTestTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->service = $this->getMockForAbstractClass('Gear\Code\AbstractCodeTest', [***REMOVED***, '', false);
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Code\AbstractCodeTest', $this->service);
    }
}
