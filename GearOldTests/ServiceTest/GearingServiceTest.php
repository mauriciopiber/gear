<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

class GearingServiceTest extends AbstractGearTest
{
    public function testCanCallByServiceLocator()
    {
        $engineService = $this->getServiceLocator()->get('gearingService');
        $this->assertInstanceOf('Gear\Service\GearingService', $engineService);
    }


}
