<?php
namespace TesteTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @group Controller
 */
class AbstractControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;
    protected $serviceLocator;
    protected $bootstrap;


    public function setUp()
    {
        $bootstrap = new \Teste\ZendServiceLocator();
        $bootstrap->chroot();
        $this->setApplicationConfig(
            include realpath(__DIR__.'/../../../../../../config/').'/application.config.php'
        );
        parent::setUp();
        $this->setServiceLocator($bootstrap->getServiceLocator());
        $this->bootstrap = $bootstrap;
    }

    protected function tearDown()
    {
        $entityManager = $this->bootstrap->getEntityManager();
        $connection = $entityManager->getConnection();
        $connection->close();
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        unset($this->serviceLocator);
    }

    public function mockPluginPostRedirectGet($return)
    {
        $postRedirectGet = $this->getMock('Zend\Mvc\Controller\Plugin\PostRedirectGet');
        $postRedirectGet->expects($this->any())
        ->method('__invoke')
        ->will($this->returnValue($return));

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $this->getApplication()
        ->getServiceManager()
        ->get('ControllerPluginManager')->setService('postredirectget', $postRedirectGet);

        return true;
    }

    public function mockIdentity()
    {
        $this->getApplication()
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
        ->method('hasIdentity')
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

        $this->getApplication()
         ->getServiceManager()
        ->get('ControllerPluginManager')->setService('zfcUserAuthentication', $authMock);

        $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')->setService('zfcuser_auth_service', $autenticationService);
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function testAssertAbstractWorks()
    {
        $this->assertTrue(true);
    }
}
