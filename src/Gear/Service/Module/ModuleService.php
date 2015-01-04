<?php
namespace Gear\Service\Module;

use Zend\Db\Adapter\Adapter;
use Zend\Console\ColorInterface;
use Gear\Model\TestGear;
use Doctrine\ORM\Mapping\Entity;
use Gear\ValueObject\Config\Config;
use Gear\Service\Filesystem\DirService;
use Gear\Service\Filesystem\FileService;
use Gear\Service\AbstractService;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ModuleService extends AbstractService
{
    /** @var $fileService \Gear\Service\Filesystem\FileService */
    protected $fileService;

    /** @var $dirService \Gear\Service\Filesystem\DirService */
    protected $dirService;

    /** @var $jsonService \Gear\Service\Constructor\JsonService */
    protected $jsonService;

    protected $serviceLocator;

    public $config;


    public function createLight($options = array())
    {
        //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $module = $moduleStructure->minimal()->writeMinimal();

        /* @var $configService \Gear\Service\Mvc\ConfigService */
        $configService         = $this->getServiceLocator()->get('Gear\Service\Mvc\ConfigService');
        $configService->generateForLightModule();

        $this->createLightModuleFile();
        $this->createModuleFileAlias();
        $this->registerModule();
        /* $module = $moduleStructure->prepare()->write(); */
    }

    public function createLightModuleFile()
    {
        return $this->createFileFromTemplate(
            'template/src/light-module.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
            ),
            'Module.php',
            $this->getModule()->getSrcModuleFolder()
        );
    }


    //rodar os testes no final do processo, alterando o arquivo application.config.php do sistema principal.
    public function create($options = array())
    {


        //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $module = $moduleStructure->prepare()->write();

        //composer to use module as service of bitbucket
        /* @var $composerService \Gear\Service\Module\ComposerService */
        $composerService = $this->getServiceLocator()->get('composerService');
        $composerService->createComposer();

        $this->registerJson();

        //full suite of testes up
        /* @var $testService \Gear\Service\Module\TService */
        $testService = $this->getServiceLocator()->get('testService');
        $testService->createTests($module);
        /* @var $codeceptionService \Gear\Service\Test\CodeceptionService */
        $codeceptionService = $this->getServiceLocator()->get('codeceptionService');
        $codeceptionService->createFullSuite();

        $buildService = $this->getServiceLocator()->get('buildService');
        $buildService->copy();


        //CONTROLLER -> ACTION

        /* @var $controllerTService \Gear\Service\Mvc\ControllerTService */
        $controllerTService = $this->getServiceLocator()->get('controllerTestService');
        $controllerTService->generateAbstractClass();
        $controllerTService->generateForEmptyModule();

        /* @var $controllerService \Gear\Service\Mvc\ControllerService */
        $controllerService     = $this->getServiceLocator()->get('controllerService');
        $controllerService->generateForEmptyModule();

        /* @var $configService \Gear\Service\Mvc\ConfigService */
        $configService         = $this->getServiceLocator()->get('configService');
        $configService->generateForEmptyModule();

        /* @var $pageTService \Gear\Service\Mvc\PageTService */
        $pageTService = $this->getServiceLocator()->get('pageTestService');
        $pageTService->generateForEmptyModule();

        /* @var $acceptanceTService \Gear\Service\Mvc\AcceptanceTService */
        $acceptanceTService = $this->getServiceLocator()->get('acceptanceTestService');
        $acceptanceTService->generateForEmptyModule();

        /* @var $functionalTService \Gear\Service\Mvc\FunctionalTService */
        $functionalTService = $this->getServiceLocator()->get('functionalTestService');
        $functionalTService->generateForEmptyModule();


        $languageService = $this->getServiceLocator()->get('languageService');
        $languageService->create();

        /* @var $viewService \Gear\Service\Mvc\ViewService */
        $viewService = $this->getServiceLocator()->get('viewService');
        $viewService->createIndexView();
        $viewService->createErrorView();
        $viewService->createDeleteView();
        $viewService->create404View();
        $viewService->createLayoutView();
        $viewService->createLayoutSuccessView();
        $viewService->createLayoutDeleteSuccessView();
        $viewService->createLayoutDeleteFailView();
        $viewService->createBreadcrumbView();
        $viewService->copyBasicLayout();

        $this->createModuleFile();
        $this->createModuleFileAlias();
        $this->registerModule();

        $endtime = microtime(true);

        $console = $this->getServiceLocator()->get('Console');

        if (isset($options['build'***REMOVED***)) {
            $buildService = $this->getServiceLocator()->get('buildService');
            $output = $buildService->build(isset($options['build'***REMOVED***));
            $console->writeLine("$output", ColorInterface::RESET, 3);

        }

        return true;
    }


    public function createModuleFileAlias()
    {
        $moduleFile = $this->getFileService()->mkPHP(
            $this->getModule()->getMainFolder(),
            'Module',
            'require_once __DIR__.\'/src/'.$this->getConfig()->getModule().'/Module.php\';'.PHP_EOL
        );
        return $moduleFile;
    }

    public function createModuleFile()
    {
        $request = $this->getServiceLocator()->get('request');

        $layoutName = $request->getParam('layoutName', null);

        if ($layoutName == 'auto') {
            $layoutName = $this->str('url', $this->getConfig()->getModule());
        } elseif ($layoutName == null) {
            $layoutName = 'security-interno';
        }



        return $this->createFileFromTemplate(
            'template/src/module.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'layout' => $layoutName
            ),
            'Module.php',
            $this->getModule()->getSrcModuleFolder()
        );
    }


    public function setJsonService(\Gear\Service\Constructor\JsonService $jsonService)
    {
        $this->jsonService = $jsonService;
        return $this;
    }

    public function getJsonService()
    {
        if (!isset($this->jsonService)) {
            $this->jsonService = $this->getServiceLocator()->get('jsonService');
        }
        return $this->jsonService;
    }

    public function loadBefore($data)
    {
        $this->registerBeforeModule($data);
        return true;
    }

    /**
     * @ver 0.2.0 alias for registerModule
     */
    public function load()
    {
        $this->registerModule();
        return true;
    }

    /**
     * @ver 0.2.0 alias for unregisterModule
     */
    public function unload()
    {
        $this->unregisterModule();
        return true;
    }

    public function registerJson()
    {
        return $this->getJsonService()->registerJson();
    }

    public function dump($type)
    {
        return $this->getJsonService()->dump($type);
    }


    public function deleteModuleFolder()
    {
        return $this->getDirService()->rmDir($this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule());
    }

    public function delete()
    {
        $this->unregisterModule();
        $this->deleteModuleFolder();

        return sprintf('Módulo %s deletado', $this->getConfig()->getModule());
    }

    public function str($type, $stringToConvert)
    {
        return $this->getString()->str($type, $stringToConvert);
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Versão 0.1 - Banco de dados já criados,
     * deverá receber o Nome do Módulo a ser criado e as Entidades que quer que apareça.
     */
    public function createModule()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $this->getConfig()->setDriver($adapter->driver);

        //$this->getConfig()->setTables(array('die_food'));

        echo 'Iniciando criação dos testes unitários de Entidades'."\n";

        $entityUnit = new \Gear\Model\EntityUnitGear($this->getConfig());
        $entityUnit->generate();

        echo 'Iniciando criação das Models'."\n";

        $model = new \Gear\Model\ModelGear($this->getConfig());
        $model->generate();

        echo 'Iniciando criação dos testes unitários das Models'."\n";

        $modelUnit  = new \Gear\Model\ModelUnitGear($this->getConfig());
        $modelUnit->generate();

        echo 'Iniciando criação das Logics'."\n";

        $logic = new \Gear\Model\LogicGear($this->getConfig());
        $logic->generate();

        echo 'Iniciando criação dos testes unitários das Logis'."\n";

        $logicUnit = new \Gear\Model\LogicUnitGear($this->getConfig());
        $logicUnit->generate();

        echo 'Iniciando criação dos Forms'."\n";

        $form = new \Gear\Model\FormGear($this->getConfig());
        $form->generate();

        echo 'Iniciando criação dos Search Form'."\n";

        $search = new \Gear\Model\SearchGear($this->getConfig());
        $search->generate();

        echo 'Iniciando criação dos Filters'."\n";

        $filter = new \Gear\Model\FilterGear($this->getConfig());
        $filter->generate();

        echo 'Iniciando criação dos Controllers'."\n";

        $controller = new \Gear\Model\ControllerGear($this->getConfig());
        $controller->generate();

        echo 'Iniciando criação dos Testes unitários dos Controllers'."\n";

        $controllerTest = new \Gear\Model\ControllerUnitGear($this->getConfig());
        $controllerTest->generate();

        echo 'Iniciando criação das Views'."\n";

        $view = new \Gear\Model\ViewGear($this->getConfig());
        $view->generate();

        echo 'Iniciando criação do IndexController do Módulo'."\n";

        //$controller->createIndexController();
        //$view->createIndexView();

        echo 'Iniciando criação do arquivo Module'."\n";
        $this->makeModuleFile();

        echo 'Iniciando criação do arquivo config'."\n";

        $config = new \Gear\Model\ConfigGear($this->getConfig());
        $config->generate();

        //echo 'Iniciando criação das Fixtures'."\n";

        //$fixture  = new \Gear\Model\FixtureGear($this->getConfig());
        //$fixture->generate();

        echo 'Crud criado com sucesso'."\n";
    }



    /**
     * Função responsável por alterar o application.config.php e adicionar o novo módulo
     */
    public function registerModule()
    {
        $applicationConfig = $this->getApplicationConfig();

        $data = include $applicationConfig;

        $addValue = $this->getConfig()->getModule();

        if (empty($addValue)) {
            throw new \Exception('Please inform us what module to register!');
        }

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $data['modules'***REMOVED***[***REMOVED*** = $addValue;

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

        return true;
    }

    public function registerBeforeModule($data)
    {
        $before = $data['before'***REMOVED***;

        $data = $this->getApplicationConfigArray();

        $addValue = $this->getConfig()->getModule();

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $keyAfter = array_search($before, $data['modules'***REMOVED***);

        if ($keyAfter !== false) {
            $data['modules'***REMOVED*** = array_merge
            (
                array_slice($data['modules'***REMOVED***, 0, $keyAfter),
                array($addValue),
                array_slice($data['modules'***REMOVED***, $keyAfter, null)
            );
        } else {
            $data['modules'***REMOVED***[***REMOVED*** = $addValue;
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($this->getApplicationConfig(), '<?php return ' . $dataArray . '; ?>');

        return true;
    }

    public function getApplicationConfigArray()
    {
        $applicationConfig = $this->getApplicationConfig();
        $data = include $applicationConfig;
        return $data;
    }

    public function getApplicationConfig()
    {

        /**
         * 2 possibilidades
         */
        $module = __DIR__.'/../../../../../../config/application.config.php';

        if (is_file($module)) {
            return $module;
        }

        $vendor = __DIR__.'/../../../../../../../config/application.config.php';

        if (is_file($vendor)) {
            return $vendor;
        }

        throw new Exception('Gear can\'t get application.config.php from project');

    }

    /**
     * Função responsável por alterar o application.config.php e deletar o módulo escolhido
     */
    public function unregisterModule()
    {
        $applicationConfig = $this->getApplicationConfig();

        $data = include $applicationConfig;

        $delValue = $this->getConfig()->getModule();

        if (empty($delValue)) {
            throw new \Exception('Please inform us what module to unregister!');
        }

        if (($key = array_search($delValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

        return true;
    }

    public function push($data)
    {
        $config = $this->getModule()->getConfigFolder();

        $moduleConfig = require $config.'/module.config.php';

        if (!isset($moduleConfig['version'***REMOVED***)) {
            throw new \Exception(sprintf('Module %s was not ready for versioning', $this->getConfig()->getModule()));
        }

        $versions = explode('.', $moduleConfig['version'***REMOVED***);
        $last = end($versions);
        $lastTo = $last + 1;
        end($versions);         // move the internal pointer to the end of the array
        $key = key($versions);

        $versions[$key***REMOVED*** = $lastTo;
        $version = implode('.', $versions);

        $file = file_get_contents($config.'/module.config.php');
        $file = str_replace($moduleConfig['version'***REMOVED***, $version, $file);
        file_put_contents($config.'/module.config.php', $file);



        $description = $data['description'***REMOVED***;


        $script = realpath(__DIR__.'/../../../../script');
        $pushScript = realpath($script.'/push.sh');

        $folder = $this->getModule()->getMainFolder();

        $cmd = sprintf('%s %s %s %s', $pushScript, $folder, $version, $description);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);



        return true;




    }

    public function setString($string)
    {
        $this->string = $string;

        return $this;
    }

    public function getString()
    {
        if (!isset($this->string)) {
            $this->string = $this->getServiceLocator()->get('stringService');
        }

        return $this->string;
    }

    public function setFileService(FileService $fileService)
    {
        $this->fileService = $fileService;

        return $this;
    }

    public function getFileService()
    {
        if (!isset($this->fileService)) {
            $this->fileService = $this->getServiceLocator()->get('fileService');
        }

        return $this->fileService;
    }

    public function setDirService(DirService $dirService)
    {
        $this->dirService = $dirService;

        return $this;
    }

    public function getDirService()
    {
        if (!isset($this->dirService)) {
            $this->dirService = $this->getServiceLocator()->get('dirService');
        }

        return $this->dirService;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->sm;
    }
}
