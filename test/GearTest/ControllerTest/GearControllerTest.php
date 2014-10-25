<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class GearControllerTest extends AbstractConsoleControllerTestCase
{
    /** gear **/
    const VERSIONM = 'gear -v';
    const VERSION  = 'gear --version';

    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php');

        parent::setUp();

        $this->getApplication()
        ->getServiceManager()
        ->setAllowOverride(true);

        $controllerManager = $this->getApplication()
        ->getServiceManager()
        ->get('controllermanager');

        $this->gearController = $controllerManager->get('Gear\Controller\Gear');

        $mockModuleService = $this->getMockBuilder('Gear\Service\VersionService')
        ->disableOriginalConstructor()
        ->getMock();
        $mockModuleService->expects($this->any())
        ->method('getVersion')
        ->willReturn('Novidades do sistema!');

        $this->gearController->setVersionService($mockModuleService);
    }

    public function tearDown()
    {
        parent::tearDown();
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        unset($this->gearController);
    }

    public function testVersion()
    {
        $this->dispatch(self::VERSION);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('GearController');
        $this->assertControllerName('Gear\Controller\Gear');
        $this->assertActionName('version');
        $this->assertMatchedRouteName('gear-version');
    }

    public function testVersionAlias()
    {
        $this->dispatch(self::VERSIONM);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('GearController');
        $this->assertControllerName('Gear\Controller\Gear');
        $this->assertActionName('version');
        $this->assertMatchedRouteName('gear-version');
    }
}
