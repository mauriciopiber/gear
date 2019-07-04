<?php
namespace GearTest\UtilTest\PromptTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Prompt\ConsolePromptFactory;
use Zend\Console\Request;
use Interop\Container\ContainerInterface;

/**
 * @group Gear
 * @group ConsolePrompt
 */
class ConsolePromptFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $request = $this->prophesize(Request::class);
        $request->getParam('force', false)->willReturn(true);

        $this->container->get('Request')->willReturn($request->reveal())->shouldBeCalled();

        $factory = new ConsolePromptFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Util\Prompt\ConsolePrompt', $instance);
    }
}
