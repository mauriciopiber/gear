<?php
namespace TesteTest;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->bootstrap = new \Teste\ZendServiceLocator();
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
        unset($this->bootstrap);
    }


    /**
     * Simplifier Create Mocks for abstract class
     * @param string $name
     * @param array $functions
     * @return PHPUnit_Framework_MockObject_MockObject $abstractRepository
     */
    public function getMockAbstractClass($name, $functions = array())
    {
        if (count($functions)>0) {
            $abstractRepository = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->setMethods($functions)
            ->getMockForAbstractClass();

        } else {
            $abstractRepository = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        }

        return $abstractRepository;

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

    public function getMockAuthenticationAdapter()
    {
        $authAdapter = $this->getMock('ZfcUser\Authentication\Adapter\AdapterChain');

        $authAdapter->expects($this->any())
        ->method('clearIdentity')
        ->will($this->returnValue(true));

        return $authAdapter;
    }

    public function getMockAuthenticationService(\Security\Entity\User $user)
    {
        $authService = $this->getMock('Zend\Authentication\AuthenticationService');
        $authService->expects($this->any())
        ->method('resetAdapter')
        ->will($this->returnValue(true));

        $authService->expects($this->any())
        ->method('logoutAdapters')
        ->will($this->returnValue(true));

        $authService->expects($this->any())
        ->method('hasIdentity')
        ->will($this->returnValue(true));

        $authService->expects($this->any())
        ->method('getIdentity')
        ->will($this->returnValue($user));

        return $authService;
    }

    public function getUserByEmail($email)
    {
        return $this->bootstrap
        ->getEntityManager()
        ->getRepository('Security\Entity\User')
        ->findOneBy(array('email' => $email));
    }

    public function getMockZfcUserAuthentication()
    {
        $zfcUserMock =  $this->getUserByEmail('usuariogear1@gmail.com');

        $authService = $this->getMockAuthenticationService($zfcUserMock);

        $authAdapter = $this->getMockAuthenticationAdapter();

        $authMock = $this->getMock('ZfcUser\Controller\Plugin\ZfcUserAuthentication');

        $authMock->expects($this->any())
        ->method('hasIdentity')
        -> will($this->returnValue(true));

        $authMock->expects($this->any())
        ->method('getIdentity')
        ->will($this->returnValue($zfcUserMock));

        $authMock->expects($this->any())
        ->method('getAuthAdapter')
        ->will($this->returnValue($authAdapter));

        $authMock->expects($this->any())
        ->method('getAuthService')
        ->will($this->returnValue($authService));

        return $authMock;
    }

    /**
     * Simplifier Create mocks for users loggin.
     */
    public function getMockIdentifier()
    {
        $this->bootstrap
        ->getServiceManager()
        ->setAllowOverride(true);

        $authMock = $this->getMockZfcUserAuthentication();

        $zfcUserMock =  $this->bootstrap
        ->getEntityManager()
        ->getRepository('Security\Entity\User')
        ->findOneBy(array('email' => 'usuariogear1@gmail.com'));

        $authService = $this->getMockAuthenticationService($zfcUserMock);

        $this->bootstrap
        ->getServiceManager()
        ->get('ControllerPluginManager')->setService('zfcUserAuthentication', $authMock);

        $this->bootstrap
        ->getServiceManager()
        ->get('ServiceManager')->setService('zfcuser_auth_service', $authService);

    }

    public function mockAuthService()
    {
        $zfcUserMock =  $this->bootstrap
        ->getEntityManager()
        ->getRepository('Security\Entity\User')
        ->findOneBy(array('email' => 'usuariogear1@gmail.com'));

        $authService = $this->getMockAuthenticationService($zfcUserMock);


        return $authService;
    }
}
