<?php
namespace GearTest\ColumnTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group AbstractColumn
 * @group AbstractCheckbox
 */
class AbstractCheckboxTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->abstractCheckbox = $this->getMockForAbstractClass('Gear\Column\Int\AbstractCheckbox', [***REMOVED***, '', false);
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->abstractCheckbox->setColumn($column->reveal());
        $this->abstractCheckbox->setStringService(new \GearBase\Util\String\StringService());
    }

    public function testIntegrationActionSendKeysMark()
    {
        $text = $this->abstractCheckbox->getIntegrationActionSendKeys(55);

        $this->assertEquals('E eu marco a caixa de escolha "My Column"', trim($text));
    }

    public function testIntegrationActionSendKeysUnmark()
    {
        $text = $this->abstractCheckbox->getIntegrationActionSendKeys(54);

        $this->assertEquals('E eu desmarco a caixa de escolha "My Column"', trim($text));
    }

    public function testIntegrationActionExpectedValuesNo()
    {
        $text = $this->abstractCheckbox->getIntegrationActionExpectValue(54);

        $this->assertEquals('E eu vejo desmarcada a caixa de escolha "My Column"', trim($text));
    }

    public function testIntegrationActionExpectedValuesYes()
    {
        $text = $this->abstractCheckbox->getIntegrationActionExpectValue(55);

        $this->assertEquals('E eu vejo marcada a caixa de escolha "My Column"', trim($text));
    }
}
