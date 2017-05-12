<?php
namespace GearTest\CreatorTest\CodesTest\CodeTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Creator\Codes\Code\AbstractCode;

/**
 * @group Service
 */
class AbstractCodeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getMockForAbstractClass('Gear\Creator\Codes\Code\AbstractCode', [***REMOVED***, '', false);
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Creator\Codes\Code\AbstractCode', $this->service);
    }
}
