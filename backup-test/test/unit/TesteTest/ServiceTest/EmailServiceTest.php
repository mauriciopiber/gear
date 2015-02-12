<?php
namespace Teste\TesteTest\ServiceTest;

/**
 * @group Service
 */
class EmailServiceTest extends \TesteTest\AbstractTest
{
    protected $emailService;

    public function getEmailService()
    {
        if (!isset($this->emailService)) {
            $this->emailService =
                $this->bootstrap->getServiceLocator()->get(
                    'Teste\Service\EmailService'
                );
        }
        return $this->emailService;
    }

    /**
     * @group Teste
     * @group EmailService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getEmailService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Teste
     * @group EmailService
    */
    public function testCallUsingServiceLocator()
    {
        $emailService = $this->getEmailService();
        $this->assertInstanceOf('Teste\Service\EmailService', $emailService);
    }

    /**
     * @group EmailService     */
    public function testSetEmailRepository()
    {
        $mock = $this->getMockBuilder('Teste\Repository\EmailRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $emailService = $this->getEmailService();
        $emailService->setEmailRepository($mock);
        $this->assertInstanceOf('Teste\Repository\EmailRepository', $mock);
        return $this;
    }

    /**
     * @group EmailService     */
    public function testGetEmailRepository()
    {
        $emailService = $this->getEmailService();
        $emailRepository = $emailService->getEmailRepository();
        $this->assertInstanceOf('Teste\Repository\EmailRepository', $emailRepository);

    }


    public function testSetSelectAllCache()
    {
        $this->mockIdentity();

        $this->getEmailService()->setSessionName('testing');

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem('testingResult')) {
            $cache->removeItem('testingResult');
        }

        $data = $this->getEmailService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
        $data = $this->getEmailService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
    }

    public function testSelectAllCacheWithCache()
    {
        $this->mockIdentity();

        $this->getEmailService()->setRouteMatch($this->getRouteMatch(1, 'remetente', 'DESC'));

        $this->assertEquals('remetente', $this->getEmailService()->getOrderBy());
        $this->assertEquals('DESC', $this->getEmailService()->getOrder());

        $resultSet = $this->getEmailService()->selectAll();
        $resultSet = $this->getEmailService()->selectAll();

        $this->getEmailService()->setRouteMatch($this->getRouteMatch(1, 'remetente', 'ASC'));

        $this->assertEquals('remetente', $this->getEmailService()->getOrderBy());
        $this->assertEquals('ASC', $this->getEmailService()->getOrder());

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem($this->getEmailService()->getSessionName())) {
            $cache->removeItem($this->getEmailService()->getSessionName());
        }

        $this->getEmailService()->setRouteMatch($this->getRouteMatch(1, 'idEmail', 'DESC'));
        $this->assertEquals('idEmail', $this->getEmailService()->getOrderBy());
        $this->assertEquals('DESC', $this->getEmailService()->getOrder());
    }

    public function testSelectById()
    {
        $emailService = $this->getEmailService();
        $resultSet = $emailService->selectById(1);
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals(1, $resultSet->getIdEmail());
    }

    
    public function testSelectOneByIdEmail()
    {
        $resultSet = $this->getEmailService()->selectOneBy(array('idEmail' => 15));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals(15, $resultSet->getIdEmail());
    }
    public function testSelectOneByRemetente()
    {
        $resultSet = $this->getEmailService()->selectOneBy(array('remetente' => '15Remetente'));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals('15Remetente', $resultSet->getRemetente());
    }
    public function testSelectOneByDestino()
    {
        $resultSet = $this->getEmailService()->selectOneBy(array('destino' => '15Destino'));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals('15Destino', $resultSet->getDestino());
    }
    public function testSelectOneByAssunto()
    {
        $resultSet = $this->getEmailService()->selectOneBy(array('assunto' => '15Assunto'));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals('15Assunto', $resultSet->getAssunto());
    }
    /**
     * @group Service.Create
     */
    public function testCreate()
    {
        $this->mockIdentity();
        $data = array(
            'remetente' => 'insert Remetente',
            'destino' => 'insert Destino',
            'assunto' => 'insert Assunto',
            'mensagem' => 'insert Mensagem',
        );
        $resultSet = $this->getEmailService()->create($data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
        $this->assertEquals('insert Remetente', $resultSet->getRemetente());
        $this->assertEquals('insert Destino', $resultSet->getDestino());
        $this->assertEquals('insert Assunto', $resultSet->getAssunto());
        $this->assertEquals('insert Mensagem', $resultSet->getMensagem());
        return $resultSet;
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'remetente' => 'update Remetente',
            'destino' => 'update Destino',
            'assunto' => 'update Assunto',
            'mensagem' => 'update Mensagem',
        );
        $resultSet = $this->getEmailService()->update($entityToUpdate->getIdEmail(), $data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));
        $this->assertEquals('update Remetente', $resultSet->getRemetente());
        $this->assertEquals('update Destino', $resultSet->getDestino());
        $this->assertEquals('update Assunto', $resultSet->getAssunto());
        $this->assertEquals('update Mensagem', $resultSet->getMensagem());
        return $resultSet;
    }

    /**
     * @depends testUpdate
     */
    public function testDelete($entityToDelete)
    {

        $emailService = $this->getEmailService();
        $resultSet = $emailService->delete($entityToDelete->getIdEmail());
        $this->assertTrue($resultSet);
    }

    public function mockIdentity()
    {
        $this->bootstrap
        ->getServiceManager()
        ->setAllowOverride(true);

        $zfcUserMock =  $this->bootstrap
          ->getEntityManager()
          ->getRepository('Security\Entity\User')
          ->findOneBy(array('email' => 'usuariogear1@gmail.com'));

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
    }

    public function getRouteMatch($page, $orderBy = 'idEmail', $order = 'DESC')
    {
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'Teste\Controller\Email',
            'action'     => 'list',
            'page' => $page,
            'orderBy' => $orderBy,
            'order' => $order
        ));

        $routeMatch->setMatchedRouteName('teste/email');
        return $routeMatch;
    }
}
