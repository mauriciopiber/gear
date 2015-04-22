<?php
namespace ColumnTest\ControllerTest;

use ColumnTest\ControllerTest\AbstractControllerTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Column
 * @group ForeignKeys
 * @group Controller
 */
class ForeignKeysControllerTest extends AbstractControllerTest
{

    public function testSetService()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('Column\Controller\ForeignKeys');

        $abstract = $this->getMockBuilder('Column\Service\ForeignKeysService')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setForeignKeysService($abstract);

    }

    public function testSetForm()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('Column\Controller\ForeignKeys');

        $abstract = $this->getMockBuilder('Column\Factory\ForeignKeysFactory')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setForeignKeysFactory($abstract);
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('create');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/create');
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessfulWithRedirect()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/criar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/column/foreign-keys/criar');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('create');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/editar');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/column/foreign-keys/listar/page//orderBy');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('edit');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/edit');
    }

    public function testWhenEditRedirectWithInvalidIdToListing()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/editar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/column/foreign-keys/listar/page//orderBy');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('edit');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/edit');
    }


    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('list');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/list');
    }


    public function testWhenFilterWithoutData()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/listar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/column/foreign-keys/listar/page//orderBy');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('list');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/list');
    }


    public function testWhenFilterWithoutDataWithPRG()
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/column/foreign-keys/listar', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('list');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/list');
    }


    public function testDeleteSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/excluir/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertRedirectTo('/column/foreign-keys/listar/page//orderBy/0');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('delete');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/delete');
    }


    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('delete');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/delete');
    }


    public function testViewSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/visualizar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertRedirectTo('/column/foreign-keys/listar/page//orderBy');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('view');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/view');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('view');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/view');
    }

    /**
     * @group Controller.Create
     */
    // enviar submit da tela com dados completo,
    // ser adicionado o elemento e redirecionado para página de editar com sucesso = 1.
    public function testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit()
    {
        $newData = array(
            'name' => 'insert Name',        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($newData);
        $this->dispatch('/column/foreign-keys/criar', 'POST', $newData);
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('create');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/create');


        $resultSet =  $this->bootstrap
            ->getEntityManager()
            ->getRepository('Column\Entity\ForeignKeys')
            ->findOneBy(
                array(
                    'name' => 'insert Name',                ),
                array('idForeignKeys' => 'DESC')
            );

        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);

        $this->assertRedirectTo(
            sprintf(
                '/column/foreign-keys/editar/%d/1',
                $resultSet->getIdForeignKeys()
            )
        );

            $this->assertEquals('insert Name', $resultSet->getName());
        return $resultSet;
    }

   /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/editar/'.$resultSet->getIdForeignKeys());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('edit');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenViewDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/visualizar/'.$resultSet->getIdForeignKeys());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('view');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/view');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/column/foreign-keys/editar/'.$resultSet->getIdForeignKeys(), 'POST');
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/column/foreign-keys/editar/'.$resultSet->getIdForeignKeys());
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('edit');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnEdit($resultSet)
    {

        $newData = array(
            'name' => 'update Name',        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($newData);
        $this->dispatch('/column/foreign-keys/editar/'.$resultSet->getIdForeignKeys(), 'POST', $newData);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('edit');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/edit');

        $this->assertRedirectTo(
            sprintf(
                '/column/foreign-keys/editar/%d/1',
                $resultSet->getIdForeignKeys()
            )
        );
    }

     /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testDeleteSucessfullAndRedirectToListWithSucesss($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch(sprintf('/column/foreign-keys/excluir/%d', $resultSet->getIdForeignKeys()));
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/column/foreign-keys/listar/page//orderBy/1');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\ForeignKeys');
        $this->assertActionName('delete');
        $this->assertControllerClass('ForeignKeysController');
        $this->assertMatchedRouteName('column/foreign-keys/delete');
    }
}
