<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Gear\Module\BasicModuleStructure;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
use Gear\Module\ModuleProjectConnectorInterface;

/**
 * Cria os arquivos necessários para rodar os testes utilizando codeception/codeception.
 *
 * São necessários arquivos auxiliares, além do phpunit.
 *
 */
class CodeceptionService extends AbstractJsonService implements ModuleProjectConnectorInterface
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
    }

    /**
     * Arquivo bootstrap principal.
     *
     * @return string
     */
    public function mainBootstrap()
    {
        return $this->getFileCreator()->createFile(
            'template/module/test/_bootstrap.phtml',
            array('module' => $this->getModule()->getModuleName()),
            '_bootstrap.php',
            $this->getModule()->getTestFolder()
        );
    }

    /**
     * Arquivo bootstrap dos testes unitários
     *
     * @return string
     */
    public function unitBootstrap()
    {
        return $this->getFileCreator()->createFile(
            'template/module/test/unit/_bootstrap.phtml',
            [***REMOVED***,
            '_bootstrap.php',
            $this->getModule()->getTestUnitFolder()
        );
    }

    public function unitTester()
    {
        return $this->getFileCreator()->createFile(
            'template/module/test/unit/UnitTester.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'UnitTester.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
    }

    public function unitHelper()
    {
        return $this->getFileCreator()->createFile(
            'template/module/test/support/UnitHelper.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'UnitHelper.php',
            $this->getModule()->getTestSupportFolder()
        );
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
        $fileCreator->setView('template/module/test/codeception.yml.phtml');
        $fileCreator->setOptions(
            array_merge(
                array(
                    'module' => $this->getModule()->getModuleName(),
                    'moduleUline' => $this->str('uline', $this->getModule()->getModuleName()),
                    'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
                ),
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

    /**
     * Retira um módulo deletado do arquivo codeception.xml do projeto.
     *
     * @return NULL|boolean
     */
    public function removeModuleFromProject()
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
    public function addModuleToProject()
    {

        $yaml = new Parser();

        $value = $yaml->parse(file_get_contents(\GearBase\Module::getProjectFolder().'/codeception.yml'));

        if (!isset($value['include'***REMOVED***)) {
            $value['include'***REMOVED*** = [***REMOVED***;
        }

        if (count($value['include'***REMOVED***)>0) {
            foreach ($value['include'***REMOVED*** as $i => $item) {
                if (empty($item) || $item === null || $item == '') {
                    unset($value['include'***REMOVED***[$i***REMOVED***);
                }
            }
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
