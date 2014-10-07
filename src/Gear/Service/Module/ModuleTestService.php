<?php
namespace Gear\Service\Module;

use Gear\ValueObject\Config\Config;

use Gear\Service\AbstractService;

/**
 *
 * @author Mauricio Piber mauriciopiber@gmail.com
 *         Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 *         Bem como a classe Module.php e suas dependências
 */
class ModuleTestService extends AbstractService
{

    public function createTests($module)
    {
        $testsFolders = $this->createModuleFolders($module);

        $codeceptService = $this->getServiceLocator()->get('codeceptService');
        $codeceptService->start($module);

        $this->zendServiceLocator();

        $this->bootstrap();

        $this->copyBuild();

        return true;
    }

    public function bootstrap()
    {
        $this->createFileFromTemplate('tests/_bootstrap', array('namespace' => $this->getConfig()->getModule()), '_bootstrap.php', $this->getConfig()
            ->getLocal() . '/module/'.$this->getConfig()->getModule().'/test/');
        $this->createFileFromTemplate('tests/acceptance/_bootstrap', array('namespace' => $this->getConfig()->getModule()), '_bootstrap.php', $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/acceptance');
        $this->createFileFromTemplate('tests/functional/_bootstrap', array('namespace' => $this->getConfig()->getModule()), '_bootstrap.php', $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/functional');
        $this->createFileFromTemplate('tests/unit/_bootstrap', array('namespace' => $this->getConfig()->getModule()), '_bootstrap.php', $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/unit');
    }

    public function createModuleFolders($module)
    {

        $moduleFolders = new \stdClass();
        $moduleFolders->tests          = $this->getDirService()->mkDir($module->getTestFolder());
        $moduleFolders->testsData      = $this->getDirService()->mkDir($module->getTestDataFolder());
        $moduleFolders->testsSupport   = $this->getDirService()->mkDir($module->getTestSupportFolder());
        $moduleFolders->testsPages     = $this->getDirService()->mkDir($module->getTestPagesFolder());
        $moduleFolders->acceptance     = $this->getDirService()->mkDir($module->getTestAcceptanceFolder());
        $moduleFolders->functional     = $this->getDirService()->mkDir($module->getTestFunctionalFolder());
        $moduleFolders->unit           = $this->getDirService()->mkDir($module->getTestUnitFolder());
        $moduleFolders->testsUnit      = $this->getDirService()->mkDir($module->getTestUnitModuleFolder());

        $moduleFolders->controller      = $this->getDirService()->mkDir($moduleFolders->testsUnit.'/ControllerTest');
        $moduleFolders->service         = $this->getDirService()->mkDir($moduleFolders->testsUnit.'/ServiceTest');
        //$moduleFolders->controller      = $this->getDirService()->mkDir($moduleFolders->testsUnit.'/ControllerTest');
        //$moduleFolders->controller      = $this->getDirService()->mkDir($moduleFolders->testsUnit.'/ControllerTest');
        return $moduleFolders;
    }

    public function zendServiceLocator()
    {
        $zendServiceLocator = $this->getServiceLocator()->get('zendServiceLocatorService');

        $moduleFile = $this->getFileService()->mkPHP(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/',
            'ZendServiceLocator',
            $zendServiceLocator->generate()
        );
    }

    public function copyBuildXmlFile()
    {
        copy(__DIR__.'/../../Shared/build.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.xml');
    }

    public function copyBuild()
    {

        $this->copyBuildXmlFile();

        copy(__DIR__.'/../../Shared/build.sh', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.sh');

        copy(__DIR__.'/../../Shared/jenkins/phpmd.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpmd.xml');

        copy(
            __DIR__.'/../../Shared/jenkins/phpunit-fast-coverage.xml',
            $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit-fast-coverage.xml'
        );

        copy(__DIR__.'/../../Shared/jenkins/phpunit.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit.xml');
        copy(__DIR__.'/../../Shared/jenkins/phpunitci.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunitci.xml');

        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.sh');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpmd.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit-fast-coverage.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunitci.xml');

        return true;
    }

    // _data

    // _support

    //acceptance

    //functional

    //unit

    //Pages

    //acceptance.suite.yml

    //functional.suite.yml

    //unit.suite.yml

    //Boostrap File

    //Service Locator File

    //Guy Tester

}
