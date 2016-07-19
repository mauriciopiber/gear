<?php
namespace GearTest\ColumnTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group AbstractColumn
 * @group AbstractCheckbox
 * @group ValidDate
 */
class AbstractDateTimeTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->abstractDatetime = $this->getMockForAbstractClass('Gear\Column\DateTime\AbstractDateTime', [***REMOVED***, '', false);
    }

    public function iteratorYearProvider()
    {
        return [
            [1, 2001***REMOVED***, [5, 2005***REMOVED***, [11, 2011***REMOVED***, [12, 2012***REMOVED***, [13, 2013***REMOVED***, [20, 2020***REMOVED***, [35, 2015***REMOVED***, [90, 2010***REMOVED***
        ***REMOVED***;
    }

    public function iteratorMonthProvider()
    {
        return [
            [1, 1***REMOVED***, [5, 5***REMOVED***, [11, 11***REMOVED***, [12, 12***REMOVED***, [13, 1***REMOVED***, [20, 8***REMOVED***, [35, 11***REMOVED***, [90, 6***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider iteratorYearProvider
     */
    public function testGetValidYear($month, $expected)
    {
        $this->assertEquals($expected, $this->abstractDatetime->getValidYear($month));
    }

    /**
     * @dataProvider iteratorMonthProvider
     */
    public function testGetValidMonth($month, $expected)
    {
        $this->assertEquals($expected, $this->abstractDatetime->getValidMonth($month));
    }
}
