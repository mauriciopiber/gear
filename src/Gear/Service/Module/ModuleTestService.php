<?php
namespace Gear\Service\Module;

use Zend\Db\Adapter\Adapter;
use Gear\Model\MakeGear;
use Gear\Model\TestGear;
use Doctrine\ORM\Mapping\Entity;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\ValueObject\Config\Config;
use Gear\Service\Filesystem\DirService;

use Gear\Service\Filesystem\FileService;
use Gear\Common\DirServiceAwareInterface;
use Gear\Common\ClassServiceAwareInterface;
use Gear\Common\FileServiceAwareInterface;
use Gear\Common\StringServiceAwareInterface;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
use Gear\Service\AbstractService;
use Zend\Code\Generator\FileGenerator;
use Zend\View\Model\ViewModel;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ModuleTestService extends AbstractService
{

    public function createTests($moduleDir)
    {
        $testsFolders = $this->createModuleFolders();

        $codeceptService = $this->getServiceLocator()->get('codeceptService');
        $codeceptService->start($moduleDir);

        $this->zendServiceLocator();

        $this->bootstrap();

        $this->copyBuild();

        return true;
    }

    public function createBootstrapFileByTemplate($template, $name, $folder = '')
    {
        //create main bootstrap
        $phpRenderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();

        $view = new ViewModel(array('namespace' => $this->getConfig()->getModule()));
        $view->setTemplate($template);

        $template  = $phpRenderer->render($view);

        $this->getFileService()->mkPHP(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/'.$folder,
            $name,
            $template
        );
    }

    public function bootstrap()
    {

        $this->createFileFromTemplate('tests/_bootstrap', array(), '_bootstrap', $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/');
        $this->createFileFromTemplate('tests/acceptance/_bootstrap', array(), '_bootstrap', $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/acceptance');
        $this->createFileFromTemplate('tests/functional/_bootstrap', array(), '_bootstrap', $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/functional');
        $this->createFileFromTemplate('tests/unit/_bootstrap', array(), '_bootstrap', $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/unit');
    }

    public function createModuleFolders()
    {

        $moduleFolders = new \stdClass();
        $moduleFolders->tests          = $this->getDirService()->mkDir($this->getConfig()->getModuleFolder().'/tests');
        $moduleFolders->testsData      = $this->getDirService()->mkDir($moduleFolders->tests.'/_data');
        $moduleFolders->testsSupport   = $this->getDirService()->mkDir($moduleFolders->tests.'/_support');
        $moduleFolders->testsPages     = $this->getDirService()->mkDir($moduleFolders->tests.'/Pages');
        $moduleFolders->acceptance     = $this->getDirService()->mkDir($moduleFolders->tests.'/acceptance');
        $moduleFolders->functional     = $this->getDirService()->mkDir($moduleFolders->tests.'/functional');
        $moduleFolders->unit           = $this->getDirService()->mkDir($moduleFolders->tests.'/unit');
        $moduleFolders->testsUnit      = $this->getDirService()->mkDir($moduleFolders->unit.'/'.$this->getConfig()->getModule());

        return $moduleFolders;
    }


    public function zendServiceLocator()
    {
        $zendServiceLocator = $this->getServiceLocator()->get('zendServiceLocatorService');

        $moduleFile = $this->getFileService()->mkPHP(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/',
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
