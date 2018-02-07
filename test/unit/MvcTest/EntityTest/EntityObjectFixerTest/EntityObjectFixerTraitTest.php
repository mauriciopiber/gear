<?php
namespace GearTest\MvcTest\EntityTest\EntityObjectFixerTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceManager;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerTrait;

/**
 * @group Gear
 * @group EntityObjectFixer
 * @group Service
 */
class EntityObjectFixerTraitTest extends TestCase
{
    use ServiceLocatorAwareTrait;

    use EntityObjectFixerTrait;

    public function setUp()
    {
        $serviceManager = new ServiceManager();
        $this->mocking = $this->prophesize('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer');
        $serviceManager->setService('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer', $this->mocking->reveal());
        $this->setServiceLocator($serviceManager);
    }

    public function testGet()
    {
        $serviceLocator = $this->getEntityObjectFixer();
        $this->assertInstanceOf('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer')->reveal();
        $this->setEntityObjectFixer($mocking);
        $this->assertEquals($mocking, $this->getEntityObjectFixer());
    }
}
