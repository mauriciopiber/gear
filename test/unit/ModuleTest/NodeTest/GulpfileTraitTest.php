<?php
namespace GearTest\ModuleTest\NodeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Node
 * @group Gulpfile
 */
class GulpfileTraitTest extends AbstractTestCase
{
    use \Gear\Module\Node\GulpfileTrait;

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getGulpfile()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Gulpfile'
        )->reveal();

        $this->setGulpfile($karma);
        $this->assertEquals($karma, $this->getGulpfile());
    }
}
