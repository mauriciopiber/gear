<?php
namespace GearTest\ControllerTest;

use GearBaseTest\AbstractControllerTestCase;


class ConfigControllerTest extends AbstractControllerTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->configController = new \Gear\Config\Controller\ConfigController();

        $mockConfig = $this->getMockSingleClass('Gear\Service\ConfigService', ['listConfig', 'add', 'update', 'delete'***REMOVED***);
        $mockConfig->expects($this->any())->method('listConfig')->willReturn(true);
        $mockConfig->expects($this->any())->method('add')->willReturn(true);
        $mockConfig->expects($this->any())->method('update')->willReturn(true);
        $mockConfig->expects($this->any())->method('delete')->willReturn(true);

        $this->configController->setConfigService($mockConfig);
    }

    /**
     * @group testConfig
     */
    public function testConfig()
    {
        $config = $this->configController->configAction();
        $this->assertTrue($config);
    }

    /**
     * @group testConfig
     */
    public function testAddConfig()
    {
        $config = $this->configController->addAction();
        $this->assertTrue($config);
    }

    /**
     * @group testConfig
     */
    public function testUpdateConfig()
    {
        $config = $this->configController->updateAction();
        $this->assertTrue($config);
    }

    /**
     * @group testConfig
     */
    public function testDeleteConfig()
    {
        $config = $this->configController->deleteAction();
        $this->assertTrue($config);
    }
}