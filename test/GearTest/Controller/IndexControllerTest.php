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

        $this->controller = new \Gear\Controller\IndexController();
    }

    public function getModulesFolder()
    {
        return realpath(__DIR__);
    }

    /**
     * @group rev
     */

    public function testCreateModule()
    {
        $this->dispatch('gear module create TestePiberUnit');
        $this->assertConsoleOutputContains('Module TestePiberUnit created.');
        $moduleTestePiberUnit = new \Gear\ValueObject\BasicModuleStructure('TestePiberUnit');
        $this->assertTrue(is_dir($moduleTestePiberUnit->getMainFolder()));
    }

    /**
     * @group rev
     */
    public function testBuild()
    {
        $this->dispatch('gear build TestePiberUnit dev');
    }

    /**
     * @group rev
     */
    public function testDeleteModule()
    {
        $this->dispatch('gear module delete TestePiberUnit');
        $this->assertConsoleOutputContains('Module TestePiberUnit deleted.');
        $moduleTestePiberUnit = new \Gear\ValueObject\BasicModuleStructure('TestePiberUnit');
        $this->assertFalse(is_dir($moduleTestePiberUnit->getMainFolder()));
    }

    /**
     * @group rev
     */
    public function testVersion()
    {
        $this->dispatch('gear -v');
        $this->assertConsoleOutputContains('0.1.0');
    }

    public function testGearSrcCreateService()
    {

        $cmd = 'gear src service \'{"name":"TestCreateNewService"}\'';

        $this->dispatch($cmd);
        $this->assertResponseStatusCode(1);
        $this->assertModuleName('Gear');
        $this->assertControllerName('Gear\Controller\Index');
        $this->assertActionName('gearsrc');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('gear-src');

    }

    public function testGearSrcDropService()
    {
        $cmd = 'gear src service TestCreateNewService --drop';
    }

    public function testGearSrcCreateForm()
    {

    }

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
