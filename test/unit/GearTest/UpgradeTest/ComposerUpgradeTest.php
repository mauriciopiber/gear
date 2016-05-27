<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Upgrade\ComposerUpgradeTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group Upgrade
 * @group Service
 */
class ComposerUpgradeTest extends AbstractTestCase
{
    use ComposerUpgradeTrait;

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');
    }

    public function getModuleType()
    {
        return [['cli', 'web'***REMOVED******REMOVED***;
    }

    public function getProjectType()
    {
        return [['cli', 'web'***REMOVED******REMOVED***;
    }

    /**
     * @covers \Gear\Upgrade\ComposerUpgrade::upgradeModule
     * @dataProvider getModuleType
     */
    public function testUpgradeComposer($type)
    {
        $actualFile = <<<EOS
{
    "name": "mauriciopiber/gear",
    "require": {
        "mpiber/package-1": "1.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*1.0.0"
    }
}

EOS;

        file_put_contents($this->file, $actualFile);

        $edge = $this->prophesize('Gear\Edge\ComposerEdge');
        $edge->getComposerModule($type)->willReturn(
            [
                'require' => [
                    'mpiber/package-1' => '1.0.0',
                    'mpiber/package-2' => '2.0.0',
                    'mpiber/package-3' => '3.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-1' => '^1.0.0',
                    'mpiber/unit-2' => '*2.0.0'
                ***REMOVED***

            ***REMOVED***
        );


        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $upgrade = new \Gear\Upgrade\ComposerUpgrade();

        $upgrade->setModule($module->reveal());
        $upgrade->setComposerEdge($edge->reveal());

        $upgradeComposer = $upgrade->upgradeModule($type);

        $expectedFile = <<<EOS
{
    "name": "mauriciopiber/gear",
    "require": {
        "mpiber/package-1": "1.0.0",
        "mpiber/package-2": "2.0.0",
        "mpiber/package-3": "3.0.0"
    },
    "require-dev": {
        "mpiber/unit-1": "^1.0.0",
        "mpiber/unit-2": "*2.0.0"
    }
}
EOS;


        $this->assertEquals($expectedFile, file_get_contents($this->file));
    }

    /**
     * @group Gear
     * @group ComposerUpgrade
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getComposerUpgrade()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ComposerUpgrade
    */
    public function testGet()
    {
        $composerUpgrade = $this->getComposerUpgrade();
        $this->assertInstanceOf('Gear\Upgrade\ComposerUpgrade', $composerUpgrade);
    }

    /**
     * @group Gear
     * @group ComposerUpgrade
    */
    public function testSet()
    {
        $mockComposerUpgrade = $this->getMockSingleClass(
            'Gear\Upgrade\ComposerUpgrade'
        );
        $this->setComposerUpgrade($mockComposerUpgrade);
        $this->assertEquals($mockComposerUpgrade, $this->getComposerUpgrade());
    }
}
