<?php
namespace GearTest\ModuleTest\NodeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Node
 * @group Protractor
 */
class ProtractorTraitTest extends AbstractTestCase
{
    use \Gear\Module\Node\ProtractorTrait;

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getProtractor()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Protractor'
        )->reveal();

        $this->setProtractor($karma);
        $this->assertEquals($karma, $this->getProtractor());
    }
}
