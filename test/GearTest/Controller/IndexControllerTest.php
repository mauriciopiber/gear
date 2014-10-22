<?php
namespace GearTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class IndexControllerTest extends AbstractConsoleControllerTestCase
{
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


        $indexController = $controllerManager->get('Gear\Controller\Index');

        $mockVersionService = $this->getMockBuilder('Gear\Service\VersionService')
        ->disableOriginalConstructor()
        ->getMock();

        $mockVersionService->expects($this->any())
        ->method('get')
        ->willReturn('0.1.3');

        $indexController->setVersionService($mockVersionService);
        /**
         * 2 opçṍes
         * ou mockar direto o controller
         * ou mockar a dependência, e trocar o controller no service config.
         */

    }

    /**
     * @group buceta
     */
    public function testBucetation()
    {
        $this->dispatch('gear -v');
        $this->assertConsoleOutputContains('0.1.3');
        $this->assertTrue(true);
    }

    public function getModulesFolder()
    {
        return realpath(__DIR__);
    }


    /**
     * @group rev
     */
    public function testVersion()
    {
        $this->dispatch('gear -v');
        $this->assertConsoleOutputContains('0.1.3');
    }

  /*   public function testGearSrcCreateForm()
    {
        $this->dispatch('gear page create TesteModule');
        $this->assertConsoleOutputContains('Página criado com sucesso.');
    }
 */
    public function testGearSrcCreateFilter()
    {

    }

    public function testGearSrcCreateFactory()
    {

    }

    public function testGearSrcCreateRepository()
    {

    }

    public function testGearSrcCreateEntity()
    {

    }

    public function testGearSrcCreateValueObject()
    {

    }
}
