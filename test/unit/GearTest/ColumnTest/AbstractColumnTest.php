<?php
namespace GearTest\ColumnTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group AbstractColumn
 * @group AbstractColumnTest
 */
class AbstractColumnTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->abstractColumn = $this->getMockForAbstractClass('Gear\Column\AbstractColumn', [***REMOVED***, '', false);
        $this->abstractColumn->setStringService(new \GearBase\Util\String\StringService());
        $this->column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
    }

    public function testIntegrationActionSendKeys()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionSendKeys(55);
        $this->assertEquals('E eu entro com o valor "55My Column" no campo "My Column"', trim($text));
    }

    public function testIntegrationActionExpectedValues()
    {
        $this->column->getName()->willReturn('my_column')->shouldBeCalled();
        $this->abstractColumn->setColumn($this->column->reveal());

        $text = $this->abstractColumn->getIntegrationActionExpectValue(54);

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