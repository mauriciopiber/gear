<?php
namespace GearTest\ServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;

class DbServiceTest extends AbstractServiceTest
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getServiceLocator()->get('dbService');
    }

    /**
     * @group createModule
     */
    public function testCreateDbFromTable()
    {
        $this->moduleService->create();


        /* $this->mockRequest(
            array(
                'table' => 'PiberTable',
                'columns' => ''
            )
        );

        $this->service->setRequest($this->request);

        $this->fixSchema();

        $this->gearService->setServiceLocator($this->bootstrap->getServiceLocator());

        $this->service->setGearSchema($this->gearService);

        $this->service->create(); */

        $this->unloadModule();
    }
}
