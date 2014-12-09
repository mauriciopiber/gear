<?php
namespace PiberNetworkTest\ControllerTest;

use PiberNetworkTest\ControllerTest\AbstractControllerTest;

class GrupoCustoControllerTest extends AbstractControllerTest
{
    
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/grupo-custo/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\GrupoCusto');
        $this->assertActionName('create');
        $this->assertControllerClass('GrupoCustoController');
        $this->assertMatchedRouteName('piber-network/grupo-custo/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/grupo-custo/editar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\GrupoCusto');
        $this->assertActionName('edit');
        $this->assertControllerClass('GrupoCustoController');
        $this->assertMatchedRouteName('piber-network/grupo-custo/edit');
    }

    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/grupo-custo/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\GrupoCusto');
        $this->assertActionName('list');
        $this->assertControllerClass('GrupoCustoController');
        $this->assertMatchedRouteName('piber-network/grupo-custo/list');
    }

    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/grupo-custo/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\GrupoCusto');
        $this->assertActionName('delete');
        $this->assertControllerClass('GrupoCustoController');
        $this->assertMatchedRouteName('piber-network/grupo-custo/delete');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/grupo-custo/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\GrupoCusto');
        $this->assertActionName('view');
        $this->assertControllerClass('GrupoCustoController');
        $this->assertMatchedRouteName('piber-network/grupo-custo/view');
    }
}
