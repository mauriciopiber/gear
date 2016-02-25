<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase as AbstractTestCase;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use GearBaseTest\BaseMockTrait;

/**
 * @group Controller
 */
class AbstractConsoleControllerTestCase extends AbstractTestCase implements ServiceLocatorAwareInterface
{
    protected $traceError = true;
    protected $serviceLocator;
    protected $bootstrap;
    use BaseMockTrait;
    use ServiceLocatorAwareTrait;

    public function getBootstrap()
    {
        return $this->bootstrap;
    }

    public function setUp()
    {
        $this->bootstrap = new \GearBaseTest\ZendServiceLocator();
        $this->setApplicationConfig(
            include \GearBase\Module::getProjectFolder().'/config/application.config.php'
        );
        parent::setUp();
        $this->setServiceLocator($this->bootstrap->getServiceLocator());
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

    public function mockPluginFilePostRedirectGet($return)
    {
        $postRedirectGet = $this->getMock('Zend\Mvc\Controller\Plugin\FilePostRedirectGet');
        $postRedirectGet->expects($this->any())
        ->method('__invoke')
        ->will($this->returnValue($return));

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $this->getApplication()
        ->getServiceManager()
        ->get('ControllerPluginManager')->setService('filepostredirectget', $postRedirectGet);

        return true;
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

    public function mockUser()
    {
        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $mockRole = $this->getMockBuilder('GearAdmin\Entity\Role')
        ->disableOriginalConstructor()
        ->setMethods(['getIdRole', 'getName'***REMOVED***)
        ->getMock();

        $mockRole->expects($this->any())->method('getIdRole')->willReturn(2);
        $mockRole->expects($this->any())->method('getName')->willReturn('admin');

        $mockUser =  $this->getMockBuilder('GearAdmin\Entity\User')
        ->disableOriginalConstructor()
        ->setMethods(['getIdRole', 'getId', 'getIdUser', 'getEmail'***REMOVED***)
        ->getMock();

        $mockUser->expects($this->any())->method('getIdRole')->willReturn($mockRole);
        $mockUser->expects($this->any())->method('getId')->willReturn(1);
        $mockUser->expects($this->any())->method('getIdUser')->willReturn(1);
        $mockUser->expects($this->any())->method('getEmail')->willReturn('piber@pibernetwork.com');

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
        ->will($this->returnValue($mockUser));

        $authAdapterMock = $this->getMock('ZfcUser\Authentication\Adapter\AdapterChain');

        $authAdapterMock->expects($this->any())
        ->method('clearIdentity')
        ->will($this->returnValue(true));

        $authMock->expects($this->any())
        ->method('hasIdentity')
        ->will($this->returnValue(true));

        $authMock->expects($this->any())
        ->method('getIdentity')
        ->will($this->returnValue($mockUser));

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


        $mockAuthorize = $this->getMockBuilder('BjyAuthorize\Service\Authorize')
        ->disableOriginalConstructor()
        ->setMethods(['isAllowed'***REMOVED***)
        ->getMock();

        $mockAuthorize->expects($this->any())->method('isAllowed')->willReturn(true);

        $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')->setService('BjyAuthorize\Service\Authorize', $mockAuthorize);

    }


    public function mockServiceSelectAll($service)
    {
        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $mockService = $this->getMockSingleClass($service, ['selectAll', 'getTableHead'***REMOVED***);

        $mockService->expects($this->any())->method('selectAll')->willReturn([***REMOVED***);
        $mockService->expects($this->any())->method('getTableHead')->willReturn([***REMOVED***);

        $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')
        ->setService($service, $mockService);
    }

    public function mockRequestPlugin()
    {
        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $mockService = $this->getMockSingleClass('GearBase\Controller\Plugin\RequestPlugin', ['create', 'update'***REMOVED***);
        $mockService->expects($this->any())->method('create')->willReturn([***REMOVED***);
        $mockService->expects($this->any())->method('update')->willReturn([***REMOVED***);

        $this->getApplication()
        ->getServiceManager()
        ->get('ControllerPluginManager')
        ->setService('getRequestPlugin', $mockService);
    }
}
