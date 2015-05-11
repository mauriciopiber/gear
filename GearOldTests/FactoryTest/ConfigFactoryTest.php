<?php
namespace GearTest\FactoryTest;

use GearTest\AbstractGearTest;

class ConfigFactoryTest extends AbstractGearTest
{

    public function testCreateService()
    {
        $configFactory = $this->getServiceLocator()->get('moduleConfig');
        $this->assertInstanceOf('Gear\ValueObject\Config\Config', $configFactory);
    }
}
