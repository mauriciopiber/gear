<?php
namespace GearTest\ModuleTest\NodeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Node
 * @group Karma
 */
class KarmaTraitTest extends AbstractTestCase
{
    use \Gear\Module\Node\KarmaTrait;

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getKarma()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Karma'
        )->reveal();

        $this->setKarma($karma);
        $this->assertEquals($karma, $this->getKarma());
    }
}
