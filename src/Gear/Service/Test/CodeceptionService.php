<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;
use Zend\View\Model\ViewModel;
use Gear\Common\ModuleAwareInterface;
use Gear\ValueObject\BasicModuleStructure;

class CodeceptionService extends AbstractJsonService implements ModuleAwareInterface
{
    protected $module;

    public function createFullSuite()
    {
        $this->codeceptYml();
        $this->GuyTester();
        $this->mainBootstrap();

        $this->acceptanceSuiteYml();
        $this->acceptanceTester();
        $this->acceptanceHelper();
        $this->acceptanceBootstrap();

        $this->functionalSuiteYml();
        $this->functionalTester();
        $this->functionalHelper();
        $this->functionalBootstrap();

        $this->unitSuiteYml();
        $this->unitTester();
        $this->unitHelper();
        $this->unitBootstrap();


        $this->loginCommons();

        $this->loadSql();
    }


    public function mainBootstrap()
    {
        return $this->createFileFromTemplate(
            'template/test/_bootstrap.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            '_bootstrap.php',
            $this->getModule()->getTestFolder()
        );
    }

    public function acceptanceBootstrap()
    {
        return $this->createFileFromTemplate(
            'template/test/acceptance/_bootstrap.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            '_bootstrap.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/acceptance'
        );
    }

    public function functionalBootstrap()
    {
        return $this->createFileFromTemplate(
            'template/test/functional/_bootstrap.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            '_bootstrap.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/functional'
        );

    }

    public function unitBootstrap()
    {
        return $this->createFileFromTemplate(
            'template/test/unit/_bootstrap.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            '_bootstrap.php',
            $this->getModule()->getTestUnitFolder()
        );
    }


    public function getBaseUrl()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['url'***REMOVED***;
    }

    public function guyTester()
    {
        return $this->createFileFromTemplate(
            'template/test/GuyTester.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            'GuyTester.php',
            $this->getModule()->getTestFolder()
        );
    }

    public function loadSql()
    {
        return $this->getFileService()->emptyFile(
            $this->getModule()->getTestDataFolder(),
            sprintf('%s.sqlite', $this->str('uline', $this->getConfig()->getModule()))
        );
    }

    public function acceptanceTester()
    {
        return $this->createFileFromTemplate(
            'template/test/acceptance/AcceptanceTester.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            'AcceptanceTester.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/acceptance/'
        );
    }

    public function acceptanceHelper()
    {
        return $this->createFileFromTemplate(
            'template/test/support/AcceptanceHelper.phtml',
            array(),
            'AcceptanceHelper.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/_support/'
        );
    }

    public function functionalTester()
    {
        return $this->createFileFromTemplate(
            'template/test/functional/FunctionalTester.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            'FunctionalTester.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/functional/'
        );
    }

    public function unitTester()
    {
        return $this->createFileFromTemplate(
            'template/test/unit/UnitTester.phtml',
            array('namespace' => $this->getConfig()->getModule()),
            'UnitTester.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/unit/'
        );
    }

    public function functionalHelper()
    {
        return $this->createFileFromTemplate(
            'template/test/support/FunctionalHelper.phtml',
            array(),
            'FunctionalHelper.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/_support/'
        );
    }

    public function unitHelper()
    {
        return $this->createFileFromTemplate(
            'template/test/support/UnitHelper.phtml',
            array(),
            'UnitHelper.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/_support/'
        );
    }

    public function loginCommons()
    {
        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $fileCreator->setView('template/test/support/LoginCommons.phtml');

        $fileCreator->setOptions($this->basicOptions());

        $fileCreator->setFileName('LoginCommons.php');

        $fileCreator->setLocation($this->getModule()->getTestSupportFolder());
        return $fileCreator->render();
    }

    public function codeceptYml()
    {
        $fileCreator = $this->getServiceLocator()->get('fileCreator');
        $fileCreator->setView('template/test/codeception.yml.phtml');
        $fileCreator->setOptions($this->basicOptions());
        $fileCreator->setFileName('codeception.yml');
        $fileCreator->setLocation($this->getModule()->getMainFolder());
        return $fileCreator->render();
    }


    public function functionalSuiteYml()
    {


        $fileCreator = $this->getServiceLocator()->get('fileCreator');
        $fileCreator->setView('template/test/functional.suite.yml.phtml');
        $fileCreator->setOptions(
            array_merge(
                array(
                    'url' => $this->getBaseUrl()
                ),
                $this->basicOptions(),
                $this->dbOptions()
            )
        );
        $fileCreator->setFileName('functional.suite.yml');
        $fileCreator->setLocation($this->getModule()->getTestFolder());
        return $fileCreator->render();
    }


    public function acceptanceSuiteYml()
    {
        $fileCreator = $this->getServiceLocator()->get('fileCreator');
        $fileCreator->setView('template/test/acceptance.suite.yml.phtml');
        $fileCreator->setOptions(
            array_merge(
                array(
                    'url' => $this->getBaseUrl()
                ),
                $this->basicOptions(),
                $this->dbOptions()
            )
        );
        $fileCreator->setFileName('acceptance.suite.yml');
        $fileCreator->setLocation($this->getModule()->getTestFolder());
        return $fileCreator->render();
    }


    public function unitSuiteYml()
    {
        $fileCreator = $this->getServiceLocator()->get('fileCreator');
        $fileCreator->setView('template/test/unit.suite.yml.phtml');
        $fileCreator->setOptions(
            array_merge(
                array(
                    'url' => $this->getBaseUrl()
                ),
                $this->basicOptions(),
                $this->dbOptions()
            )
        );
        $fileCreator->setFileName('unit.suite.yml');
        $fileCreator->setLocation($this->getModule()->getTestFolder());
        return $fileCreator->render();
    }

    public function setModule(BasicModuleStructure $module)
    {
        if (!isset($this->module)) {
            $this->module = $module;
        }

        return $this;
    }

    public function getModule()
    {
        return $this->module;
    }
}
