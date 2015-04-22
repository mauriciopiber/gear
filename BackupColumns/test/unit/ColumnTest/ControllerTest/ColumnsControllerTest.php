<?php
namespace ColumnTest\ControllerTest;

use ColumnTest\ControllerTest\AbstractControllerTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Column
 * @group Columns
 * @group Controller
 */
class ColumnsControllerTest extends AbstractControllerTest
{

    public function mockUploadImage()
    {
        $maker = new \GearBaseTest\UploadImageMock();
        return $maker->mockUploadFile(\Column\Module::getLocation());
    }

    public function mockTestUploadImageFactory()
    {
        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $mockFilter = $this->getMockSingleClass('Column\Filter\ColumnsFilter', array('isValid'));
        $mockFilter->expects($this->any())->method('isValid')->willReturn(true);


        $factory = $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')->get('Column\Factory\ColumnsFactory');

        $factory->setUseInputFilterDefaults(false);

        $mockFileInput = $this->getMockSingleClass('Zend\InputFilter\FileInput', array('isValid', 'getName'));
        $mockFileInput->expects($this->any())->method('isValid')->willReturn(true);
        $mockFileInput->expects($this->any())->method('getName')->willReturn('columnVarcharUploadImage');

        $filter = $factory->getInputFilter()->remove('columnVarcharUploadImage')->add($mockFileInput);

        $factory->setInputFilter($filter);

        $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')->setService('Column\Factory\ColumnsFactory', $factory);
    }
    public function testSetService()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('Column\Controller\Columns');

