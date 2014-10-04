<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractService;
use Zend\View\Model\ViewModel;
use Gear\Common\ModuleAwareInterface;
use Gear\ValueObject\BasicModuleStructure;

class CodeceptionService extends AbstractService implements ModuleAwareInterface
{
    protected $module;

    public function start($moduleDir)
    {
        $this->codeceptYml();

        $this->GuyTester();

        $this->acceptanceSuiteYml();
        $this->acceptanceTester();
        $this->acceptanceHelper();


        $this->functionalSuiteYml();
        $this->functionalTester();
        $this->functionalHelper();

        $this->unitSuiteYml();
        $this->unitTester();
        $this->unitHelper();

        $this->loadSql();
    }


    public function getBaseUrl()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['baseUrl'***REMOVED***['url'***REMOVED***;
    }


    public function guyTester()
    {
        return $this->createFileFromTemplate(
            'tests/GuyTester',
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

    public function acceptanceSuiteYml()
    {
        return $this->createFileFromTemplate(
            'tests/acceptance.suite.yml',
            array(
                'url' => $this->getBaseUrl(),
                'module' => $this->str('uline', $this->getConfig()->getModule())
            ),
            'acceptance.suite.yml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/'
        );
    }

    public function acceptanceTester()
    {

        return $this->createFileFromTemplate(
            'tests/acceptanceTester',
            array('namespace' => $this->getConfig()->getModule()),
            'AcceptanceTester.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/acceptance/'
        );
    }

    public function acceptanceHelper()
    {
        return $this->createFileFromTemplate(
            'tests/acceptanceHelper',
            array(),
            'AcceptanceHelper.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/_support/'
        );
    }

    public function functionalTester()
    {
        return $this->createFileFromTemplate(
            'tests/functionalTester',
            array('namespace' => $this->getConfig()->getModule()),
            'FunctionalTester.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/functional/'
        );
    }

    public function unitTester()
    {
        return $this->createFileFromTemplate(
            'tests/unitTester',
            array('namespace' => $this->getConfig()->getModule()),
            'UnitTester.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/unit/'
        );
    }

    public function functionalHelper()
    {
        return $this->createFileFromTemplate(
            'tests/functionalHelper',
            array(),
            'FunctionalHelper.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/_support/'
        );
    }

    public function unitHelper()
    {
        return $this->createFileFromTemplate(
            'tests/unitHelper',
            array(),
            'UnitHelper.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/_support/'
        );
    }


    public function codeceptYml()
    {
        return $this->createFileFromTemplate(
            'tests/codeception.yml',
            array(),
            'codeception.yml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule()
        );
    }

    public function functionalSuiteYml()
    {
        $phpRenderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();

        $config      = $this->getServiceLocator()->get('config');

        $baseUrl = 'http://'.$config['baseUrl'***REMOVED***['url'***REMOVED***;

        $view = new ViewModel(array(
            'url' => $this->getBaseUrl(),
            'module' => $this->str('uline', $this->getConfig()->getModule())
        ));
        $view->setTemplate('tests/functional.suite.yml');

        $file = $phpRenderer->render($view);

        $moduleFile = $this->getFileService()->mkYml(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/',
            'functional.suite',
            $file
        );
    }

    public function unitSuiteYml()
    {
        $phpRenderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();

        $config      = $this->getServiceLocator()->get('config');

        $baseUrl = 'http://'.$config['baseUrl'***REMOVED***['url'***REMOVED***;

        $view = new ViewModel(array(
            'url' => $this->getBaseUrl(),
            'module' => $this->str('uline', $this->getConfig()->getModule())
        ));
        $view->setTemplate('tests/unit.suite.yml');

        $file = $phpRenderer->render($view);

        $moduleFile = $this->getFileService()->mkYml(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/',
            'unit.suite',
            $file
        );
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
