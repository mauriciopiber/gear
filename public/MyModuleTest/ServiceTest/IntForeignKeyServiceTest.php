<?php
namespace MyModuleTest\ServiceTest;

use GearBaseTest\AbstractTestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group MyModule
 * @group IntForeignKeyService
 * @group Service
 */
class IntForeignKeyServiceTest extends AbstractTestCase
{
    protected $intForeignKeyServi;

    public function setUp()
    {
        parent::setUp();
        $this->cache = $this->prophesize('Zend\Cache\Storage\Adapter\Memcached');
    }

    public function getIntForeignKeyService()
    {
        if (!isset($this->intForeignKeyServi)) {
            $this->intForeignKeyServi =
                $this->bootstrap->getServiceLocator()->get(
                    'MyModule\Service\IntForeignKeyService'
                );
        }
        return $this->intForeignKeyServi;
    }

    /**
     * @group MyModule
     * @group IntForeignKeyService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getIntForeignKeyService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group MyModule
     * @group IntForeignKeyService
    */
    public function testCallUsingServiceLocator()
    {
        $intForeignKeyServi = $this->getIntForeignKeyService();
        $this->assertInstanceOf('MyModule\Service\IntForeignKeyService', $intForeignKeyServi);
    }
    /**
     * @group IntForeignKeyService
     */
    public function testSetIntForeignKeyRepository()
    {
        $mock = $this->prophesize('MyModule\Repository\IntForeignKeyRepository')->reveal();

        $this->getIntForeignKeyService()->setIntForeignKeyRepository($mock);

        $this->assertInstanceOf(
            'MyModule\Repository\IntForeignKeyRepository',
            $this->getIntForeignKeyService()->getIntForeignKeyRepository()
        );
    }

    /**
     * @group IntForeignKeyService
     */
    public function testGetIntForeignKeyRepository()
    {
        $intForeignKeyServ = $this->getIntForeignKeyService();
        $intForeignKey = $intForeignKeyServ->getIntForeignKeyRepository();
        $this->assertInstanceOf('MyModule\Repository\IntForeignKeyRepository', $intForeignKey);

    }


    public function testSetSelectAllCache()
    {
        //$this->mockIdentity();

        $this->getIntForeignKeyService()->setSessionName('testing');

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem('testingResult')) {
            $cache->removeItem('testingResult');
        }

