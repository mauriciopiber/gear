<?php
namespace PiberNetworkTest\ControllerTest;

use PiberNetworkTest\ControllerTest\AbstractControllerTest;

class PrecoTipoServicoControllerTest extends AbstractControllerTest
{
    
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/preco-tipo-servico/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\PrecoTipoServico');
        $this->assertActionName('create');
        $this->assertControllerClass('PrecoTipoServicoController');
        $this->assertMatchedRouteName('piber-network/preco-tipo-servico/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/preco-tipo-servico/editar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\PrecoTipoServico');
        $this->assertActionName('edit');
        $this->assertControllerClass('PrecoTipoServicoController');
        $this->assertMatchedRouteName('piber-network/preco-tipo-servico/edit');
    }

    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/preco-tipo-servico/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\PrecoTipoServico');
        $this->assertActionName('list');
        $this->assertControllerClass('PrecoTipoServicoController');
        $this->assertMatchedRouteName('piber-network/preco-tipo-servico/list');
    }

    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/preco-tipo-servico/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\PrecoTipoServico');
        $this->assertActionName('delete');
        $this->assertControllerClass('PrecoTipoServicoController');
        $this->assertMatchedRouteName('piber-network/preco-tipo-servico/delete');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/piber-network/preco-tipo-servico/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('PiberNetwork');
        $this->assertControllerName('PiberNetwork\Controller\PrecoTipoServico');
        $this->assertActionName('view');
        $this->assertControllerClass('PrecoTipoServicoController');
        $this->assertMatchedRouteName('piber-network/preco-tipo-servico/view');
    }
}
