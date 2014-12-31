<?php
namespace TestUntilTest\ControllerTest;

use TestUntilTest\ControllerTest\AbstractControllerTest;

class PaisControllerTest extends AbstractControllerTest
{

    /**
     * @group testSet
     */
    public function testSetPaisService()
    {
        $paisController = $this->bootstrap->getServiceLocator()->get('ControllerManager')->get('TestUntil\Controller\Pais');

        $abstract = $this->getMockBuilder('TestUntil\Service\PaisService')
        ->disableOriginalConstructor()
        ->getMock();

        $paisController->setPaisService($abstract);

    }

    public function testSetPaisForm()
    {
        $paisController = $this->bootstrap->getServiceLocator()->get('ControllerManager')->get('TestUntil\Controller\Pais');

        $abstract = $this->getMockBuilder('TestUntil\Factory\PaisFactory')
        ->disableOriginalConstructor()
        ->getMock();

        $paisController->setPaisFactory($abstract);
    }
    // abrir tela de criar nova entidade.
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('create');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/create');
    }
    // enviar submit de tela de nova entidade sem nenhum dados e receber Redirect.
    public function testWhenCreateDisplaySuccessfulWithRedirect()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/criar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/test-until/pais/criar');
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('create');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/create');
    }

    // enviar submit de tela de nova entidade sem nenhum dados com mock do redirect e receber validação.
    public function testWhenCreateDisplaySuccessfulWithPRGReturnValidation()
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/test-until/pais/criar', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('create');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/create');
    }

    // enviar submit da tela com dados completo, ser adicionado o elemento e redirecionado para página de editar com sucesso = 1.
    public function testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit()
    {
        $newData = array(
        	'nome' => 'Novo País Lindão'
        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($newData);
        $this->dispatch('/test-until/pais/criar', 'POST', $newData);
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('create');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/create');


        $entity =  $this->bootstrap->getEntityManager()->getRepository('TestUntil\Entity\Pais')->findOneBy($newData);

        $this->assertRedirectTo(sprintf('/test-until/pais/editar/%d/1', $entity->getIdPais()));

        return $entity;
    }




    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/editar');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/test-until/pais/listar/page//orderBy');
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('edit');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/edit');
    }

    public function testWhenEditRedirectWithInvalidIdToListing()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/editar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/test-until/pais/listar/page//orderBy');
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('edit');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListDisplaySuccessfulWithValidId($entity)
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/editar/'.$entity->getIdPais());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('edit');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidId($entity)
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/editar/'.$entity->getIdPais(), 'POST');
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/test-until/pais/editar/'.$entity->getIdPais());
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('edit');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation($entity)
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/test-until/pais/editar/'.$entity->getIdPais(), 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('edit');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnEdit($entity)
    {

        $data = array(
        	'nome' => 'editar Nome Pais'
        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($data);
        $this->dispatch('/test-until/pais/editar/'.$entity->getIdPais(), 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('edit');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/edit');

        $this->assertRedirectTo(sprintf('/test-until/pais/editar/%d/1', $entity->getIdPais()));
    }

    //acessa página de editar sem ID.

    //acessa página de editar com uma ID ainda inexistente no banco.

    //acessa a página de editar com uma ID válida.

    //acessa a página de editar com uma ID válida e da submit, recebe response com redirect.

    //acessar página de editar com uma id válida e dar submit com mock do prg e ver dados editados com sucesso.

    //acessar página de editar com uma id válida inserir dados novos e dar submit com mock do prg e ver dados editados com sucesso.

    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('list');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/list');
    }


    public function testWhenFilterWithoutData()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/listar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/test-until/pais/listar/page//orderBy');
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('list');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/list');
    }


    public function testWhenFilterWithoutDataWithPRG()
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/test-until/pais/listar', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('list');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/list');
    }


    //acessar página sem nenhum parámetro.

    //acessar página com filtragem por like.

    //acessar página com filtragem por ordenação

    //acessar página com paginação.

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testDeleteSucessfullAndRedirectToListWithSucesss($entity)
    {
        $this->mockIdentity();
        $this->dispatch(sprintf('/test-until/pais/excluir/%d', $entity->getIdPais()));
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/test-until/pais/listar/page//orderBy/1');
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('delete');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/delete');
    }

    public function testDeleteSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/excluir/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUntil');
        $this->assertRedirectTo('/test-until/pais/listar/page//orderBy/0');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('delete');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/delete');
    }

    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('delete');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/delete');
    }

    //acessar página de excluir sem ID

    //acessar página de excluir com uma ID inválida.

    //acessar página de excluir com uma id verdadeira, ser excluído e ver URL de confirmação sucesso = 1.

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-until/pais/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUntil');
        $this->assertControllerName('TestUntil\Controller\Pais');
        $this->assertActionName('view');
        $this->assertControllerClass('PaisController');
        $this->assertMatchedRouteName('test-until/pais/view');
    }
}
