<?php
namespace GearTest\CreatorTest\CodesTest\CodeTestTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Creator\Codes\CodeTest\AbstractCodeTest;

/**
 * @group Service
 */
class AbstractCodeTestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getMockForAbstractClass('Gear\Creator\Codes\CodeTest\AbstractCodeTest', [***REMOVED***, '', false);
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Creator\Codes\CodeTest\AbstractCodeTest', $this->service);
    }
}
