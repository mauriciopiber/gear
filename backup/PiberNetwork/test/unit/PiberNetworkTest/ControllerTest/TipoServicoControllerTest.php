<?php
namespace PiberNetworkTest\ControllerTest;

use PiberNetworkTest\ControllerTest\AbstractControllerTest;

class TipoServicoControllerTest extends AbstractControllerTest
{
    
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-servico/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoServico');
        $this->assertActionName('create');
        $this->assertControllerClass('TipoServicoController');
        $this->assertMatchedRouteName('piber-network/tipo-servico/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-servico/editar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoServico');
        $this->assertActionName('edit');
        $this->assertControllerClass('TipoServicoController');
        $this->assertMatchedRouteName('piber-network/tipo-servico/edit');
    }

    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-servico/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoServico');
        $this->assertActionName('list');
        $this->assertControllerClass('TipoServicoController');
        $this->assertMatchedRouteName('piber-network/tipo-servico/list');
    }

    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-servico/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoServico');
        $this->assertActionName('delete');
        $this->assertControllerClass('TipoServicoController');
        $this->assertMatchedRouteName('piber-network/tipo-servico/delete');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/tipo-servico/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\TipoServico');
        $this->assertActionName('view');
        $this->assertControllerClass('TipoServicoController');
        $this->assertMatchedRouteName('piber-network/tipo-servico/view');
    }
}
