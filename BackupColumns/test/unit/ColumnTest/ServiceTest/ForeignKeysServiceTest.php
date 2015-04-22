<?php
namespace Column\ColumnTest\ServiceTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Service
 */
class ForeignKeysServiceTest extends \ColumnTest\AbstractTest
{
    protected $foreignKeysService;

    public function getForeignKeysService()
    {
        if (!isset($this->foreignKeysService)) {
            $this->foreignKeysService =
                $this->bootstrap->getServiceLocator()->get(
                    'Column\Service\ForeignKeysService'
                );
        }
        return $this->foreignKeysService;
    }

    /**
     * @group Column
     * @group ForeignKeysService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getForeignKeysService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Column
     * @group ForeignKeysService
    */
    public function testCallUsingServiceLocator()
    {
        $foreignKeysService = $this->getForeignKeysService();
        $this->assertInstanceOf('Column\Service\ForeignKeysService', $foreignKeysService);
    }
    /**
     * @group ForeignKeysService     */
    public function testSetForeignKeysRepository()
    {
        $mock = $this->getMockBuilder('Column\Repository\ForeignKeysRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $foreignKeysService = $this->getForeignKeysService();
        $foreignKeysService->setForeignKeysRepository($mock);
        $this->assertInstanceOf('Column\Repository\ForeignKeysRepository', $mock);
        return $this;
    }

    /**
     * @group ForeignKeysService     */
    public function testGetForeignKeysRepository()
    {
        $foreignKeysService = $this->getForeignKeysService();
        $foreignKeysReposi = $foreignKeysService->getForeignKeysRepository();
        $this->assertInstanceOf('Column\Repository\ForeignKeysRepository', $foreignKeysReposi);

    }


    public function testSetSelectAllCache()
    {
        $this->mockIdentity();

        $this->getForeignKeysService()->setSessionName('testing');

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem('testingResult')) {
            $cache->removeItem('testingResult');
        }

        $data = $this->getForeignKeysService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
        $data = $this->getForeignKeysService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
    }

    public function testSelectAllCacheWithCache()
    {
        $this->mockIdentity();

        $this->getForeignKeysService()->setRouteMatch($this->getRouteMatch(1, 'name', 'DESC'));

        $this->assertEquals('name', $this->getForeignKeysService()->getOrderBy());
        $this->assertEquals('DESC', $this->getForeignKeysService()->getOrder());

        $resultSet = $this->getForeignKeysService()->selectAll();
        $resultSet = $this->getForeignKeysService()->selectAll();

        $this->getForeignKeysService()->setRouteMatch($this->getRouteMatch(1, 'name', 'ASC'));

        $this->assertEquals('name', $this->getForeignKeysService()->getOrderBy());
        $this->assertEquals('ASC', $this->getForeignKeysService()->getOrder());

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem($this->getForeignKeysService()->getSessionName())) {
            $cache->removeItem($this->getForeignKeysService()->getSessionName());
        }

        $this->getForeignKeysService()->setRouteMatch($this->getRouteMatch(1, 'idForeignKeys', 'DESC'));
        $this->assertEquals('idForeignKeys', $this->getForeignKeysService()->getOrderBy());
        $this->assertEquals('DESC', $this->getForeignKeysService()->getOrder());
    }

    public function testSelectById()
    {
        $foreignKeysService = $this->getForeignKeysService();

        $resultSet = $foreignKeysService->selectById(1);
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);
        $this->assertEquals(1, $resultSet->getIdForeignKeys());
    }

    
    public function testSelectOneByIdForeignKeys()
    {
        $resultSet = $this->getForeignKeysService()->selectOneBy(array('idForeignKeys' => 15));
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);
        $this->assertEquals(15, $resultSet->getIdForeignKeys());
    }
    public function testSelectOneByName()
    {
        $resultSet = $this->getForeignKeysService()->selectOneBy(array('name' => '15Name'));
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);
        $this->assertEquals('15Name', $resultSet->getName());
    }
    /**
     * @group Service.Create
     */
    public function testCreate()
    {
        $this->mockIdentity();
        $data = array(
            'name' => 'insert Name',        );
        $resultSet = $this->getForeignKeysService()->create($data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
            $this->assertEquals('insert Name', $resultSet->getName());        return $resultSet;
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'name' => 'update Name',        );
        $resultSet = $this->getForeignKeysService()->update($entityToUpdate->getIdForeignKeys(), $data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));
            $this->assertEquals('update Name', $resultSet->getName());        return $resultSet;
    }

    /**
     * @depends testUpdate
     */
    public function testDelete($entityToDelete)
    {

        $foreignKeysService = $this->getForeignKeysService();

        $resultSet = $foreignKeysService->delete($entityToDelete->getIdForeignKeys());
        $this->assertTrue($resultSet);
    }

    public function getRouteMatch($page, $orderBy = 'idForeignKeys', $order = 'DESC')
    {
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'Column\Controller\ForeignKeys',
            'action'     => 'list',
            'page' => $page,
            'orderBy' => $orderBy,
            'order' => $order
        ));

        $routeMatch->setMatchedRouteName('column/foreign-keys');
        return $routeMatch;
    }
}
