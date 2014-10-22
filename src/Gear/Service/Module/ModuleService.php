<?php
namespace Gear\Service\Module;

use Zend\Db\Adapter\Adapter;
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
    protected $fileService;
    protected $dirService;
    protected $moduleFileService;
    protected $serviceLocator;
    public $config;

    public function __construct($fileWriteService, $string)
    {
        $this->setFileService($fileWriteService);
        $this->setString($string);
    }

    //rodar os testes no final do processo, alterando o arquivo application.config.php do sistema principal.
    public function createEmptyModule($build = false)
    {
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $module = $moduleStructure->prepare()->write();

        $starttime = microtime(true);

        /* @var $composerService \Gear\Service\Module\ComposerService */
        $composerService = $this->getServiceLocator()->get('composerService');
        $composerService->createComposer();

        /* @var $testService \Gear\Service\Module\TService */
        $testService = $this->getServiceLocator()->get('testService');
        $testService->createTests($module);

        $buildService = $this->getServiceLocator()->get('buildService');
        $buildService->copy();

        /* @var $codeceptionService \Gear\Service\Test\CodeceptionService */
        $codeceptionService = $this->getServiceLocator()->get('codeceptionService');
        $codeceptionService->createFullSuite();

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

        /* @var $viewService \Gear\Service\Mvc\ViewService */
        $viewService = $this->getServiceLocator()->get('viewService');
        $viewService->createIndexView();
        $viewService->createErrorView();
        $viewService->create404View();
        $viewService->createLayoutView();
        $viewService->createBreadcrumbView();
        $viewService->copyBasicLayout();

        $this->createModuleFile();
        $this->createModuleFileAlias();
        $this->registerJson();
        $this->registerModule();

        $endtime = microtime(true);

        $output =  "End time: $endtime\n";

        $executionTime = ($endtime - $starttime);//gets run time in secs
        $executionTime = round($executionTime, 2);//makes time two decimal places long
        $output .= 'Total Execution Time: '.$executionTime." Secs\n";

        if ($build) {
            $buildService = $this->getServiceLocator()->get('buildService');
            $output .= $buildService->build($build);

        }

        return $output."\n".'Modulo criado com sucesso'."\n";
    }

    public function createModuleFileAlias()
    {
        $moduleFile = $this->getFileService()->mkPHP(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule(),
            'Module',
            'require_once __DIR__.\'/src/'.$this->getConfig()->getModule().'/Module.php\';'.PHP_EOL
        );
        return $moduleFile;
    }

    public function createModuleFile()
    {
        return $this->createFileFromTemplate(
            'module',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
            ),
            'Module.php',
            sprintf(
                '%s/module/%s/src/%s',
                $this->getConfig()->getLocal(),
                $this->getConfig()->getModule(),
                $this->getConfig()->getModule()
            )
        );
    }



    public function registerJson()
    {
        $jsonService = $this->getServiceLocator()->get('jsonService');

        return $jsonService->registerJson();
    }

    public function dump($type)
    {
        $jsonService = $this->getServiceLocator()->get('jsonService');

        return $jsonService->dump($type);
    }


    public function deleteModuleFolder()
    {
        return $this->getDirService()->rmDir($this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule());
    }

    public function delete()
    {
        $this->unregisterModule();
        $this->deleteModuleFolder();

        return sprintf('Módulo deletado');
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

    public function generate()
    {

        $this->makeModuleFile();
    }

    public function createIndexController()
    {
        $controllerUnit = new ControllerUnitGear($this->getConfig());
        $controllerUnit->createIndexController($this->struct);

        $controller = new ControllerGear($this->getConfig());
        $controller->createIndexController($this->struct);

        $view = new ViewGear($this->getConfig());
        $view->createIndexView($this->struct);
    }

    public function makeModuleFolder($name)
    {
        return $this->mkDir($this->getLocal().'/module/'.$name);
    }


    /**
     * Função responsável por alterar o application.config.php e adicionar o novo módulo
     */
    public function registerModule()
    {
        $applicationConfig = $this->getApplicationConfig();

        $data = include $applicationConfig;

        $addValue = $this->getConfig()->getModule();

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $data['modules'***REMOVED***[***REMOVED*** = $addValue;

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

        return true;
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

        if (($key = array_search($delValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');

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
