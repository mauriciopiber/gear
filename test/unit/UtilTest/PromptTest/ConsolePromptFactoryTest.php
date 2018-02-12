<?php
namespace GearTest\UtilTest\PromptTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Gear
 * @group ConsolePrompt
 */
class ConsolePromptFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $request = $this->prophesize('Zend\Console\Request');
        $request->getParam('force', false)->willReturn(true);

        $this->serviceLocator->get('Request')->willReturn($request->reveal())->shouldBeCalled();

        $factory = new \Gear\Util\Prompt\ConsolePromptFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Util\Prompt\ConsolePrompt', $instance);
    }
}
