<?php
namespace GearTest\AutoloadTest;

use GearBaseTest\AbstractTestCase;
use Gear\Autoload\ComposerAutoloadTrait;

/**
 * @group Gear
 * @group ComposerAutoload
 */
class ComposerAutoloadTraitTest extends AbstractTestCase
{
    use ComposerAutoloadTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getComposerAutoload();
        $this->assertInstanceOf('Gear\Autoload\ComposerAutoload', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Autoload\ComposerAutoload')->reveal();
        $this->setComposerAutoload($mocking);
        $this->assertEquals($mocking, $this->getComposerAutoload());
    }
}
