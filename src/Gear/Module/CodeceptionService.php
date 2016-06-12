<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Zend\View\Model\ViewModel;
use Gear\Module\BasicModuleStructure;

class CodeceptionService extends AbstractJsonService
{
    protected $module;

    /**
     * Utilizado ao criar um módulo
     */
    public function createFullSuite()
    {
        /* $acceptance = $this->getAcceptanceTestService();
        $acceptance->buildUpAcceptance();
        $functional = $this->getFunctionalTestService();
        $functional->buildUpFunctional(); */

        $this->codeceptYml();
        //$this->GuyTester();
        $this->mainBootstrap();

     /*    $this->acceptanceSuiteYml();
        //$this->acceptanceTester();
        $this->acceptanceHelper();
        $this->acceptanceBootstrap();

        $this->functionalSuiteYml();
        //$this->functionalTester();
        $this->functionalHelper();
        $this->functionalBootstrap(); */

        $this->unitSuiteYml();
        //$this->unitTester();
        $this->unitHelper();
        $this->unitBootstrap();

        $this->uploadImageHelper();

        $this->loginCommons();

        $this->loadSql();
    }


    public function mainBootstrap()
    {
        return $this->getFileCreator()->createFile(
            'template/test/_bootstrap.phtml',
            $this->basicOptions(),
            '_bootstrap.php',
            $this->getModule()->getTestFolder()
        );
    }

    public function acceptanceBootstrap()
    {
        return $this->getFileCreator()->createFile(
            'template/test/acceptance/_bootstrap.phtml',
            array('module' => $this->getModule()->getModuleName()),
            '_bootstrap.php',
            $this->getModule()->getTestAcceptanceFolder()
        );
    }

    public function functionalBootstrap()
    {
        return $this->getFileCreator()->createFile(
            'template/test/functional/_bootstrap.phtml',
            array('module' => $this->getModule()->getModuleName()),
            '_bootstrap.php',
            $this->getModule()->getTestFunctionalFolder()
        );

    }

    public function unitBootstrap()
    {
        return $this->getFileCreator()->createFile(
            'template/test/unit/_bootstrap.phtml',
            array('module' => $this->getModule()->getModuleName()),
            '_bootstrap.php',
            $this->getModule()->getTestUnitFolder()
        );
    }


    public function getBaseUrl()
    {
        $config = $this->getServiceLocator()->get('config');
        if (!isset($config['webhost'***REMOVED***) || empty($config['webhost'***REMOVED***)) {
            throw new \Exception(
                'O projecto necessita do webhost em local.php configurado corretamente, '
                . 'de acordo com o que consta no specifications'
            );
        }
        return $config['webhost'***REMOVED***;
    }

    public function guyTester()
    {
        return $this->getFileCreator()->createFile(
            'template/test/GuyTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'GuyTester.php',
            $this->getModule()->getTestFolder()
        );
    }

    public function loadSql()
    {
        return $this->getFileService()->emptyFile(
            $this->getModule()->getTestDataFolder(),
            sprintf('%s.sqlite', $this->str('uline', $this->getModule()->getModuleName()))
        );
    }

    public function acceptanceTester()
    {
        return $this->getFileCreator()->createFile(
            'template/test/acceptance/AcceptanceTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'AcceptanceTester.php',
            $this->getModule()->getTestAcceptanceFolder()
        );
    }

    public function uploadImageHelper()
    {
        return $this->getFileCreator()->createFile(
            'template/test/support/upload-image-helper.phtml',
            $this->basicOptions(),
            'UploadImageHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
    }

    public function acceptanceHelper()
    {
        return $this->getFileCreator()->createFile(
            'template/test/support/AcceptanceHelper.phtml',
            $this->basicOptions(),
            'AcceptanceHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
    }

    public function functionalTester()
    {
        return $this->getFileCreator()->createFile(
            'template/test/functional/FunctionalTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'FunctionalTester.php',
            $this->getModule()->getTestFunctionalFolder()
        );
    }

    public function unitTester()
    {
        return $this->getFileCreator()->createFile(
            'template/test/unit/UnitTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'UnitTester.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
    }

    public function functionalHelper()
    {
        return $this->getFileCreator()->createFile(
            'template/test/support/FunctionalHelper.phtml',
            $this->basicOptions(),
            'FunctionalHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
    }

    public function unitHelper()
    {
        return $this->getFileCreator()->createFile(
            'template/test/support/UnitHelper.phtml',
            $this->basicOptions(),
            'UnitHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
    }

    public function loginCommons()
    {
        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/test/support/LoginCommons.phtml');

        $fileCreator->setOptions($this->basicOptions());

        $fileCreator->setFileName('LoginCommons.php');

        $fileCreator->setLocation($this->getModule()->getTestSupportFolder());
        return $fileCreator->render();
    }


    public function dbOptions()
    {
        $arrayConfig = $this->getServiceLocator()->get('config');

        return array(
            'username' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['user'***REMOVED***,
            'password' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['password'***REMOVED***,
            'database' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***
        );
    }


    public function codeceptYml()
    {
        $fileCreator = $this->getFileCreator();
        $fileCreator->setView('template/test/codeception.yml.phtml');
        $fileCreator->setOptions(
            array_merge(
                array(
                    'url' => $this->getBaseUrl(),
                    'moduleUline' => $this->str('uline', $this->getModule()->getModuleName()),
                    'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
                ),
                $this->basicOptions(),
                $this->dbOptions()
            )
        );
        $fileCreator->setFileName('codeception.yml');
        $fileCreator->setLocation($this->getModule()->getMainFolder());
        return $fileCreator->render();
    }



    public function unitSuiteYml()
    {
        $fileCreator = $this->getFileCreator();
        $fileCreator->setView('template/test/unit.suite.yml.phtml');
        $fileCreator->setOptions([***REMOVED***);
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
