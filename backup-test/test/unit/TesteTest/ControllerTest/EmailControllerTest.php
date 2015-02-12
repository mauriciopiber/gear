<?php
namespace TesteTest\ControllerTest;

use TesteTest\ControllerTest\AbstractControllerTest;

/**
 * @group Teste
 * @group Email
 * @group Controller
 */
class EmailControllerTest extends AbstractControllerTest
{

    public function testSetService()
    {
        $controller = $this->bootstrap->getServiceLocator()->get('ControllerManager')->get('Teste\Controller\Email');

        $abstract = $this->getMockBuilder('Teste\Service\EmailService')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setEmailService($abstract);

    }

    public function testSetForm()
    {
        $controller = $this->bootstrap->getServiceLocator()->get('ControllerManager')->get('Teste\Controller\Email');

        $abstract = $this->getMockBuilder('Teste\Factory\EmailFactory')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setEmailFactory($abstract);
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('create');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/create');
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessfulWithRedirect()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/criar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/teste/email/criar');
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('create');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/create');
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessfulWithPRGReturnValidation()
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/teste/email/criar', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('create');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/editar');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/teste/email/listar/page//orderBy');
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('edit');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/edit');
    }

    public function testWhenEditRedirectWithInvalidIdToListing()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/editar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/teste/email/listar/page//orderBy');
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('edit');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/edit');
    }


    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('list');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/list');
    }


    public function testWhenFilterWithoutData()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/listar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/teste/email/listar/page//orderBy');
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('list');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/list');
    }


    public function testWhenFilterWithoutDataWithPRG()
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/teste/email/listar', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('list');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/list');
    }


    public function testDeleteSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/excluir/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Teste');
        $this->assertRedirectTo('/teste/email/listar/page//orderBy/0');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('delete');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/delete');
    }


    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('delete');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/delete');
    }


    public function testViewSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/visualizar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Teste');
        $this->assertRedirectTo('/teste/email/listar/page//orderBy');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('view');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/view');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('view');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/view');
    }

    /**
     * @group Controller.Create
     */
     // enviar submit da tela com dados completo,
     // ser adicionado o elemento e redirecionado para página de editar com sucesso = 1.
    public function testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit()
    {
        $newData = array(
            'remetente' => 'insert Remetente',
            'destino' => 'insert Destino',
            'assunto' => 'insert Assunto',
            'mensagem' => 'insert Mensagem',
        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($newData);
        $this->dispatch('/teste/email/criar', 'POST', $newData);
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('create');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/create');


        $resultSet =  $this->bootstrap->getEntityManager()->getRepository('Teste\Entity\Email')->findOneBy(array(
            'remetente' => 'insert Remetente',
            'destino' => 'insert Destino',
            'assunto' => 'insert Assunto',
            'mensagem' => 'insert Mensagem',
        ), array('idEmail' => 'DESC'));

        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);

        $this->assertRedirectTo(sprintf('/teste/email/editar/%d/1', $resultSet->getIdEmail()));

        $this->assertEquals('insert Remetente', $resultSet->getRemetente());
        $this->assertEquals('insert Destino', $resultSet->getDestino());
        $this->assertEquals('insert Assunto', $resultSet->getAssunto());
        $this->assertEquals('insert Mensagem', $resultSet->getMensagem());

        return $resultSet;
    }

   /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/editar/'.$resultSet->getIdEmail());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('edit');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenViewDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/visualizar/'.$resultSet->getIdEmail());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('view');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/view');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/teste/email/editar/'.$resultSet->getIdEmail(), 'POST');
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/teste/email/editar/'.$resultSet->getIdEmail());
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('edit');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnValidation($resultSet)
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/teste/email/editar/'.$resultSet->getIdEmail(), 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('edit');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnEdit($resultSet)
    {

        $data = array(
            'remetente' => 'update Remetente',
            'destino' => 'update Destino',
            'assunto' => 'update Assunto',
            'mensagem' => 'update Mensagem',
        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($data);
        $this->dispatch('/teste/email/editar/'.$resultSet->getIdEmail(), 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('edit');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/edit');

        $this->assertRedirectTo(sprintf('/teste/email/editar/%d/1', $resultSet->getIdEmail()));
    }

     /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testDeleteSucessfullAndRedirectToListWithSucesss($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch(sprintf('/teste/email/excluir/%d', $resultSet->getIdEmail()));
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/teste/email/listar/page//orderBy/1');
        $this->assertModuleName('Teste');
        $this->assertControllerName('Teste\Controller\Email');
        $this->assertActionName('delete');
        $this->assertControllerClass('EmailController');
        $this->assertMatchedRouteName('teste/email/delete');
    }
}
