<?php
namespace GearTest\CreatorTest\CodesTest\CodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Code\AbstractCode;

/**
 * @group Service
 */
class AbstractCodeTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->service = $this->getMockForAbstractClass('Gear\Code\AbstractCode', [***REMOVED***, '', false);
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Code\AbstractCode', $this->service);
    }
}
