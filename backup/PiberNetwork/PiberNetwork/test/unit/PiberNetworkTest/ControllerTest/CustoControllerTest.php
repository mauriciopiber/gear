<?php
namespace PiberNetworkTest\ControllerTest;

use PiberNetworkTest\ControllerTest\AbstractControllerTest;

class CustoControllerTest extends AbstractControllerTest
{
    
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/custo/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\Custo');
        $this->assertActionName('create');
        $this->assertControllerClass('CustoController');
        $this->assertMatchedRouteName('piber-network/custo/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/custo/editar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\Custo');
        $this->assertActionName('edit');
        $this->assertControllerClass('CustoController');
        $this->assertMatchedRouteName('piber-network/custo/edit');
    }

    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/custo/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\Custo');
        $this->assertActionName('list');
        $this->assertControllerClass('CustoController');
        $this->assertMatchedRouteName('piber-network/custo/list');
    }

    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/custo/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\Custo');
        $this->assertActionName('delete');
        $this->assertControllerClass('CustoController');
        $this->assertMatchedRouteName('piber-network/custo/delete');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/custo/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\Custo');
        $this->assertActionName('view');
        $this->assertControllerClass('CustoController');
        $this->assertMatchedRouteName('piber-network/custo/view');
    }
}