        $abstract = $this->getMockBuilder('Column\Service\ColumnsService')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setColumnsService($abstract);

    }

    public function testSetForm()
    {
        $controller = $this->bootstrap
          ->getServiceLocator()
          ->get('ControllerManager')
          ->get('Column\Controller\Columns');

        $abstract = $this->getMockBuilder('Column\Factory\ColumnsFactory')
        ->disableOriginalConstructor()
        ->getMock();

        $controller->setColumnsFactory($abstract);
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/criar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('create');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/create');
    }

    /**
     * @group Controller.Create
     */
    public function testWhenCreateDisplaySuccessfulWithRedirect()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/criar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/column/columns/criar');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('create');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/create');
    }

    public function testWhenEditDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/editar');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/column/columns/listar/page//orderBy');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('edit');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/edit');
    }

    public function testWhenEditRedirectWithInvalidIdToListing()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/editar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/column/columns/listar/page//orderBy');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('edit');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/edit');
    }


    public function testWhenListDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/listar');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('list');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/list');
    }


    public function testWhenFilterWithoutData()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/listar', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/column/columns/listar/page//orderBy');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('list');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/list');
    }


    public function testWhenFilterWithoutDataWithPRG()
    {
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet(array());
        $this->dispatch('/column/columns/listar', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('list');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/list');
    }


    public function testDeleteSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/excluir/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertRedirectTo('/column/columns/listar/page//orderBy/0');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('delete');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/delete');
    }


    public function testWhenDeleteDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/excluir');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('delete');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/delete');
    }


    public function testViewSucessfullAndRedirectToListWithFailNotFound()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/visualizar/6000');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertRedirectTo('/column/columns/listar/page//orderBy');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('view');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/view');
    }

    public function testWhenViewDisplaySuccessful()
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/visualizar');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('view');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/view');
    }

    /**
     * @group Controller.Create
     */
    // enviar submit da tela com dados completo,
    // ser adicionado o elemento e redirecionado para página de editar com sucesso = 1.
    public function testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit()
    {
        $newData = array(
            'columnDate' => '2015-04-22',
            'columnDatetime' => '2015-04-22 00:37:40',
            'columnTime' => '00:37:40',
            'columnInt' => 6363,
            'columnTinyint' => 9861,
            'columnDecimal' => 4441.41,
            'columnVarchar' => 'insert Column Varchar',            'columnLongtext' => 'insert Column Longtext',            'columnText' => 'insert Column Text',            'columnDatetimePtBr' => '22/04/2015 00:37:40',
            'columnDatePtBr' => '22/04/2015',
            'columnDecimalPtBr' => 'R$ 3151,51',
            'columnIntCheckbox' => 1,
            'columnTinyintCheckbox' => 1,
            'columnVarcharEmail' => 'mauriciopiber@gmail.com',            'columnVarcharUploadImage' => array(
                'error' => 0,
                'name' => 'columnVarcharUploadImage389153insert.gif',
                'tmp_name' => $this->mockUploadImage(),
                'type'      =>  'image/gif',
                'size'      =>  42,
            ),
            'columnForeignKey' => '11',
        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($newData);
        $this->mockPluginFilePostRedirectGet($newData);
        $this->mockTestUploadImageFactory();
        $this->dispatch('/column/columns/criar', 'POST', $newData);
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('create');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/create');


        $resultSet =  $this->bootstrap
            ->getEntityManager()
            ->getRepository('Column\Entity\Columns')
            ->findOneBy(
                array(
                    'columnDate' => new \DateTime('2015-04-22'),
                    'columnDatetime' => new \DateTime('2015-04-22 00:37:40'),
                    'columnTime' => new \DateTime('00:37:40'),
                    'columnInt' => 6363,
                    'columnTinyint' => 9861,
                    'columnDecimal' => 4441.41,
                    'columnVarchar' => 'insert Column Varchar',                    'columnLongtext' => 'insert Column Longtext',                    'columnText' => 'insert Column Text',                    'columnDatetimePtBr' => new \DateTime('2015-04-22 00:37:40'),
                    'columnDatePtBr' => new \DateTime('2015-04-22'),
                    'columnDecimalPtBr' => 3151.51,
                    'columnIntCheckbox' => 1,
                    'columnTinyintCheckbox' => 1,
                    'columnVarcharEmail' => 'mauriciopiber@gmail.com',                    'columnVarcharUploadImage' => '/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage389153insert.gif',
                    'columnForeignKey' => '11',
                ),
                array('idColumns' => 'DESC')
            );

        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);

        $this->assertRedirectTo(
            sprintf(
                '/column/columns/editar/%d/1',
                $resultSet->getIdColumns()
            )
        );

        $this->assertEquals('2015-04-22', $resultSet->getColumnDate()->format('Y-m-d'));
        $this->assertEquals('2015-04-22 00:37:40', $resultSet->getColumnDatetime()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:37:40', $resultSet->getColumnTime()->format('H:i:s'));
        $this->assertEquals(6363, $resultSet->getColumnInt());
        $this->assertEquals(9861, $resultSet->getColumnTinyint());
        $this->assertEquals(4441.41, $resultSet->getColumnDecimal());
            $this->assertEquals('insert Column Varchar', $resultSet->getColumnVarchar());            $this->assertEquals('insert Column Longtext', $resultSet->getColumnLongtext());            $this->assertEquals('insert Column Text', $resultSet->getColumnText());        $this->assertEquals('2015-04-22 00:37:40', $resultSet->getColumnDatetimePtBr()->format('Y-m-d H:i:s'));
        $this->assertEquals('2015-04-22', $resultSet->getColumnDatePtBr()->format('Y-m-d'));
        $this->assertEquals(3151.51, $resultSet->getColumnDecimalPtBr());
        $this->assertEquals(1, $resultSet->getColumnIntCheckbox());
        $this->assertEquals(1, $resultSet->getColumnTinyintCheckbox());
            $this->assertEquals('mauriciopiber@gmail.com', $resultSet->getColumnVarcharEmail());        $this->assertEquals('/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage389153insert.gif', $resultSet->getColumnVarcharUploadImage());
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/precolumnVarcharUploadImage389153insert.gif');
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/smcolumnVarcharUploadImage389153insert.gif');
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/xscolumnVarcharUploadImage389153insert.gif');
        $this->assertEquals('11', $resultSet->getColumnForeignKey()->getIdForeignKeys());

        return $resultSet;
    }

   /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/editar/'.$resultSet->getIdColumns());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('edit');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenViewDisplaySuccessfulWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/visualizar/'.$resultSet->getIdColumns());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('view');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/view');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidId($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch('/column/columns/editar/'.$resultSet->getIdColumns(), 'POST');
        $this->assertResponseStatusCode(303);
        $this->assertRedirectTo('/column/columns/editar/'.$resultSet->getIdColumns());
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('edit');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/edit');
    }

    /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testWhenListRedirectSuccessfulPRGWithValidIdReturnEdit($resultSet)
    {

        $newData = array(
            'columnDate' => '2015-05-22',
            'columnDatetime' => '2015-05-22 00:37:40',
            'columnTime' => '00:37:40',
            'columnInt' => 6413,
            'columnTinyint' => 9911,
            'columnDecimal' => 4441.41,
            'columnVarchar' => 'update Column Varchar',            'columnLongtext' => 'update Column Longtext',            'columnText' => 'update Column Text',            'columnDatetimePtBr' => '22/05/2015 00:37:40',
            'columnDatePtBr' => '22/05/2015',
            'columnDecimalPtBr' => 'R$ 3151,51',
            'columnIntCheckbox' => 1,
            'columnTinyintCheckbox' => 1,
            'columnVarcharEmail' => 'mauriciopiber@gmail.com',            'columnVarcharUploadImage' => array(
                'error' => 0,
                'name' => 'columnVarcharUploadImage389153update.gif',
                'tmp_name' => $this->mockUploadImage(),
                'type'      =>  'image/gif',
                'size'      =>  42,
            ),
            'columnForeignKey' => '21',
        );
        $this->mockIdentity();
        $this->mockPluginPostRedirectGet($newData);
        $this->mockPluginFilePostRedirectGet($newData);
        $this->mockTestUploadImageFactory();
        $this->dispatch('/column/columns/editar/'.$resultSet->getIdColumns(), 'POST', $newData);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('edit');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/edit');

        $this->assertRedirectTo(
            sprintf(
                '/column/columns/editar/%d/1',
                $resultSet->getIdColumns()
            )
        );
    }

     /**
     * @depends testWhenCreateDisplaySuccessfulWithPRGRedirectToEdit
     */
    public function testDeleteSucessfullAndRedirectToListWithSucesss($resultSet)
    {
        $this->mockIdentity();
        $this->dispatch(sprintf('/column/columns/excluir/%d', $resultSet->getIdColumns()));
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/column/columns/listar/page//orderBy/1');
        $this->assertModuleName('Column');
        $this->assertControllerName('Column\Controller\Columns');
        $this->assertActionName('delete');
        $this->assertControllerClass('ColumnsController');
        $this->assertMatchedRouteName('column/columns/delete');
    }
}
