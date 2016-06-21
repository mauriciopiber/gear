<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Gear\Module\BasicModuleStructure;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;

class CodeceptionService extends AbstractJsonService
{
    protected $module;

    /**
     * Utilizado ao criar um módulo
     */
    public function createFullSuite()
    {
        $this->codeceptYml();
        $this->mainBootstrap();
        $this->unitSuiteYml();
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
        $fileCreator->setView('template/module/test/unit.suite.yml.phtml');
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


    /**
     * Retira um módulo deletado do arquivo codeception.xml do projeto.
     *
     * @return NULL|boolean
     */
    public function dropFromCodeceptionProject()
    {
        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents(\GearBase\Module::getProjectFolder().'/codeception.yml'));

        if (!isset($value['include'***REMOVED***)) {
            return null;
        }

        $key = array_search('module/'.$this->getModule()->getModuleName(), $value['include'***REMOVED***);

        if (!$key) {
            return null;
        }

        unset($value['include'***REMOVED***[$key***REMOVED***);

        $dumper = new Dumper();

        $yaml = $dumper->dump($value, 4);

        file_put_contents(\GearBase\Module::getProjectFolder().'/codeception.yml', $yaml);

        return true;
    }

    /**
     * Adiciona um novo módulo ao arquivo de configuração codeception.yml
     *
     * @return boolean
     */
    public function appendIntoCodeceptionProject()
    {

        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents(\GearBase\Module::getProjectFolder().'/codeception.yml'));


        if (!isset($value['include'***REMOVED***)) {
            $value['include'***REMOVED*** = [***REMOVED***;
        }

        if (in_array('module/'.$this->getModule()->getModuleName(), $value['include'***REMOVED***)) {
            return true;
        }

        $value['include'***REMOVED***[***REMOVED*** = 'module/'.$this->getModule()->getModuleName();

        $dumper = new Dumper();

        $yaml = $dumper->dump($value, 4);

        file_put_contents(\GearBase\Module::getProjectFolder().'/codeception.yml', $yaml);

        return true;
    }
}
