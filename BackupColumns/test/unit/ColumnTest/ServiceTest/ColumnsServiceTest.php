<?php
namespace Column\ColumnTest\ServiceTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Service
 */
class ColumnsServiceTest extends \ColumnTest\AbstractTest
{
    protected $columnsService;

    public function getColumnsService()
    {
        if (!isset($this->columnsService)) {
            $this->columnsService =
                $this->bootstrap->getServiceLocator()->get(
                    'Column\Service\ColumnsService'
                );
        }
        return $this->columnsService;
    }

    /**
     * @group Column
     * @group ColumnsService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getColumnsService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Column
     * @group ColumnsService
    */
    public function testCallUsingServiceLocator()
    {
        $columnsService = $this->getColumnsService();
        $this->assertInstanceOf('Column\Service\ColumnsService', $columnsService);
    }
    /**
     * @group ColumnsService     */
    public function testSetColumnsRepository()
    {
        $mock = $this->getMockBuilder('Column\Repository\ColumnsRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $columnsService = $this->getColumnsService();
        $columnsService->setColumnsRepository($mock);
        $this->assertInstanceOf('Column\Repository\ColumnsRepository', $mock);
        return $this;
    }

    /**
     * @group ColumnsService     */
    public function testGetColumnsRepository()
    {
        $columnsService = $this->getColumnsService();
        $columnsRepository = $columnsService->getColumnsRepository();
        $this->assertInstanceOf('Column\Repository\ColumnsRepository', $columnsRepository);

    }


    public function mockUploadImage()
    {
        $maker = new \GearBaseTest\UploadImageMock();
        return $maker->mockUploadFile(\Column\Module::getLocation());
    }

    public function testSetSelectAllCache()
    {
        $this->mockIdentity();

        $this->getColumnsService()->setSessionName('testing');

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem('testingResult')) {
            $cache->removeItem('testingResult');
        }

        $data = $this->getColumnsService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
        $data = $this->getColumnsService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
    }

    public function testSelectAllCacheWithCache()
    {
        $this->mockIdentity();

        $this->getColumnsService()->setRouteMatch($this->getRouteMatch(1, 'columnVarchar', 'DESC'));

        $this->assertEquals('columnVarchar', $this->getColumnsService()->getOrderBy());
        $this->assertEquals('DESC', $this->getColumnsService()->getOrder());

        $resultSet = $this->getColumnsService()->selectAll();
        $resultSet = $this->getColumnsService()->selectAll();

        $this->getColumnsService()->setRouteMatch($this->getRouteMatch(1, 'columnVarchar', 'ASC'));

        $this->assertEquals('columnVarchar', $this->getColumnsService()->getOrderBy());
        $this->assertEquals('ASC', $this->getColumnsService()->getOrder());

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem($this->getColumnsService()->getSessionName())) {
            $cache->removeItem($this->getColumnsService()->getSessionName());
        }

