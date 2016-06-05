<?php
namespace GearTest\UtilTest\PromptTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group ConsolePrompt
 */
class ConsolePromptFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Util\Prompt\ConsolePromptFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Util\Prompt\ConsolePrompt', $instance);
    }
}
