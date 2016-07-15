<?php
namespace GearTest\ColumnTest\VarcharTest;

use GearBaseTest\AbstractTestCase;
use Gear\Column\Varchar\PasswordVerify;

/**
 * @group AbstractColumn
 * @group Column\Varchar
 * @group Column\Varchar\PasswordVerify
 */
class PasswordVerifyTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $column->getName()->willReturn('my_column');

        $this->passwordVerify = new PasswordVerify($column->reveal());
        $this->passwordVerify->setStringService(new \GearBase\Util\String\StringService());
    }

    public function valuesDb()
    {
        return [
            [30, '30MyColumn'***REMOVED***,
            [01, '01MyColumn'***REMOVED***,
            [90, '90MyColumn'***REMOVED***,
            [2123, '2123MyColumn'***REMOVED***
        ***REMOVED***;
    }

    public function valuesView()
    {
        return [
            [30, '30MyColumn'***REMOVED***,
            [01, '01MyColumn'***REMOVED***,
            [90, '90MyColumn'***REMOVED***,
            [2123, '2123MyColumn'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider valuesView
     */
    public function testGetValueView($iterator, $expected)
    {
        $value = $this->passwordVerify->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $value = $this->passwordVerify->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }
}

