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

        $this->unloadModule();
    }
}
