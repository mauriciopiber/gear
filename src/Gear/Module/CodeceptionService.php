<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Zend\View\Model\ViewModel;
use Gear\Common\ModuleAwareInterface;
use Gear\ValueObject\BasicModuleStructure;

class CodeceptionService extends AbstractJsonService implements ModuleAwareInterface
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
        return $this->createFileFromTemplate(
            'template/test/_bootstrap.phtml',
            $this->basicOptions(),
            '_bootstrap.php',
            $this->getModule()->getTestFolder()
        );
    }

    public function acceptanceBootstrap()
    {
        return $this->createFileFromTemplate(
            'template/test/acceptance/_bootstrap.phtml',
            array('module' => $this->getModule()->getModuleName()),
            '_bootstrap.php',
            $this->getModule()->getTestAcceptanceFolder()
        );
    }

    public function functionalBootstrap()
    {
        return $this->createFileFromTemplate(
            'template/test/functional/_bootstrap.phtml',
            array('module' => $this->getModule()->getModuleName()),
            '_bootstrap.php',
            $this->getModule()->getTestFunctionalFolder()
        );

    }

    public function unitBootstrap()
    {
        return $this->createFileFromTemplate(
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
            throw new \Exception('O projecto necessita do webhost em local.php configurado corretamente, de acordo com o que consta no specifications');
        }
        return $config['webhost'***REMOVED***;
    }

    public function guyTester()
    {
        return $this->createFileFromTemplate(
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
        return $this->createFileFromTemplate(
            'template/test/acceptance/AcceptanceTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'AcceptanceTester.php',
            $this->getModule()->getTestAcceptanceFolder()
        );
    }

    public function uploadImageHelper()
    {
        return $this->createFileFromTemplate(
            'template/test/support/upload-image-helper.phtml',
            $this->basicOptions(),
            'UploadImageHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
    }

    public function acceptanceHelper()
    {
        return $this->createFileFromTemplate(
            'template/test/support/AcceptanceHelper.phtml',
            $this->basicOptions(),
            'AcceptanceHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
    }

    public function functionalTester()
    {
        return $this->createFileFromTemplate(
            'template/test/functional/FunctionalTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'FunctionalTester.php',
            $this->getModule()->getTestFunctionalFolder()
        );
    }

    public function unitTester()
    {
        return $this->createFileFromTemplate(
            'template/test/unit/UnitTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'UnitTester.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
    }

    public function functionalHelper()
    {
        return $this->createFileFromTemplate(
            'template/test/support/FunctionalHelper.phtml',
            $this->basicOptions(),
            'FunctionalHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
    }

    public function unitHelper()
    {
        return $this->createFileFromTemplate(
            'template/test/support/UnitHelper.phtml',
            $this->basicOptions(),
            'UnitHelper.php',
            $this->getModule()->getTestSupportFolder()
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
        $fileCreator->setOptions( array_merge(
                array(
                    'url' => $this->getBaseUrl(),
                    'moduleUline' => $this->str('uline', $this->getModule()->getModuleName()),
                    'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
                ),
                $this->basicOptions(),
                $this->dbOptions()
            ));
        $fileCreator->setFileName('codeception.yml');
        $fileCreator->setLocation($this->getModule()->getMainFolder());
        $fileCreator->render();


    }



    public function unitSuiteYml()
    {
        $fileCreator = $this->getServiceLocator()->get('fileCreator');
        $fileCreator->setView('template/test/unit.suite.yml.phtml');
        $fileCreator->setOptions( array_merge(
            array(
                'url' => $this->getBaseUrl()
            ),
            $this->basicOptions(),
            $this->dbOptions()
        ));
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
