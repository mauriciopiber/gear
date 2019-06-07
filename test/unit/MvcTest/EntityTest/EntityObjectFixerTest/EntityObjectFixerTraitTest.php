<?php
namespace GearTest\MvcTest\EntityTest\EntityObjectFixerTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerTrait;

/**
 * @group Gear
 * @group EntityObjectFixer
 * @group Service
 */
class EntityObjectFixerTraitTest extends TestCase
{

    use EntityObjectFixerTrait;

    public function testGet()
    {
        $serviceLocator = $this->getEntityObjectFixer();
        $this->assertNull($serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer')->reveal();
        $this->setEntityObjectFixer($mocking);
        $this->assertEquals($mocking, $this->getEntityObjectFixer());
    }
}
