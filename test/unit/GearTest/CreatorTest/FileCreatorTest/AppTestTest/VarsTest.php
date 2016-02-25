<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTestTest;

use GearBaseTest\AbstractTestCase;
use Gear\Creator\FileCreator\AppTest\VarsTrait;

/**
 * @group Service
 */
class VarsTest extends AbstractTestCase
{
    use VarsTrait;

    /**
     * @group Gear
     * @group Vars
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getVars()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group Vars
    */
    public function testGet()
    {
        $vars = $this->getVars();
        $this->assertInstanceOf('Gear\Creator\FileCreator\AppTest\Vars', $vars);
    }

    /**
     * @group Gear
     * @group Vars
    */
    public function testSet()
    {
        $mockVars = $this->getMockSingleClass(
            'Gear\Creator\FileCreator\AppTest\Vars'
        );
        $this->setVars($mockVars);
        $this->assertEquals($mockVars, $this->getVars());
    }
}
