<?php
namespace GearTest\ModuleTest\NodeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Node
 * @group Package
 */
class PackageTraitTest extends AbstractTestCase
{
    use \Gear\Module\Node\PackageTrait;

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPackage()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $karma = $this->prophesize(
            'Gear\Module\Node\Package'
        )->reveal();

        $this->setPackage($karma);
        $this->assertEquals($karma, $this->getPackage());
    }
}
