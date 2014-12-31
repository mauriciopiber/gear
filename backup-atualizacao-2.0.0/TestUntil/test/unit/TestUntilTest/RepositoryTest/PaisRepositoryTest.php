<?php
namespace TestUntil\TestUntilTest\RepositoryTest;

class PaisTest extends \PHPUnit_Framework_TestCase
{
    protected $pais;

    protected function setUp()
    {
        $this->bootstrap = new \TestUntil\ZendServiceLocator();
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

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getPais()
    {
        if (!isset($this->pais)) {
            $this->pais =
                $this->bootstrap->getServiceLocator()->get('TestUntil\Repository\PaisRepository');
        }
        return $this->pais;
    }

    /**
     * @group TestUntil
     * @group Pais
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPais()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group TestUntil
     * @group Pais
     */
    public function testCallUsingServiceLocator()
    {
        $pais = $this->getPais();
        $this->assertInstanceOf('TestUntil\Repository\PaisRepository', $pais);
    }

    public function testSelectAll()
    {
        $resultSet = $this->getPais()->selectAll();
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(256, count($resultSet));
    }


    public function testSelectAllByLike()
    {
        $resultSet = $this->getPais()->selectAll(array('likeField' => 'Brasil'));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(1, count($resultSet));
    }

    public function testSelectAllByName()
    {
        $resultSet = $this->getPais()->selectAll(array('nome' => 'Brasil'));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(1, count($resultSet));
    }

    public function testSelectAllOrderByIdAsc()
    {
        $resultSet = $this->getPais()->selectAll(array(), 'idPais', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(256, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals(1, $data->getIdPais());
    }

    public function testSelectOnBy()
    {
        $resultSet = $this->getPais()->selectOneBy(array('idPais' => 1));
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);
        $this->assertEquals(1, $resultSet->getIdPais());
    }

    public function testSelectAllOrderByIdDesc()
    {
        $resultSet = $this->getPais()->selectAll(array(), 'idPais', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(256, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals(256, $data->getIdPais());
    }

    public function testSelectAllOrderByNameAsc()
    {
        $resultSet = $this->getPais()->selectAll(array(), 'nome', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(256, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('Afeganistão', $data->getNome());
        //asc
        //desc
    }

    public function testSelectAllOrderByNameDesc()
    {
        $resultSet = $this->getPais()->selectAll(array(), 'nome', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(256, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('Zimbabué', $data->getNome());
        //asc
        //desc
    }

    public function testSelectByIdReturnNull()
    {
        $resultSet = $this->getPais()->selectById(60000);
        $this->assertNull($resultSet);
    }

    public function testSelectByIdReturnEntity()
    {
        $resultSet = $this->getPais()->selectById(1);
        $this->assertNotNull($resultSet);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);

        $this->assertEquals(1, $resultSet->getIdPais());
        $this->assertEquals('Afeganistão', $resultSet->getNome());
    }

    public function testCreateNewData()
    {
        $this->mockIdentity();
        $data = array(
        	'nome' => 'Novo Pais'
        );
        $resultSet = $this->getPais()->insert($data);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
        return $resultSet;
    }

    /**
     * @depends testCreateNewData
     */

    public function testUpdateExistData($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
        	'nome' => 'novo Nome'
        );

        $resultSet = $this->getPais()->update($entityToUpdate->getIdPais(), $data);
        $this->assertInstanceOf('TestUntil\Entity\Pais', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));

        return $resultSet;
    }

    /**
     * @depends testUpdateExistData
     */
    public function testDeleteExistData($entityToDelete)
    {
        $this->mockIdentity();
        $resultSet = $this->getPais()->delete($entityToDelete->getIdPais());
        $this->assertTrue($resultSet);



    }

    /**
     * @depends testUpdateExistData
     */
    public function testDeleteNoExistData()
    {
        $this->mockIdentity();
        $resultSet = $this->getPais()->delete(6000);
        $this->assertFalse($resultSet);
    }



    //test create

    //test update


    //test delete
}
