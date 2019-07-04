<?php
namespace GearTest\ColumnTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Zend\Db\Metadata\Object\ColumnObject;

/**
 * @group AbstractColumn
 * @group AbstractColumnTest
 */
class AbstractColumnTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->abstractColumn = $this->getMockForAbstractClass('Gear\Column\AbstractColumn', [***REMOVED***, '', false);
        $this->abstractColumn->setStringService(new StringService());
        $this->column = $this->prophesize(ColumnObject::class);
        $this->column->getCharacterMaximumLength()->willReturn(45);
    }

    public function testGetFilterData()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getFilterData(99);

        $this->assertEquals("'myColumn' => '99My Column',", trim($text));
    }

    public function testIntegrationActionSendKeysValidateMax()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationSendKeysValidateMax();
        $this->assertEquals('E eu entro com o valor "abcdefghijklmnopqrstujxywzabcdefghijklmnopqrst" no campo "My Column"', trim($text));
    }

    public function testIntegrationActionSendKeysValidateMin()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationSendKeysValidateMin();
        $this->assertEquals('E eu entro com o valor "ab" no campo "My Column"', trim($text));
    }


    public function testIntegrationActionExpectValidateMax()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationExpectValidateMax();

        $this->assertEquals('E eu vejo a o aviso de validação que "O valor deve ter no máximo 45 caracteres" no campo "My Column"', trim($text));
    }

    public function testIntegrationActionExpectValidateUnique()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationExpectValidateUnique();

        $this->assertEquals('E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "My Column"', trim($text));
    }

    public function testIntegrationActionExpectValidateMin()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationExpectValidateMin();

        $this->assertEquals('E eu vejo a o aviso de validação que "O valor deve ter no mínimo 3 caracteres" no campo "My Column"', trim($text));
    }

    public function testIntegrationActionSendKeys()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionSendKeys(55);
        $this->assertEquals('E eu entro com o valor "55My Column" no campo "My Column"', trim($text));
    }

    public function testIntegrationActionSendKeysInvalid()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionSendKeysInvalid();
        $this->assertEquals('E eu entro com o valor "ABCDEF" no campo "My Column"', trim($text));
    }

    public function testIntegrationActionExpectedValues()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionExpectValue(['default' => 54***REMOVED***);

        $this->assertEquals('E eu vejo o valor "54My Column" no campo "My Column"', trim($text));
    }

    public function testIntegrationValidationValuesNull()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->column->isNullable()->willReturn(true)->shouldBeCalled();

        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionIsNullable();

        $expected = 'E eu vejo o valor "" no campo "My Column"';

        $this->assertEquals($expected, trim($text));
    }

    public function testIntegrationValidationValuesNotNullInvalid()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        //$this->column->isNullable()->willReturn(false)->shouldBeCalled();

        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionIsInvalid();

        $template = 'E eu vejo a o aviso de validação que "%s" no campo "My Column"';

        $message = 'O valor é inválido';

        $expected = sprintf($template, $message);

        $this->assertEquals($expected, trim($text));
    }

    public function testIntegrationValidationValuesNotNull()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->column->isNullable()->willReturn(false)->shouldBeCalled();

        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionIsNullable();

        $template = 'E eu vejo a o aviso de validação que "%s" no campo "My Column"';

        $message = 'O valor é obrigatório e não pode estar vazio';

        $expected = sprintf($template, $message);

        $this->assertEquals($expected, trim($text));
    }
}