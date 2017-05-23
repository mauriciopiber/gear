<?php
namespace GearTest\IntegrationTest\SuiteTest\SrcMvcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class SrcMvcMinorSuiteTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->majorSuite = $this->prophesize('Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite');
        $this->srcMvcMinorSuite = new SrcMvcMinorSuite($this->majorSuite->reveal(), 'service', null, null, null, null, true);
    }


    public function getSuiteData()
    {
        $data = [***REMOVED***;
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'service', 'basic', 'all', null, null, true);
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'service', 'complete', 'strict', 'unique', 'upload_image', true);
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'search-form', 'basic', 'all', null, null, true);
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'search-form', 'complete', 'strict', 'unique', 'upload_image', true);
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'service', 'basic', 'all', null, null, false);
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'service', 'complete', 'strict', 'unique', 'upload_image', false);
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'search-form', 'basic', 'all', null, null, false);
        $data[***REMOVED*** = new SrcMvcMinorSuite(new SrcMvcMajorSuite(), 'search-form', 'complete', 'strict', 'unique', 'upload_image', false);
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
            'SrcMvcBasic',
            'SrcMvcCompleteStrictUniqueUploadImage',
            'SrcMvcBsc',
            'SrcMvcCmpStrUniUpl',
            'SrcMvcBsc',
            'SrcMvcCmpStrUniUpl',
        ***REMOVED***;

        return $this->createDataSet($expected);
    }

    public function getTableLocationKeySuite()
    {
        $expected = [
            'src-mvc/src-mvc-service',
            'src-mvc/src-mvc-service',
            'src-mvc/src-mvc-search-form',
            'src-mvc/src-mvc-search-form',
            'src-mvc/src-mvc-service',
            'src-mvc/src-mvc-service',
            'src-mvc/src-mvc-search-form',
            'src-mvc/src-mvc-search-form',
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

    public function testCreateMinorSuite()
    {
        $this->majorSuite->getSuite()->willReturn('src-mvc')->shouldBeCalled();
        $this->assertEquals($this->majorSuite->reveal(), $this->srcMvcMinorSuite->getMajorSuite());
        $this->assertEquals('service', $this->srcMvcMinorSuite->getType());
        $this->assertEquals('src-mvc/src-mvc-service', $this->srcMvcMinorSuite->getLocationKey());
        $this->assertTrue($this->srcMvcMinorSuite->isUsingLongName());
        //$this->assertEquals('service', $this->srcMvcMinorSuite->getType());
    }
}
