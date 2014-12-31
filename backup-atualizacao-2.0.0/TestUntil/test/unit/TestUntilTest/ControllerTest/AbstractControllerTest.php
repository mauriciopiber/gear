<?php
namespace TestUntilTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;
    protected $serviceLocator;

    public function setUp()
    {
        $bootstrap = new \TestUntil\ZendServiceLocator();
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

        $zfcUserMock =  $this->bootstrap->getEntityManager()->getRepository('Security\Entity\User')->findOneBy(array('idUser' => 1));

        $authMock = $this->getMock('ZfcUser\Controller\Plugin\ZfcUserAuthentication');

        $authServiceMock = $this->getMock('Zend\Authentication\AuthenticationService');
        $authServiceMock->expects($this->any())
        ->method('resetAdapter')
        ->will($this->returnValue(true));

        $authServiceMock->expects($this->any())
        ->method('logoutAdapters')
        ->will($this->returnValue(true));

        $authServiceMock->expects($this->any())
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
        ->will($this->returnValue($authServiceMock));

         $this->getApplication()
        ->getServiceManager()
        ->get('ControllerPluginManager')->setService('zfcUserAuthentication', $authMock);


         $this->getApplication()
         ->getServiceManager()
         ->get('ServiceManager')->setService('zfcuser_auth_service', $authServiceMock);
         // Creating mock
         $mockBjy = $this->getMock('BjyAuthorize\Service\Authorize', array(
            'isAllowed'
        ), array(
            $this->getApplicationConfig(),
            $this->getApplication()
                ->getServiceManager()
        ));

         // Bypass auth, force true
         $mockBjy->expects($this->any())
         ->method('isAllowed')
         ->will($this->returnValue(true));

         // Overriding BjyAuthorize\Service\Authorize service
         $this->getApplication()
         ->getServiceManager()
         ->setService('BjyAuthorize\Service\Authorize', $mockBjy);
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
