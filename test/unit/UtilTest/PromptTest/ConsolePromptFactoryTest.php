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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $request = $this->prophesize('Zend\Console\Request');
        $request->getParam('force', false)->willReturn(true);

        $this->container->get('Request')->willReturn($request->reveal())->shouldBeCalled();

        $factory = new \Gear\Util\Prompt\ConsolePromptFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Util\Prompt\ConsolePrompt', $instance);
    }
}
