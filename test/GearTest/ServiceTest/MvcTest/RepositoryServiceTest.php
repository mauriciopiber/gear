<?php
namespace GearTest\ServiceTest\MvcServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class RepositoryServiceTest extends AbstractGearTest
{
    public function testCallService()
    {
        $service = $this->bootstrap->getServiceLocator()->get('repositoryService');
        $this->assertInstanceOf('Gear\Service\Mvc\RepositoryService', $service);
    }
}
