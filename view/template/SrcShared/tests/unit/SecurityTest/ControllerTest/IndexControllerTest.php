<?php
namespace GearAdmin\GearAdminTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @author piber
 *
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
{
    //303 - prg
    //302 - redirect
    //200 - forward e sem redirect
    protected $traceError = true;
    protected $serviceLocator;

    public function setUp()
    {
        $bootstrap = new \GearAdmin\ServiceLocator();
        $bootstrap->chroot();
        $this->setApplicationConfig(
            include realpath(__DIR__.'/../../../../../../config/').'/application.config.php');
        parent::setUp();
        $this->setServiceLocator($bootstrap->getServiceLocator());
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

    //tests
    public function testIndexAction()
    {
        $this->dispatch('/gear-admin');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin');
    }

    /**
     * @group GearAdmin2
     */
    public function testWantToAcesssLoginPageAction()
    {
        $this->dispatch('/gear-admin/login');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('login');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/login');
    }

    /**
     * @group GearAdmin2
     */
    public function testLoginReturnValidation()
    {
        $this->dispatch('/gear-admin/login', 'POST', array());
        $this->assertResponseStatusCode(303);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('login');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/login');
    }

    /**
     * @group GearAdmin2
     */
    public function testLoginReturnSucessfull()
    {
        $data = array(
            'identity' => 'email1@gmail.com',
            'credential' => 'piber182'
        );
        $this->mockPluginPostRedirectGet($data);
        $this->dispatch('/gear-admin/login', 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('login');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/login');
    }

    /**
     * @group GearAdmin1
     */
    public function testWantToAccessRegisterPageAction()
    {
        $this->dispatch('/gear-admin/register');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('register');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/register');
    }

    /**
     * @group GearAdmin1
     */
    public function testRegisterSuccessfull()
    {
        $this->dispatch('/gear-admin/register', 'POST', array(
            'email' => 'email3@gmail.com',
            'emailVerify' => 'email3@gmail.com',
            'password' => '123456',
            'passwordVerify' => '123456'
        ));
        $this->assertResponseStatusCode(303);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('register');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/register');
    }

    /**
     * @group fixUrl
     */
    public function testRegisterSuccessfullWithPRG()
    {
        $rnd = rand(0, 1000);
        $data = array(
            'email' => sprintf('email%d@gmail.com', $rnd),
            'emailVerify' => sprintf('email%d@gmail.com', $rnd),
            'password' => '123456',
            'passwordVerify' => '123456'
        );

        $this->mockPluginPostRedirectGet($data);

        $this->dispatch('/gear-admin/register', 'POST', array($data));
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('register');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/register');

        //die();
        return $data;
    }

    /**
     * @group fixUrl
     * @depends testRegisterSuccessfullWithPRG
     */
    public function testActivationValidEmailAction($data)
    {
        $boostrap = new \GearAdmin\ServiceLocator();
        $entityManager = $boostrap->getEntityManager();

        /* @var $entityManagerail \GearAdmin\Entity\Email */
        $entityManagerail = $entityManager->getRepository('GearAdmin\Entity\Email')
        ->findOneBy(array(), array('created' => 'DESC'));

        $this->assertEquals($data['email'***REMOVED***, $entityManagerail->getDestino());

        $email = $entityManagerail->getMensagem();

        $urlParsed = parse_url($email);

        $url = $urlParsed['path'***REMOVED***;

        $this->dispatch($url);
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('activation');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/activation');

        return $url;

    }

    public function testActivationUserAlreadyActivated()
    {
        $url =
            '/gear-admin'
            .'/activation'
            .'/14'
            .'/09f7b698fb1b12487e0c0a5bab6be95d'
            .'/f6c04c0c770ab026321d2daced1dc258'
            .'/c18048da6ae91f2cdf32186995f85158'
        ;

        $this->dispatch($url);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('activation');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/activation');
    }

    public function testActivationUserThatNotExistsId()
    {
        $url =
            '/gear-admin'
           .'/activation'
           .'/400'
           .'/09f7b698fb1b12487e0c0a5bab6be95d'
           .'/f6c04c0c770ab026321d2daced1dc258'
           .'/c18048da6ae91f2cdf32186995f85158'
           ;

        $this->dispatch($url);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('activation');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/activation');
    }

    public function testWantToAccessActivationSendPageAction()
    {
        $this->dispatch('/gear-admin/send-activation');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('send-activation');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/send-activation');
    }

    public function testAccessLogonWithoutRequestAction()
    {
        $this->dispatch('/gear-admin/log-on');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('log-on');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/log-on');
    }

    public function testWantToInsertEmailToGetActivationAction()
    {
        $this->dispatch('/gear-admin/send-activation', 'POST', array('email@gmail.com'));
        $this->assertResponseStatusCode(303);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('send-activation');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/send-activation');
    }

    public function testWantToSendActivationButAreAlreadyAction()
    {
        $data = array('email' => 'email2@gmail.com');

        $this->mockPluginPostRedirectGet(
            $data
        );

        $this->dispatch('/gear-admin/send-activation', 'POST', $data);
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('send-activation');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/send-activation');

    }

    public function testSentActivationSuccessfulAction()
    {
        $data = array('email' => 'email1@gmail.com');

        $this->mockPluginPostRedirectGet(
            $data
        );

        $this->dispatch('/gear-admin/send-activation', 'POST', $data);
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('send-activation');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/send-activation');
    }

    public function testWantToAccessActivationSentPageRedirectAction()
    {
        $this->dispatch('/gear-admin/activation-sent');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('activation-sent');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/activation-sent');
    }

    public function testWantToAccessGearAdminAction()
    {
        $this->dispatch('/gear-admin');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin');
    }

    public function testInvalidinkAction()
    {
        $this->dispatch('/gear-admin/invalid-link');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('invalid-link');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/invalid-link');
    }

    public function testWantToAccessActivationSentPageAction()
    {
        $this->dispatch('/gear-admin/activation-sent', 'POST', array('email' => 'mau@gmail.com'));
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('activation-sent');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/activation-sent');
    }

    /**
    * @group GearAdmin3
    */
    public function testEnterPasswordRecoveryRequestAction()
    {
        $this->dispatch('/gear-admin/send-password-recovery-request');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('send-password-recovery-request');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/send-password-recovery-request');
    }

    /**
     * @group GearAdmin3
     */
    public function testEnterEmailToPasswordRecoveryRequestRedirectAction()
    {
        $data = array('email' => 'email1@gmail.com');

        $this->dispatch('/gear-admin/send-password-recovery-request', 'POST', $data);
        //will return PRG
        $this->assertResponseStatusCode(303);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('send-password-recovery-request');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/send-password-recovery-request');
    }

    public function testPasswordRecoveryRequestSentWithEmail()
    {
        $data = array('email' => 'email1@gmail.com');

        $this->dispatch('/gear-admin/password-recovery-request-sent', 'POST', $data);
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('password-recovery-request-sent');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/password-recovery-request-sent');
    }

    public function testPasswordRecoveryRequestSentWithoutEmail()
    {
        $this->dispatch('/gear-admin/password-recovery-request-sent');
        $this->assertResponseStatusCode(302);
        $this->assertRedirect();
        $this->assertRedirectTo('/gear-admin/invalid-link');
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('password-recovery-request-sent');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/password-recovery-request-sent');
    }

    /**
     * @group GearAdmin3t
     */
    public function testEnterEmailToPasswordRecoveryRequestForwardAction()
    {
        $data = array('email' => 'email1@gmail.com');

        $this->mockPluginPostRedirectGet(
            $data
        );

        $this->dispatch('/gear-admin/send-password-recovery-request', 'POST', $data);
        //will return PRG
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('send-password-recovery-request');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/send-password-recovery-request');

        $emailRepository = $this->getServiceLocator()->get('emailRepository');

        $recoveryEmail = $emailRepository->selectOneBy(
            array('destino' => $data['email'***REMOVED***),
            array('created' => 'DESC')
        );

        $this->assertEquals($recoveryEmail->getDestino(), $data['email'***REMOVED***);

        $url = $recoveryEmail->getMensagem();

        $config = $this->getConfig();

        $this->assertStringStartsWith(sprintf('http://%s/gear-admin/password-recovery', $config['baseUrl'***REMOVED***['url'***REMOVED***), $url);

        $replacedUrl = str_replace(sprintf('http://%s', $config['baseUrl'***REMOVED***['url'***REMOVED***), '', $url);

        return $replacedUrl;
    }

    /**
     * @group GearAdmin3t
     * @depends testEnterEmailToPasswordRecoveryRequestForwardAction
     */
    public function testClinkLinkAndEnterToRecoverPasswordPage($url)
    {
        $this->dispatch($url);
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('password-recovery');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/password-recovery');

        $recoveryContainer = new \Zend\Session\Container('recuperarSenha');

        return $recoveryContainer->recuperar;

    }

    /**
     * @group GearAdmin3t
     * @depends testClinkLinkAndEnterToRecoverPasswordPage
     */
    public function testUsePasswordRecoveryFormReturnValidation($arrayRecuperarSenha)
    {
        $recoveryContainer = new \Zend\Session\Container('recuperarSenha');
        $recoveryContainer->recuperar = $arrayRecuperarSenha;

        $this->dispatch('/gear-admin/password-recovery', 'POST', array());
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('password-recovery');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/password-recovery');

        return $arrayRecuperarSenha;
    }

    /**
     * @group GearAdmin3t
     * @depends testUsePasswordRecoveryFormReturnValidation
     */
    public function testUsePasswordRecoveryAndRecoverPassword($arrayRecuperarSenha)
    {
        $recoveryContainer = new \Zend\Session\Container('recuperarSenha');
        $recoveryContainer->recuperar = $arrayRecuperarSenha;

        $data = array(
            'password' => 'novopassword',
            'passwordVerify' => 'novopassword'
        );

        $this->dispatch('/gear-admin/password-recovery', 'POST', $data);
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('password-recovery');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/password-recovery');
        $this->assertRedirect();
        $this->assertRedirectTo('/gear-admin/password-recovery-successful');
    }

    /**
     * @group GearAdmin3t
     */
    public function testPasswordRecoverySucessfullWithEmail()
    {
        $this->dispatch('/gear-admin/password-recovery-successful', 'POST', array('email' => 'email1@gmail.com'));
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('password-recovery-successful');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/password-recovery-successful');
    }

    /**
     * @group GearAdmin3t
     */
    public function testPasswordRecoverySucessfullWithoutEmail()
    {
        $this->dispatch('/gear-admin/password-recovery-successful');
        $this->assertResponseStatusCode(302);
        $this->assertRedirect();
        $this->assertRedirectTo('/gear-admin/invalid-link');
        $this->assertModuleName('GearAdmin');
        $this->assertControllerName('GearAdmin\Controller\Index');
        $this->assertActionName('password-recovery-successful');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-admin/password-recovery-successful');
    }

    public function getConfig()
    {
        if (!isset($this->config)) {
            $this->config = $this->getServiceLocator()->get('config');
        }

        return $this->config;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
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
}
