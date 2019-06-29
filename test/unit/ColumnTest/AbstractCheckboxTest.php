<?php
namespace GearTest\ColumnTest;

use PHPUnit\Framework\TestCase;
use Zend\Db\Metadata\Object\ColumnObject;

/**
 * @group AbstractColumn
 * @group AbstractCheckbox
 */
class AbstractCheckboxTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->abstractCheckbox = $this->getMockForAbstractClass('Gear\Column\Integer\AbstractCheckbox', [***REMOVED***, '', false);
        $column = $this->prophesize(ColumnObject::class);
        $column->getName()->willReturn('my_column')->shouldBeCalled();

        $this->abstractCheckbox->setColumn($column->reveal());
        $this->abstractCheckbox->setStringService(new \Gear\Util\String\StringService());
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
        $text = $this->abstractCheckbox->getIntegrationActionExpectValue(['default' => 54***REMOVED***);

        $this->assertEquals('E eu vejo desmarcada a caixa de escolha "My Column"', trim($text));
    }

    public function testIntegrationActionExpectedValuesYes()
    {
        $text = $this->abstractCheckbox->getIntegrationActionExpectValue(['default' => 55***REMOVED***);

        $this->assertEquals('E eu vejo marcada a caixa de escolha "My Column"', trim($text));
    }
}
