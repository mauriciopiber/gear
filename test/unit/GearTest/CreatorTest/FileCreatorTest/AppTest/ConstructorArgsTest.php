<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Creator\FileCreator\App\ConstructorArgsTrait;

/**
 * @group Service
 */
class ConstructorArgsTest extends AbstractTestCase
{
    use ConstructorArgsTrait;

    /**
     * @group Gear
     * @group ConstructorArgs
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getConstructorArgs()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ConstructorArgs
    */
    public function testGet()
    {
        $constructorArgs = $this->getConstructorArgs();
        $this->assertInstanceOf('Gear\Creator\FileCreator\App\ConstructorArgs', $constructorArgs);
    }

    /**
     * @group Gear
     * @group ConstructorArgs
    */
    public function testSet()
    {
        $mockConstructorArgs = $this->getMockSingleClass(
            'Gear\Creator\FileCreator\App\ConstructorArgs'
        );
        $this->setConstructorArgs($mockConstructorArgs);
        $this->assertEquals($mockConstructorArgs, $this->getConstructorArgs());
    }
}