        $data = $this->getIntForeignKeyService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
        $data = $this->getIntForeignKeyService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
    }

    public function testSelectAllCacheWithCache()
    {
        //$this->mockIdentity();

        $this->getIntForeignKeyService()->setRouteMatch($this->getRouteMatch(1, 'depName', 'DESC'));

        $this->assertEquals('depName', $this->getIntForeignKeyService()->getOrderBy());
        $this->assertEquals('DESC', $this->getIntForeignKeyService()->getOrder());

        $this->getIntForeignKeyService()->selectAll();

        $this->getIntForeignKeyService()->setRouteMatch($this->getRouteMatch(1, 'depName', 'ASC'));

        $this->assertEquals('depName', $this->getIntForeignKeyService()->getOrderBy());
        $this->assertEquals('ASC', $this->getIntForeignKeyService()->getOrder());

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem($this->getIntForeignKeyService()->getSessionName())) {
            $cache->removeItem($this->getIntForeignKeyService()->getSessionName());
        }

        $this->getIntForeignKeyService()->setRouteMatch(
            $this->getRouteMatch(1, 'idIntForeignKey', 'DESC')
        );

        $this->assertEquals(
            'idIntForeignKey',
            $this->getIntForeignKeyService()->getOrderBy()
        );
        $this->assertEquals('DESC', $this->getIntForeignKeyService()->getOrder());
    }

    public function testGetMappingInfo()
    {
        $intForeignKeyServi = $this->getIntForeignKeyService();
        $resultSet = $intForeignKeyServi->getTableHead();
        $this->assertTrue(is_array($resultSet));
    }

    public function testSelectById()
    {
        $intForeignKeyServi = $this->getIntForeignKeyService();

        $resultSet = $intForeignKeyServi->selectById(1);
        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);
        $this->assertEquals(1, $resultSet->getIdIntForeignKey());
    }

    public function testSelectOneByIdIntForeignKey()
    {
        $resultSet = $this->getIntForeignKeyService()->selectOneBy(
            array(
                'idIntForeignKey' =>
                    15
            )
        );
        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);
        $this->assertEquals(
            15,
            $resultSet->getIdIntForeignKey()
        );
    }

    /**
     * @group Service.Create
     */
    public function testCreate()
    {
        $entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        $entity->getIdIntForeignKey()->willReturn(31);

        $data = array(
            'depName' => 'insert76 Dep Name',
        );

        $this->repository = $this->prophesize('MyModule\Repository\IntForeignKeyRepository');
        $this->repository->insert($data)->willReturn($entity)->shouldBeCalled();

        $this->getIntForeignKeyService()->setIntForeignKeyRepository($this->repository->reveal());

        $resultSet = $this->getIntForeignKeyService()->create($data);

        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);
        $this->assertEquals(31, $resultSet->getIdIntForeignKey());

        return $resultSet;
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($entityToUpdate)
    {
        $entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        $entity->getIdIntForeignKey()->willReturn(31);

        $data = array(
            'depName' => 'insert60 Dep Name',
        );

        $this->repository = $this->prophesize('MyModule\Repository\IntForeignKeyRepository');
        $this->repository->update(31, $data)->willReturn($entity)->shouldBeCalled();

        $this->getIntForeignKeyService()->setIntForeignKeyRepository($this->repository->reveal());

        $this->getIntForeignKeyService()->setCache($this->cache->reveal());

        $resultSet = $this->getIntForeignKeyService()
            ->update(31, $data);


        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $resultSet);
        $this->assertEquals(31, $resultSet->getIdIntForeignKey());

        return $resultSet;
    }

    /**
     * @group force1
     */
    public function testDelete()
    {
        $entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        $entity->getIdIntForeignKey()->willReturn(31);

        $this->repository = $this->prophesize('MyModule\Repository\IntForeignKeyRepository');
        $this->repository->selectById(31)->willReturn($entity->reveal())->shouldBeCalled();
        $this->repository->deleteSafe($entity->reveal())->willReturn(true)->shouldBeCalled();

        $this->getIntForeignKeyService()->setCache($this->cache->reveal());
        $this->getIntForeignKeyService()->setIntForeignKeyRepository($this->repository->reveal());

        $intForeignKeyServi = $this->getIntForeignKeyService();

        $resultSet = $intForeignKeyServi->delete(31);
        $this->assertTrue($resultSet);
    }

    public function testDeleteWithoutExistingData()
    {

        $this->repository = $this->prophesize('MyModule\Repository\IntForeignKeyRepository');
        $this->repository->selectById(31)->willReturn(false)->shouldBeCalled();

        $this->getIntForeignKeyService()->setIntForeignKeyRepository($this->repository->reveal());

        $intForeignKeyServi = $this->getIntForeignKeyService();

        $resultSet = $intForeignKeyServi->delete(31);
        $this->assertFalse($resultSet['success'***REMOVED***);
        $this->assertEquals('EntityNotFound', $resultSet['error'***REMOVED***);
    }

    public function testExtract()
    {
        $entity = $this->prophesize('MyModule\Entity\IntForeignKey');
        $entity->getIdIntForeignKey()->willReturn(31);

        $data = ['intForeignKey' => 31***REMOVED***;
        $this->repository = $this->prophesize('MyModule\Repository\IntForeignKeyRepository');
        $this->repository->extract($entity)->willReturn($data)->shouldBeCalled();


        $this->getIntForeignKeyService()->setIntForeignKeyRepository($this->repository->reveal());

        $intForeignKeyServi = $this->getIntForeignKeyService();

        $resultSet = $intForeignKeyServi->extract($entity->reveal());
        $this->assertEquals($data, $resultSet);

    }

    public function getRouteMatch($page, $orderBy = 'idIntForeignKey', $order = 'DESC')
    {
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'MyModule\Controller\IntForeignKey',
            'action'     => 'list',
            'page' => $page,
            'orderBy' => $orderBy,
            'order' => $order
        ));

        $routeMatch->setMatchedRouteName('my-module/int-foreign-key');
        return $routeMatch;
    }
}
