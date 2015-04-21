<?php
namespace TestUploadTest\ControllerTest;

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


    public function getBootstrap()
    {
        return $this->bootstrap;
    }

    /**
     * Simplifier Create Mocks for class
     * @param string $name
     * @param array $functions
     * @return PHPUnit_Framework_MockObject_MockObject $emMock
     */
    public function getMockSingleClass($name, $functions = array())
    {
        if (count($functions)>0) {
            $emMock = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->setMethods($functions)
            ->getMock();
        } else {
            $emMock = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->getMock();
        }

        return $emMock;

    }

    public function setUp()
    {
        $bootstrap = new \TestUpload\ZendServiceLocator();
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

    public function mockIdentity()
    {
        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $identity = new \GearBaseTest\IdentityMock($this);

        $identity->getIdentityFromEmail('usuariogear1@gmail.com');

        $this->getApplication()
        ->getServiceManager()
        ->get('ControllerPluginManager')->setService('zfcUserAuthentication', $identity->getZfcUserAuthentication());

        $this->getApplication()
        ->getServiceManager()
        ->get('ServiceManager')->setService('zfcuser_auth_service', $identity->getAuthenticationService());
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
