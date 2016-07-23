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

        $this->string = new \GearBase\Util\String\StringService();


        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $this->column->getDataType()->willReturn('varchar')->shouldBeCalled();
        $this->column->getName()->willReturn('my_column');

        $base = (new \Gear\Module())->getLocation();

        $this->template = $base.'/../../test/template/module/column/varchar/password-verify';
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


    public function testGetFilterElement()
    {
        //$this->column->isNullable()->willReturn(true)->shouldBeCalled();


        $this->passwordVerify = new PasswordVerify($this->column->reveal());
        $this->passwordVerify->setStringService(new \GearBase\Util\String\StringService());

        $filter = $this->passwordVerify->getFilterFormElement();

        $expected = $this->template.'/filter-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }

    /**
    public function testGetFilterUniqueElement()
    {
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();
        $this->column->getTableName()->willReturn('my_table')->shouldBeCalled();

        $this->passwordVerify = new PasswordVerify($this->column->reveal());
        $this->passwordVerify->setStringService(new \GearBase\Util\String\StringService());

        $filter = $this->passwordVerify->filterUniqueElement();

        $expected = $this->template.'/filter-unique-element.phtml';

        $this->assertEquals(file_get_contents($expected), $filter);
    }
    */

    public function testGetInsertArrayByColumn()
    {
        $this->passwordVerify = new PasswordVerify($this->column->reveal());
        $this->passwordVerify->setStringService($this->string);

        $expected = [***REMOVED***;
        $expected[***REMOVED*** = "'myColumn' => '00MyColumn',";
        $expected[***REMOVED*** = "'myColumnVerify' => '00MyColumn',";

        $value = $this->passwordVerify->getInsertArrayByColumn();

        $values = explode(PHP_EOL, $value);

        foreach ($expected as $i => $expect) {
            $this->assertEquals($expect, trim($values[$i***REMOVED***));
        }
    }

    /**
     * @dataProvider valuesView
     */
    public function testGetValueView($iterator, $expected)
    {
        $this->passwordVerify = new PasswordVerify($this->column->reveal());
        $this->passwordVerify->setStringService($this->string);

        $value = $this->passwordVerify->getValue($iterator);
        $this->assertEquals($expected, $value);
    }

    /**
     * @dataProvider valuesDb
     */
    public function testGetValueDb($iterator, $expected)
    {
        $this->passwordVerify = new PasswordVerify($this->column->reveal());
        $this->passwordVerify->setStringService($this->string);

        $value = $this->passwordVerify->getValueDatabase($iterator);
        $this->assertEquals($expected, $value);
    }

    public function testIntegrationValidationValuesNull()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();

        $this->passwordVerify = new PasswordVerify($this->column->reveal());
        $this->passwordVerify->setStringService($this->string);
        $this->passwordVerify->setColumn($this->column->reveal());

        $text = $this->passwordVerify->getIntegrationActionIsNullable();

        $expected = [***REMOVED***;
        $expected[***REMOVED*** = 'E eu vejo o valor "" no campo "My Column"';
        $expected[***REMOVED*** = 'E eu vejo o valor "" no campo "My Column Verify"';

        $textData = explode(PHP_EOL, $text);

        foreach($expected as $index => $expect) {
            $this->assertArrayHasKey($index, $textData);
            $this->assertEquals($expect, trim($textData[$index***REMOVED***));
        }
    }

    public function testIntegrationValidationValuesNotNull()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->column->isNullable()->willReturn(false)->shouldBeCalled();
        $this->passwordVerify = new PasswordVerify($this->column->reveal());
        $this->passwordVerify->setStringService($this->string);
        $this->passwordVerify->setColumn($this->column->reveal());

        $text = $this->passwordVerify->getIntegrationActionIsNullable();

        $template = 'E eu vejo a o aviso de validação que "%s" no campo "%s"';

        $column = 'My Column';
        $message = 'O valor é obrigatório e não pode estar vazio';

        $expected = [***REMOVED***;
        $expected[***REMOVED*** = sprintf($template, $message, $column);
        $expected[***REMOVED*** = sprintf($template, $message, $column.' Verify');

        $textData = explode(PHP_EOL, $text);

        foreach($expected as $index => $expect) {
            $this->assertArrayHasKey($index, $textData);
            $this->assertEquals($expect, trim($textData[$index***REMOVED***));
        }
    }
}

