<?php
namespace GearTest\ServiceTest\TestServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class RepositoryTestServiceTest extends AbstractGearTest
{

    public function testCallService()
    {
        $service = $this->bootstrap->getServiceLocator()->get('repositoryTestService');
        $this->assertInstanceOf('Gear\Service\Test\RepositoryTestService', $service);
    }


    public function testCreateAbstractRepositoryTest()
    {

        $service = $this->bootstrap->getServiceLocator()->get('repositoryTestService');

        $templateService = $this->getMockClass('Gear\Service\TemplateService');


        $service->createAbstract();
    }

}
