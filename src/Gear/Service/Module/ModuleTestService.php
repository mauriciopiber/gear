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
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ModuleTestService extends AbstractService
{

    public function acceptanceSuiteYml()
    {

        $file = '';

        $file .= $this->powerline(0,'class_name: AcceptanceTester');
        $file .= $this->powerline(0,'modules:');
        $file .= $this->powerline(1,'   enabled: [WebDriver, Db***REMOVED***');
        $file .= $this->powerline(1,'   config:');

        $file .= $this->getWebDiver();
        $file .= $this->getDb();

        $moduleFile = $this->getFileService()->mkYml(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/',
            'acceptance.suite',
            $file
        );

    }

    public function functionalSuiteYml()
    {
        $file = '';

        $file .= $this->powerline(0,'class_name: FunctionalTester');
        $file .= $this->powerline(0,'modules:');
        $file .= $this->powerline(1,'   enabled: [Filesystem, FunctionalHelper, WebDriver, Db***REMOVED***');
        $file .= $this->powerline(1,'   config:');
        $file .= $this->getWebDiver();
        $file .= $this->getDb();

        $moduleFile = $this->getFileService()->mkYml(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/',
            'functional.suite',
            $file
        );
    }

    public function unitSuiteYml()
    {
        $file = '';

        $file .= $this->powerline(0,'class_name: UnitTester');
        $file .= $this->powerline(0,'modules:');
        $file .= $this->powerline(1,'   enabled: [Asserts, UnitHelper, Db***REMOVED***');
        $file .= $this->powerline(1,'   config:');

        $file .= $this->getDb();

        $moduleFile = $this->getFileService()->mkYml(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/',
            'unit.suite',
            $file
        );
    }

    public function getWebDiver()
    {
        $file = '';
        $file .= $this->powerline(2,'WebDriver:');
        $file .= $this->powerline(3,'url: \'http://modules.gear.dev/\'');
        $file .= $this->powerline(3,'browser: phantomjs');
        $file .= $this->powerline(3,'capabilities:');
        $file .= $this->powerline(4,'webStorageEnabled: true');
        return $file;
    }

    public function getDb()
    {
        $file = '';
        $file .= $this->powerline(2,'Db:');
        $file .= $this->powerline(3,'dsn: \'sqlite:data/%s\'',array($this->str('url',$this->getConfig()->getModule())));
        $file .= $this->powerline(3,'    user: \'root\'');
        $file .= $this->powerline(3,'        password: \'gear\'');
        $file .= $this->powerline(3,'            dump: tests/_data/sqlite.%s.sql',array($this->str('url',$this->getConfig()->getModule())));

        return $file;
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
