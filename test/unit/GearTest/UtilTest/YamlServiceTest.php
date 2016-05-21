<?php
namespace GearTest\UtilTest;

use GearBaseTest\AbstractTestCase;
use Gear\Util\YamlServiceTrait;

/**
 * @group Service
 */
class YamlServiceTest extends AbstractTestCase
{
    use YamlServiceTrait;

    /**
     * @group Gear
     * @group YamlService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getYamlService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group YamlService
    */
    public function testGet()
    {
        $yamlService = $this->getYamlService();
        $this->assertInstanceOf('Gear\Util\YamlService', $yamlService);
    }

    /**
     * @group Gear
     * @group YamlService
    */
    public function testSet()
    {
        $mockYamlService = $this->getMockSingleClass(
            'Gear\Util\YamlService'
        );
        $this->setYamlService($mockYamlService);
        $this->assertEquals($mockYamlService, $this->getYamlService());
    }
}
