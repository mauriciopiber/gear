<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\Src\SrcMinorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class SrcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->majorSuite = $this->prophesize('Gear\Integration\Suite\Src\SrcMajorSuite');
        $this->srcMinorSuite = new SrcMinorSuite($this->majorSuite->reveal(), 'service', '1');
    }

    public function testCreateMinorSuite()
    {
        $this->assertEquals($this->majorSuite->reveal(), $this->srcMinorSuite->getMajorSuite());
        //$this->assertEquals('service', $this->srcMinorSuite->getType());
        //$this->assertEquals('1', $this->srcMinorSuite->getRepeat());
    }

}
