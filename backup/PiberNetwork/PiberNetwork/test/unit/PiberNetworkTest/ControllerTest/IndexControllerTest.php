<?php
namespace PiberNetworkTest\ControllerTest;


use PiberNetworkTest\ControllerTest\AbstractControllerTest;

class IndexControllerTest extends AbstractControllerTest
{
    public function testCanAccessNewCreatedModule()
    {
        $this->dispatch('/piber-network');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\Index');
        $this->assertActionName('index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('piber-network');
    }
}