        $this->getColumnsService()->setRouteMatch($this->getRouteMatch(1, 'idColumns', 'DESC'));
        $this->assertEquals('idColumns', $this->getColumnsService()->getOrderBy());
        $this->assertEquals('DESC', $this->getColumnsService()->getOrder());
    }

    public function testSelectById()
    {
        $columnsService = $this->getColumnsService();

        $resultSet = $columnsService->selectById(1);
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals(1, $resultSet->getIdColumns());
    }

    
    public function testSelectOneByIdColumns()
    {
        $resultSet = $this->getColumnsService()->selectOneBy(array('idColumns' => 15));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals(15, $resultSet->getIdColumns());
    }
    public function testSelectOneByColumnVarchar()
    {
        $resultSet = $this->getColumnsService()->selectOneBy(array('columnVarchar' => '15Column Varchar'));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('15Column Varchar', $resultSet->getColumnVarchar());
    }
    public function testSelectOneByColumnText()
    {
        $resultSet = $this->getColumnsService()->selectOneBy(array('columnText' => '15Column Text'));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('15Column Text', $resultSet->getColumnText());
    }
    public function testSelectOneByColumnVarcharEmail()
    {
        $resultSet = $this->getColumnsService()->selectOneBy(array('columnVarcharEmail' => 'column.varchar.email15@gmail.com'
));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('column.varchar.email15@gmail.com'
, $resultSet->getColumnVarcharEmail());
    }
    public function testSelectOneByColumnVarcharUploadImage()
    {
        $resultSet = $this->getColumnsService()->selectOneBy(array('columnVarcharUploadImage' => '15Column Varchar Upload Image'));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('15Column Varchar Upload Image', $resultSet->getColumnVarcharUploadImage());
    }
    /**
     * @group Service.Create
     */
    public function testCreate()
    {
        $this->mockIdentity();
        $data = array(
            'columnDate' => '2015-04-22',
            'columnDatetime' => '2015-04-22 00:37:39',
            'columnTime' => '00:37:39',
            'columnInt' => 35891,
            'columnTinyint' => 91636,
            'columnDecimal' => 1813.13,
            'columnVarchar' => 'insert Column Varchar',            'columnLongtext' => 'insert Column Longtext',            'columnText' => 'insert Column Text',            'columnDatetimePtBr' => '22/04/2015 00:37:39',
            'columnDatePtBr' => '22/04/2015',
            'columnDecimalPtBr' => 'R$ 1752,52',
            'columnIntCheckbox' => 1,
            'columnTinyintCheckbox' => 1,
            'columnVarcharEmail' => 'insert Column Varchar Email',            'columnVarcharUploadImage' => array(
                'error' => 0,
                'name' => 'columnVarcharUploadImage639354insert.gif',
                'tmp_name' => $this->mockUploadImage(),
                'type'      =>  'image/gif',
                'size'      =>  42,
            ),
            'columnForeignKey' => '5',
        );
        $resultSet = $this->getColumnsService()->create($data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
        $this->assertEquals('2015-04-22', $resultSet->getColumnDate()->format('Y-m-d'));
        $this->assertEquals('2015-04-22 00:37:39', $resultSet->getColumnDatetime()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:37:39', $resultSet->getColumnTime()->format('H:i:s'));
        $this->assertEquals(35891, $resultSet->getColumnInt());
        $this->assertEquals(91636, $resultSet->getColumnTinyint());
        $this->assertEquals(1813.13, $resultSet->getColumnDecimal());
            $this->assertEquals('insert Column Varchar', $resultSet->getColumnVarchar());            $this->assertEquals('insert Column Longtext', $resultSet->getColumnLongtext());            $this->assertEquals('insert Column Text', $resultSet->getColumnText());        $this->assertEquals('2015-04-22 00:37:39', $resultSet->getColumnDatetimePtBr()->format('Y-m-d H:i:s'));
        $this->assertEquals('2015-04-22', $resultSet->getColumnDatePtBr()->format('Y-m-d'));
        $this->assertEquals(1752.52, $resultSet->getColumnDecimalPtBr());
        $this->assertEquals(1, $resultSet->getColumnIntCheckbox());
        $this->assertEquals(1, $resultSet->getColumnTinyintCheckbox());
            $this->assertEquals('insert Column Varchar Email', $resultSet->getColumnVarcharEmail());        $this->assertEquals('/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage639354insert.gif', $resultSet->getColumnVarcharUploadImage());
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/precolumnVarcharUploadImage639354insert.gif');
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/smcolumnVarcharUploadImage639354insert.gif');
        $this->assertFileExists(\GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/xscolumnVarcharUploadImage639354insert.gif');
        $this->assertEquals('5', $resultSet->getColumnForeignKey()->getIdForeignKeys());
        return $resultSet;
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'columnDate' => '2015-05-22',
            'columnDatetime' => '2015-05-22 00:37:39',
            'columnTime' => '00:37:39',
            'columnInt' => 35941,
            'columnTinyint' => 91686,
            'columnDecimal' => 1813.13,
            'columnVarchar' => 'update Column Varchar',            'columnLongtext' => 'update Column Longtext',            'columnText' => 'update Column Text',            'columnDatetimePtBr' => '22/05/2015 00:37:39',
            'columnDatePtBr' => '22/05/2015',
            'columnDecimalPtBr' => 'R$ 1752,52',
            'columnIntCheckbox' => 1,
            'columnTinyintCheckbox' => 1,
            'columnVarcharEmail' => 'update Column Varchar Email',            'columnVarcharUploadImage' => array(
                'error' => 0,
                'name' => 'columnVarcharUploadImage639354update.gif',
                'tmp_name' => $this->mockUploadImage(),
                'type'      =>  'image/gif',
                'size'      =>  42,
            ),
            'columnForeignKey' => '1',
        );
        $resultSet = $this->getColumnsService()->update($entityToUpdate->getIdColumns(), $data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));
        $this->assertEquals('2015-05-22', $resultSet->getColumnDate()->format('Y-m-d'));
        $this->assertEquals('2015-05-22 00:37:39', $resultSet->getColumnDatetime()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:37:39', $resultSet->getColumnTime()->format('H:i:s'));
        $this->assertEquals(35941, $resultSet->getColumnInt());
        $this->assertEquals(91686, $resultSet->getColumnTinyint());
        $this->assertEquals(1813.13, $resultSet->getColumnDecimal());
            $this->assertEquals('update Column Varchar', $resultSet->getColumnVarchar());            $this->assertEquals('update Column Longtext', $resultSet->getColumnLongtext());            $this->assertEquals('update Column Text', $resultSet->getColumnText());        $this->assertEquals('2015-05-22 00:37:39', $resultSet->getColumnDatetimePtBr()->format('Y-m-d H:i:s'));
        $this->assertEquals('2015-05-22', $resultSet->getColumnDatePtBr()->format('Y-m-d'));
        $this->assertEquals(1752.52, $resultSet->getColumnDecimalPtBr());
        $this->assertEquals(1, $resultSet->getColumnIntCheckbox());
        $this->assertEquals(1, $resultSet->getColumnTinyintCheckbox());
            $this->assertEquals('update Column Varchar Email', $resultSet->getColumnVarcharEmail());        $this->assertEquals('/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage639354update.gif', $resultSet->getColumnVarcharUploadImage());
        $this->assertFileExists(
            \GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/precolumnVarcharUploadImage639354update.gif'
        );
        $this->assertFileExists(
            \GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/smcolumnVarcharUploadImage639354update.gif'
        );
        $this->assertFileExists(
            \GearBase\Module::getProjectFolder().'/public/upload/columns-columnVarcharUploadImage/xscolumnVarcharUploadImage639354update.gif'
        );
        $this->assertEquals('1', $resultSet->getColumnForeignKey()->getIdForeignKeys());
        return $resultSet;
    }

    /**
     * @depends testUpdate
     */
    public function testDelete($entityToDelete)
    {

        $columnsService = $this->getColumnsService();

        $resultSet = $columnsService->delete($entityToDelete->getIdColumns());
        $this->assertTrue($resultSet);
    }

    public function getRouteMatch($page, $orderBy = 'idColumns', $order = 'DESC')
    {
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'Column\Controller\Columns',
            'action'     => 'list',
            'page' => $page,
            'orderBy' => $orderBy,
            'order' => $order
        ));

        $routeMatch->setMatchedRouteName('column/columns');
        return $routeMatch;
    }
}
