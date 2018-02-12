<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Src\SrcMinorSuite;
use GearJson\Src\SrcTypesInterface;

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
        $this->srcMinorSuite = new SrcMinorSuite($this->majorSuite->reveal(), SrcTypesInterface::SERVICE, '1', true);
    }

    public function testCreateMinorSuiteViewHelper()
    {
        $this->srcMinorSuite = new SrcMinorSuite($this->majorSuite->reveal(), SrcTypesInterface::VIEW_HELPER, '1', true);

        $this->majorSuite->getSuite()->willReturn('src');

        $this->assertEquals($this->majorSuite->reveal(), $this->srcMinorSuite->getMajorSuite());
        $this->assertEquals('ViewHelper', $this->srcMinorSuite->getType());
        $this->assertEquals('src/src-view-helper', $this->srcMinorSuite->getLocationKey());
        $this->assertTrue($this->srcMinorSuite->isUsingLongName());
    }

    public function testCreateMinorSuite()
    {
        $this->majorSuite->getSuite()->willReturn('src');

        $this->assertEquals($this->majorSuite->reveal(), $this->srcMinorSuite->getMajorSuite());
        $this->assertEquals('Service', $this->srcMinorSuite->getType());
        $this->assertEquals('src/src-service', $this->srcMinorSuite->getLocationKey());
        $this->assertTrue($this->srcMinorSuite->isUsingLongName());
    }
}
