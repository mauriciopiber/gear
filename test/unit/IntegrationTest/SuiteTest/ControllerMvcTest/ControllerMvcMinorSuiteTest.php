<?php
namespace GearTest\IntegrationTest\SuiteTest\ControllerSrcTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class ControllerMvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->controllerMvcMajorSuite = $this->prophesize(ControllerMvcMajorSuite::class);
        $this->controllerMvcMinorSuite = new ControllerMvcMinorSuite($this->controllerMvcMajorSuite->reveal(), null, null, null, null, true);

    }

    public function testControllerMvcMajorSuite()
    {
        $this->controllerMvcMajorSuite->getSuite()->willReturn('controller-mvc')->shouldBeCalled();
        $this->assertEquals($this->controllerMvcMajorSuite->reveal(), $this->controllerMvcMinorSuite->getMajorSuite());
        $this->assertEquals('controller-mvc/controller-mvc', $this->controllerMvcMinorSuite->getLocationKey());
        $this->assertTrue($this->controllerMvcMinorSuite->isUsingLongName());
    }


    public function getSuiteData()
    {
        $data = [***REMOVED***;
        $data[***REMOVED*** = new ControllerMvcMinorSuite(new ControllerMvcMajorSuite(), 'basic', 'all', null, null, true);
        $data[***REMOVED*** = new ControllerMvcMinorSuite(new ControllerMvcMajorSuite(), 'complete', 'strict', 'unique', 'upload_image', true);
        $data[***REMOVED*** = new ControllerMvcMinorSuite(new ControllerMvcMajorSuite(), 'basic', 'all', null, null, false);
        $data[***REMOVED*** = new ControllerMvcMinorSuite(new ControllerMvcMajorSuite(), 'complete', 'strict', 'unique', 'upload_image', false);
        return $data;
    }

    public function createDataSet($expected)
    {
        $data = $this->getSuiteData();

        $dataSet = [***REMOVED***;

        foreach ($data as $key => $item) {
            $dataSet[***REMOVED*** = [$item, $expected[$key***REMOVED******REMOVED***;
        }

        return $dataSet;
    }

    public function getTableNameSuite()
    {
        $expected = [
            'SrcMvcBasic',
            'SrcMvcCompleteStrictUniqueUploadImage',
            'SrcMvcBasic',
            'SrcMvcCompleteStrictUniqueUploadImage',
        ***REMOVED***;

        return $this->createDataSet($expected);
    }

    public function getTableAliasSuite()
    {
        $expected = [
            'SrcMvcBasic',
            'SrcMvcCompleteStrictUniqueUploadImage',
            'SrcMvcBsc',
            'SrcMvcCmpStrUniUpl',
        ***REMOVED***;

        return $this->createDataSet($expected);
    }

    public function getTableLocationKeySuite()
    {
        $expected = [
            'controller-mvc/controller-mvc',
            'controller-mvc/controller-mvc',
            'controller-mvc/controller-mvc',
            'controller-mvc/controller-mvc',
        ***REMOVED***;

        return $this->createDataSet($expected);
    }

    /**
     * @dataProvider getTableLocationKeySuite
     *
     */
    public function testTableLocationKey($suite, $expected)
    {
        $this->assertEquals($expected, $suite->getLocationKey());
    }

    /**
     * @dataProvider getTableAliasSuite
     */
    public function testTableAlias($suite, $expected)
    {
        $this->assertEquals($expected, $suite->getTableAlias());
    }

    /**
     * @dataProvider getTableNameSuite
     */
    public function testTableName($suite, $expected)
    {
        $this->assertEquals($expected, $suite->getTableName());
    }
}
