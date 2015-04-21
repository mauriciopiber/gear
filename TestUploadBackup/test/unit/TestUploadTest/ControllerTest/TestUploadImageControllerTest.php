<?php
namespace TestUploadTest\ControllerTest;

use TestUploadTest\ControllerTest\AbstractControllerTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group TestUpload
 * @group TestUploadImage
 * @group Controller
 */
class TestUploadImageControllerTest extends AbstractControllerTest
{

    public function testSetService()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('TestUpload\Controller\TestUploadImage');

        $abstract = $this->getMockBuilder('TestUpload\Service\TestUploadImageService')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setTestUploadImageService($abstract);

    }

    public function testSetForm()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('TestUpload\Controller\TestUploadImage');

        $abstract = $this->getMockBuilder('TestUpload\Factory\TestUploadImageFactory')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setTestUploadImageFactory($abstract);
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('create');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/create');
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessfulWithRedirect()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/criar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/test-upload/test-upload-image/criar');
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('create');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/editar');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/test-upload/test-upload-image/listar/page//orderBy');
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('edit');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/edit');
    }

    public function testWhenEditRedirectWithInvalidIdToListing()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/editar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/test-upload/test-upload-image/listar/page//orderBy');
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('edit');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/edit');
    }


    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('list');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/list');
    }


    public function testWhenFilterWithoutData()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/listar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/test-upload/test-upload-image/listar/page//orderBy');
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('list');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/list');
    }


    public function testWhenFilterWithoutDataWithPRG()
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/test-upload/test-upload-image/listar', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('list');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/list');
    }


    public function testDeleteSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/excluir/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUpload');
        $this->assertRedirectTo('/test-upload/test-upload-image/listar/page//orderBy/0');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('delete');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/delete');
    }


    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('delete');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/delete');
    }


    public function testViewSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/visualizar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUpload');
        $this->assertRedirectTo('/test-upload/test-upload-image/listar/page//orderBy');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('view');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/view');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('view');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/view');
    }

    public function mockTestUploadImageFactory()
    {
        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $mockFilter = $this->getMockSingleClass('TestUpload\Filter\TestUploadImageFilter', array('isValid'));
        $mockFilter->expects($this->any())->method('isValid')->willReturn(true);


        $factory = $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')->get('TestUpload\Factory\TestUploadImageFactory');

        $factory->setUseInputFilterDefaults(false);

        $mockFileInput = $this->getMockSingleClass('Zend\InputFilter\FileInput', array('isValid', 'getName'));
        $mockFileInput->expects($this->any())->method('isValid')->willReturn(true);
        $mockFileInput->expects($this->any())->method('getName')->willReturn('image');

        $filter = $factory->getInputFilter()->remove('image')->add($mockFileInput);

        $factory->setInputFilter($filter);

        $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')->setService('TestUpload\Factory\TestUploadImageFactory', $factory);
    }
    /**
     * @group Controller.Delete
     * @group Controller.Create
     */
    // enviar submit da tela com dados completo,
    // ser adicionado o elemento e redirecionado para página de editar com sucesso = 1.
    public function testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit()
    {
        $newData = array(
            'image' => array(
                'error' => 0,
                'name' => 'image.jpg',
                'tmp_name' => $this->maker(),
                'type'      =>  'image/jpeg',
                'size'      =>  42,
            ),

        );
        $this->mockIdentity();
        $this->mockPluginFilePostRedirectGet($newData);
        $this->mockTestUploadImageFactory();

        $this->dispatch('/test-upload/test-upload-image/criar', 'POST', $newData);
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('create');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/create');


        $resultSet =  $this->bootstrap
            ->getEntityManager()
            ->getRepository('TestUpload\Entity\TestUploadImage')
            ->findOneBy(
                array(
                    'image' => '/public/upload/test-upload-image-image/%simage.jpg',
                ),
                array('idTestUploadImage' => 'DESC')
            );

        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);

        $this->assertRedirectTo(
            sprintf(
                '/test-upload/test-upload-image/editar/%d/1',
                $resultSet->getIdTestUploadImage()
            )
        );

        $this->assertEquals('/public/upload/test-upload-image-image/%simage.jpg', $resultSet->getImage());

        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/test-upload-image-image/preimage.jpg');
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/test-upload-image-image/smimage.jpg');
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/test-upload-image-image/xsimage.jpg');

        return $resultSet;
    }

    /**
     * @group maker
     */
    public function testMaker()
    {

        $test = $this->maker();

        $this->assertFileExists($test);

    }


    public function maker()
    {
        $maker = new \GearBaseTest\UploadImageMock();
        return $maker->mockUploadFile(\TestUpload\Module::getLocation());
    }

   /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/editar/'.$resultSet->getIdTestUploadImage());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('edit');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenViewDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/visualizar/'.$resultSet->getIdTestUploadImage());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('view');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/view');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/test-upload/test-upload-image/editar/'.$resultSet->getIdTestUploadImage(), 'POST');
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/test-upload/test-upload-image/editar/'.$resultSet->getIdTestUploadImage());
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('edit');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/edit');
    }

    /**
     *
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnEdit($resultSet)
    {

        $newData = array(
            'image' => array(
                'error' => 0,
                'name' => 'image.jpg',
                'tmp_name' => $this->maker(),
                'type'      =>  'image/jpeg',
                'size'      =>  42,
            ),
        );
        $this->mockIdentity();
        $this->mockPluginFilePostRedirectGet($newData);
        $this->mockTestUploadImageFactory();
        $this->dispatch('/test-upload/test-upload-image/editar/'.$resultSet->getIdTestUploadImage(), 'POST', $newData);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('edit');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/edit');

        $this->assertRedirectTo(
            sprintf(
                '/test-upload/test-upload-image/editar/%d/1',
                $resultSet->getIdTestUploadImage()
            )
        );
    }

     /**
     * @group Controller.Delete
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testDeleteSucessfullAndRedirectToListWithSucesss($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch(sprintf('/test-upload/test-upload-image/excluir/%d', $resultSet->getIdTestUploadImage()));
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/test-upload/test-upload-image/listar/page//orderBy/1');
        $this->assertModuleName('TestUpload');
        $this->assertControllerName('TestUpload\Controller\TestUploadImage');
        $this->assertActionName('delete');
        $this->assertControllerClass('TestUploadImageController');
        $this->assertMatchedRouteName('test-upload/test-upload-image/delete');
    }
}
