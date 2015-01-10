<?php
namespace TestUntil\TestUntilTest\ServiceTest;

class PaisServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $paisService;

    protected function setUp()
    {
        $this->bootstrap = new \TestUntil\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function mockIdentity()
    {
        $this->bootstrap
        ->getServiceManager()
        ->setAllowOverride(true);

        $zfcUserMock =  $this->bootstrap->getEntityManager()->getRepository('Security\Entity\User')->findOneBy(array('idUser' => 1));

        $authMock = $this->getMock('ZfcUser\Controller\Plugin\ZfcUserAuthentication');

        $autenticationService = $this->getMock('Zend\Authentication\AuthenticationService');
        $autenticationService->expects($this->any())
        ->method('resetAdapter')
        ->will($this->returnValue(true));

        $autenticationService->expects($this->any())
        ->method('logoutAdapters')
        ->will($this->returnValue(true));


        $autenticationService->expects($this->any())
        ->method('getIdentity')
        ->will($this->returnValue($zfcUserMock));

        $authAdapterMock = $this->getMock('ZfcUser\Authentication\Adapter\AdapterChain');

        $authAdapterMock->expects($this->any())
        ->method('clearIdentity')
        ->will($this->returnValue(true));

        $authMock->expects($this->any())
        ->method('hasIdentity')
        -> will($this->returnValue(true));

        $authMock->expects($this->any())
        ->method('getIdentity')
        ->will($this->returnValue($zfcUserMock));

        $authMock->expects($this->any())
        ->method('getAuthAdapter')
        ->will($this->returnValue($authAdapterMock));

        $authMock->expects($this->any())
        ->method('getAuthService')
        ->will($this->returnValue($autenticationService));

        $this->bootstrap
        ->getServiceManager()
        ->get('ControllerPluginManager')->setService('zfcUserAuthentication', $authMock);

        $this->bootstrap
        ->getServiceManager()
        ->get('ServiceManager')->setService('zfcuser_auth_service', $autenticationService);

        /*   // Creating mock
         $mockBjy = $this->getMock('BjyAuthorize\Service\Authorize', array(
             'isAllowed'
         ), array(
             $this->getApplicationConfig(),
             $this->bootstrap
             ->getServiceManager()
         ));

        // Bypass auth, force true
        $mockBjy->expects($this->any())
        ->method('isAllowed')
        ->will($this->returnValue(true));

        // Overriding BjyAuthorize\Service\Authorize service
        $this->bootstrap
        ->getServiceManager()
        ->setService('BjyAuthorize\Service\Authorize', $mockBjy); */
    }


    public function getPaisService()
    {
        if (!isset($this->paisService)) {
            $this->paisService =
                $this->bootstrap->getServiceLocator()->get(
                    'TestUntil\Service\PaisService'
                );
        }
        return $this->paisService;
    }

    /**
     * @group TestUntil
     * @group PaisService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPaisService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group TestUntil
     * @group PaisService
    */
    public function testCallUsingServiceLocator()
    {
        $paisService = $this->getPaisService();
        $this->assertInstanceOf('TestUntil\Service\PaisService', $paisService);
    }

    /**
     * @group PaisService     */
    public function testSetPaisRepository()
    {
        $mock = $this->getMockBuilder('TestUntil\Repository\PaisRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $paisService = $this->getPaisService();
        $paisService->setPaisRepository($mock);
        $this->assertInstanceOf('TestUntil\Repository\PaisRepository', $mock);
        return $this;
    }

    /**
     * @group PaisService     */
    public function testGetPaisRepository()
    {
        $paisService = $this->getPaisService();
        $paisRepository = $paisService->getPaisRepository();
        $this->assertInstanceOf('TestUntil\Repository\PaisRepository', $paisRepository);

    }

    public function testSelectAll()
    {
        $paisService = $this->getPaisService();


        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'TestUntil\Controller\Pais',
            'action'     => 'list'
        ));

        $routeMatch->setMatchedRouteName('test-until/pais');

        $paisService->setRouteMatch($routeMatch);

        $resultSet = $paisService->selectAll();

        $this->assertTrue(is_array($resultSet));

    }

    public function testSelectOneBy()
    {
        $paisService = $this->getPaisService();

        $resultSet = $paisService->selectOneBy(array('nome' => 'Brasil'));
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);
        $this->assertEquals('Brasil', $resultSet->getNome());
    }

    public function testSelectById()
    {
        $paisService = $this->getPaisService();

        $resultSet = $paisService->selectById(1);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);
        $this->assertEquals(1, $resultSet->getIdPais());

        $resultSet = $paisService->selectById(5);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);
        $this->assertEquals(5, $resultSet->getIdPais());

        $resultSet = $paisService->selectById(10);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);
        $this->assertEquals(10, $resultSet->getIdPais());
    }

    public function testCreate()
    {
        $this->mockIdentity();
        $data = array(
        	'nome' => 'Novo Pais'
        );
        $resultSet = $this->getPaisService()->create($data);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));

        return $resultSet;
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'nome' => 'novo Nome'
        );

        $resultSet = $this->getPaisService()->update($entityToUpdate->getIdPais(), $data);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));

        return $resultSet;
    }

    /**
     * @depends testUpdate
     */

    public function testDelete($entityToDelete)
    {
        $this->mockIdentity();
        $resultSet = $this->getPaisService()->delete($entityToDelete->getIdPais());
        $this->assertTrue($resultSet);
    }



    /**
     * @group cache2
     */
    public function testSetSelectAllCache()
    {
        $this->mockIdentity();

        $this->getPaisService()->setSessionName('testing');



        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem('testingResult')) {
            $cache->removeItem('testingResult');
        }

        $data = $this->getPaisService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
        $data = $this->getPaisService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
    }


    public function getRouteMatch($page, $orderBy = 'idPais', $order = 'DESC')
    {
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'TestUntil\Controller\Pais',
            'action'     => 'list',
            'page' => $page,
            'orderBy' => $orderBy,
            'order' => $order
        ));

        $routeMatch->setMatchedRouteName('test-until/pais');

        return $routeMatch;
    }
}
