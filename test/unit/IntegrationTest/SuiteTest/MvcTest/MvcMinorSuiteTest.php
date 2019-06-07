<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group MinorSuite
 * @group Suite
 */
class MvcMinorSuiteTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    public function getSuiteData()
    {
        $data = [***REMOVED***;
        $data[***REMOVED*** = new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'basic', 'all', null, null, true);
        $data[***REMOVED*** = new MvcMinorSuite(new MvcMajorSuite('mvc-basic'), 'basic', 'all', null, null, false);
        $data[***REMOVED*** = new MvcMinorSuite(new MvcMajorSuite('mvc-complete'), 'complete', 'low-strict', ['unique', 'nullable'***REMOVED***, 'upload-image', true);
        $data[***REMOVED*** = new MvcMinorSuite(new MvcMajorSuite('mvc-complete'), 'complete', 'low-strict', ['unique', 'nullable'***REMOVED***, 'upload-image', false);
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
            'MvcBasic',
            'MvcBasic',
            'MvcCompleteLowStrictUniqueNullableUploadImage',
            'MvcCompleteLowStrictUniqueNullableUploadImage'
        ***REMOVED***;

        return $this->createDataSet($expected);
    }


    public function getTableAliasSuite()
    {
        $expected = [
            'MvcBasic',
            'MvcBsc',
            'MvcCompleteLowStrictUniqueNullableUploadImage',
            'MvcCmpLwsUniNulUpl'
        ***REMOVED***;

        return $this->createDataSet($expected);
    }

    public function getTableLocationKeySuite()
    {
        $expected = [
            'mvc/mvc-basic/mvc-basic',
            'mvc/mvc-basic/mvc-basic',
            'mvc/mvc-complete/mvc-complete-low-strict-unique-nullable-upload-image',
            'mvc/mvc-complete/mvc-complete-low-strict-unique-nullable-upload-image',
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

    public function testMvcMinorSuite()
    {
        $this->major = new MvcMajorSuite('mvc-complete');

        $this->mvcMinorSuite = new MvcMinorSuite($this->major, 'complete', 'all', null, null, true);
        $this->assertEquals($this->major, $this->mvcMinorSuite->getMajorSuite());
        $this->assertTrue($this->mvcMinorSuite->isUsingLongName());

        $this->assertEquals('MvcComplete', $this->mvcMinorSuite->getTableName());
        //$this->mvcMinorSuite->setTableName('mvc-complete-unique-not-null');

        //$this->assertEquals('mvc-complete-unique-not-null', $this->mvcMinorSuite->getSuiteName());
    }

    public function testFullMvcMinorSuite()
    {
        $this->major = new MvcMajorSuite('mvc-complete');

        $this->mvcMinorSuite = new MvcMinorSuite($this->major, 'complete', 'low-strict', ['unique', 'nullable'***REMOVED***, 'upload-image', true);
        $this->assertEquals($this->major, $this->mvcMinorSuite->getMajorSuite());
        $this->assertTrue($this->mvcMinorSuite->isUsingLongName());

        $this->assertEquals('MvcCompleteLowStrictUniqueNullableUploadImage', $this->mvcMinorSuite->getTableName());

    }
}
