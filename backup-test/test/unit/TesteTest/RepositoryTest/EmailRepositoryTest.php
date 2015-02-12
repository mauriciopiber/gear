<?php
namespace TesteTest\RepositoryTest;

/**
 * @group Repository
 */
class EmailRepositoryTest extends \TesteTest\AbstractTest
{
    protected $email;

    public function getEmail()
    {
        if (!isset($this->email)) {
            $this->email =
                $this->bootstrap->getServiceLocator()->get('Teste\Repository\EmailRepository');
        }
        return $this->email;
    }

    /**
     * @group Teste
     * @group Email
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getEmail()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group Teste
     * @group Email
     */
    public function testCallUsingServiceLocator()
    {
        $email = $this->getEmail();
        $this->assertInstanceOf('Teste\Repository\EmailRepository', $email);
    }


    public function testSelectAll()
    {
        $resultSet = $this->getEmail()->selectAll();
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }


    public function testSelectAllWithBasicFilter()
    {
        $resultSet = $this->getEmail()->selectAll(array('likeField' => ''));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }

    public function testSelectAllWithBasicFilterFoundNone()
    {
        $resultSet = $this->getEmail()->selectAll(array('likeField' => 'abcdefAhauhsdfguagdfaf'));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(0, count($resultSet));
    }

    public function testSelectByIdReturnEntity()
    {
        $resultSet = $this->getEmail()->selectById(1);
        $this->assertNotNull($resultSet);
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);

        $this->assertEquals(1, $resultSet->getIdEmail());
    }

    public function testSelectByIdReturnNull()
    {
        $resultSet = $this->getEmail()->selectById(60000);
        $this->assertNull($resultSet);
    }

    public function testDeleteNoExistData()
    {
        $this->mockIdentity();
        $resultSet = $this->getEmail()->delete(6000);
        $this->assertFalse($resultSet);
    }
        
    public function testSelectOneByIdEmail()
    {
        $resultSet = $this->getEmail()->selectOneBy(array('idEmail' => 15));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals(15, $resultSet->getIdEmail());
    }
    public function testSelectOneByRemetente()
    {
        $resultSet = $this->getEmail()->selectOneBy(array('remetente' => '15Remetente'));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals('15Remetente', $resultSet->getRemetente());
    }
    public function testSelectOneByDestino()
    {
        $resultSet = $this->getEmail()->selectOneBy(array('destino' => '15Destino'));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals('15Destino', $resultSet->getDestino());
    }
    public function testSelectOneByAssunto()
    {
        $resultSet = $this->getEmail()->selectOneBy(array('assunto' => '15Assunto'));
        $this->assertInstanceOf('Teste\Entity\Email', $resultSet);
        $this->assertEquals('15Assunto', $resultSet->getAssunto());
    }
    
    public function testSelectAllOrderByIdEmailASC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'idEmail', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('1', $data['idEmail'***REMOVED***);
    }
    public function testSelectAllOrderByIdEmailDESC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'idEmail', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30', $data['idEmail'***REMOVED***);
    }
    public function testSelectAllOrderByRemetenteASC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'remetente', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('10Remetente', $data['remetente'***REMOVED***);
    }
    public function testSelectAllOrderByRemetenteDESC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'remetente', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('9Remetente', $data['remetente'***REMOVED***);
    }
    public function testSelectAllOrderByDestinoASC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'destino', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('10Destino', $data['destino'***REMOVED***);
    }
    public function testSelectAllOrderByDestinoDESC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'destino', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('9Destino', $data['destino'***REMOVED***);
    }
    public function testSelectAllOrderByAssuntoASC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'assunto', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('10Assunto', $data['assunto'***REMOVED***);
    }
    public function testSelectAllOrderByAssuntoDESC()
    {
        $resultSet = $this->getEmail()->selectAll(array(), 'assunto', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('9Assunto', $data['assunto'***REMOVED***);
    }

    public function testCreateNewData()
    {
        $this->mockIdentity();
        $data = array(
            'remetente' => 'insert Remetente',
            'destino' => 'insert Destino',
            'assunto' => 'insert Assunto',
            'mensagem' => 'insert Mensagem',
        );
        $resultSet = $this->getEmail()->insert($data);
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
     * @depends testCreateNewData
     */
    public function testUpdateExistData($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'remetente' => 'update Remetente',
            'destino' => 'update Destino',
            'assunto' => 'update Assunto',
            'mensagem' => 'update Mensagem',
        );

        $resultSet = $this->getEmail()->update($entityToUpdate->getIdEmail(), $data);
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
     * @depends testUpdateExistData
     */
    public function testDeleteExistData($entityToDelete)
    {
        $entity = $this->getEmail()->selectById($entityToDelete->getIdEmail());
        $this->mockIdentity();
        $resultSet = $this->getEmail()->delete($entity);
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
}
