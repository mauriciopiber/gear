<?php
namespace PiberNetworkTest\ControllerTest;

use PiberNetworkTest\ControllerTest\AbstractControllerTest;

class TipoCustoControllerTest extends AbstractControllerTest
{
    
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-custo/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoCusto');
        $this->assertActionName('create');
        $this->assertControllerClass('TipoCustoController');
        $this->assertMatchedRouteName('piber-network/tipo-custo/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-custo/editar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoCusto');
        $this->assertActionName('edit');
        $this->assertControllerClass('TipoCustoController');
        $this->assertMatchedRouteName('piber-network/tipo-custo/edit');
    }

    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-custo/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoCusto');
        $this->assertActionName('list');
        $this->assertControllerClass('TipoCustoController');
        $this->assertMatchedRouteName('piber-network/tipo-custo/list');
    }

    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-custo/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoCusto');
        $this->assertActionName('delete');
        $this->assertControllerClass('TipoCustoController');
        $this->assertMatchedRouteName('piber-network/tipo-custo/delete');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-custo/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoCusto');
        $this->assertActionName('view');
        $this->assertControllerClass('TipoCustoController');
        $this->assertMatchedRouteName('piber-network/tipo-custo/view');
    }
}
