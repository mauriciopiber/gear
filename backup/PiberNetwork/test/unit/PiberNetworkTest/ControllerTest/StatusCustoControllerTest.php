<?php
namespace PiberNetworkTest\ControllerTest;

use PiberNetworkTest\ControllerTest\AbstractControllerTest;

class StatusCustoControllerTest extends AbstractControllerTest
{
    
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/status-custo/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\StatusCusto');
        $this->assertActionName('create');
        $this->assertControllerClass('StatusCustoController');
        $this->assertMatchedRouteName('piber-network/status-custo/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/status-custo/editar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\StatusCusto');
        $this->assertActionName('edit');
        $this->assertControllerClass('StatusCustoController');
        $this->assertMatchedRouteName('piber-network/status-custo/edit');
    }

    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/status-custo/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\StatusCusto');
        $this->assertActionName('list');
        $this->assertControllerClass('StatusCustoController');
        $this->assertMatchedRouteName('piber-network/status-custo/list');
    }

    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/status-custo/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\StatusCusto');
        $this->assertActionName('delete');
        $this->assertControllerClass('StatusCustoController');
        $this->assertMatchedRouteName('piber-network/status-custo/delete');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/status-custo/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\StatusCusto');
        $this->assertActionName('view');
        $this->assertControllerClass('StatusCustoController');
        $this->assertMatchedRouteName('piber-network/status-custo/view');
    }
}
