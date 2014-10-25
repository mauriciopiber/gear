<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class BuildControllerTest extends AbstractConsoleControllerTestCase
{
    /** gear **/
    const SINGLE   = 'gear build Admin --build="dev"';
    const COMPOSE  = 'gear build admin --build="phpcs,phpmd,phpcpd"';

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

        $this->buildController = $controllerManager->get('Gear\Controller\Build');

        $mockModuleService = $this->getMockBuilder('Gear\Service\BuildService')
        ->disableOriginalConstructor()
        ->getMock();
        $mockModuleService->expects($this->any())
        ->method('build')
        ->willReturn('Build realizada com sucesso');

        $this->buildController->setBuildService($mockModuleService);
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
        unset($this->buildController);
    }

    public function testSingleBuild()
    {
        $this->dispatch(self::SINGLE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('BuildController');
        $this->assertControllerName('Gear\Controller\Build');
        $this->assertActionName('build');
        $this->assertMatchedRouteName('gear-build');
    }

    public function testVersionAlias()
    {
        $this->dispatch(self::COMPOSE);
        $this->assertResponseStatusCode(0);
        $this->assertModuleName('Gear');
        $this->assertControllerClass('BuildController');
        $this->assertControllerName('Gear\Controller\Build');
        $this->assertActionName('build');
        $this->assertMatchedRouteName('gear-build');
    }
}
