<?php
namespace GearTest\MvcTest\ConfigTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\Config\ServiceManagerTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group Module
 * @group Module-Mvc
 * @group Module-Mvc-Config
 */
class ServiceManagerTest extends AbstractTestCase
{
    use ServiceManagerTrait;

    public function setUp()
    {
        parent::setUp();
        $this->module = vfsStream::setup('moduleDir');

        $dirService = new \Gear\Service\Filesystem\DirService();
        $strService = new \Gear\Service\Type\StringService();

        $basicModuleStructure = new \Gear\ValueObject\BasicModuleStructure();
        $basicModuleStructure->setMainFolder(vfsStream::url('moduleDir'));
        $basicModuleStructure->setModuleName('GearTest');
        $basicModuleStructure->setDirService($dirService);
        $basicModuleStructure->setStringService($strService);
        $basicModuleStructure->prepare();
        $basicModuleStructure->write();

        $this->moduleStructure = $basicModuleStructure;

        $renderer = $this->mockPhpRenderer(\Gear\Module::getLocation().'/../../view/');

        $template = new \Gear\Service\TemplateService();
        $template->setRenderer($renderer);

        $this->template = $template;

        $this->file = new \Gear\Service\Filesystem\FileService;
    }

    public function testCreateModule()
    {
        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->moduleStructure);
        $serviceManager->setTemplateService($this->template);
        $serviceManager->setFileService($this->file);

        $serviceManager->createModule();

        $this->assertTrue(is_dir($this->moduleStructure->getConfigExtFolder()));
        $this->assertTrue(is_file($this->moduleStructure->getConfigExtFolder().'/servicemanager.config.php'));

        $serviceManager = require $this->moduleStructure->getConfigExtFolder().'/servicemanager.config.php';

        $this->assertArrayHasKey('factories', $serviceManager);
        $this->assertArrayHasKey('aliases', $serviceManager);
    }

    public function testAddSrcOverDb()
    {
        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->moduleStructure);

        copy(__DIR__.'/_case/ServiceManager-CreateSrcOverDb.php', $this->moduleStructure->getConfigExtFolder().'/servicemanager.config.php');

        $serviceManagerConfig = require $this->moduleStructure->getConfigExtFolder().'/servicemanager.config.php';

        $this->assertArrayHasKey('factories', $serviceManagerConfig);
        $this->assertArrayHasKey('aliases', $serviceManagerConfig);
        $this->assertArrayHasKey('invokables', $serviceManagerConfig);
    }

    public function testAddSrcOverSrc()
    {
        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->moduleStructure);

        copy(__DIR__.'/_case/ServiceManager-CreateSrcOverSrc.php', $this->moduleStructure->getConfigExtFolder().'/servicemanager.config.php');

        $serviceManagerConfig = require $this->moduleStructure->getConfigExtFolder().'/servicemanager.config.php';

        //$this->assertArrayHasKey('factories', $serviceManager);
        //$this->assertArrayHasKey('aliases', $serviceManager);
        $this->assertArrayHasKey('invokables', $serviceManagerConfig);
        $this->assertCount(1, $serviceManagerConfig['invokables'***REMOVED***);

        $src = new \Gear\ValueObject\Src([
            'type' => 'Repository',
            'name' => 'UnitRepository'
        ***REMOVED***);

        $serviceManager->mergeFromSrc($src);

        $serviceManagerConfig = require $this->moduleStructure->getConfigExtFolder().'/servicemanager.config.php';

        $this->assertArrayHasKey('invokables', $serviceManagerConfig);
        $this->assertCount(2, $serviceManagerConfig['invokables'***REMOVED***);

    }
}