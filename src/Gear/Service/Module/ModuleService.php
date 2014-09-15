<?php
namespace Gear\Service\Module;

use Zend\Db\Adapter\Adapter;
use Gear\Model\MakeGear;
use Gear\Model\TestGear;
use Doctrine\ORM\Mapping\Entity;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\ValueObject\Config\Config;
use Gear\Service\Filesystem\DirService;
use Gear\Common\DirServiceAwareInterface;
use Gear\Service\Filesystem\FileService;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ModuleService implements
  ServiceLocatorAwareInterface,
  DirServiceAwareInterface
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

    /**
     * Função responsável por criar uma estrutura básica para receber informações
     * @param array $post Dados de configuração
     */
    public function createEmptyModule()
    {
        //inicia a estrutura de pastas
        $modulefiles = $this->createModuleFolders();


        $this->makeModuleFile();


        $this->registerModule();
        /*  //cria o arquivo de módulo


        //cria o arquivo de configuração
        $configGear = new ConfigGear($this->getConfig());
        $configGear->makeConfig(array('index'), $this->struct->config, 'yml');

        //cria os testes básicos
        $testGear = new TestGear($this->getConfig());
        $testGear->initTest($this->struct->testsubmodule);

        //cria o controller index e a ação index
        $this->createIndexController();

        //cria o layout padrão
        $layoutGear = new \Gear\Model\LayoutGear($this->getConfig());
        $layoutGear->generate();
        //$this->registerModule($module); */

        //rodar os testes no final do processo, alterando o arquivo application.config.php do sistema principal.
        echo 'Realizado com sucesso'."\n";

        return true;
    }


    public function createModuleFolders()
    {
        $moduleName = $this->str('class', $this->getConfig()->getModule());

        $moduleFolder = $this->getConfig()->getLocal().'/module/'.$moduleName;

        $moduleFolders = new \stdClass();

        $moduleFolders->module         = $this->getDirService()->mkDir($moduleFolder);

        $moduleFolders->config         = $this->getDirService()->mkDir($moduleFolders->module.'/config');

        $moduleFolders->build          = $this->getDirService()->mkDir($moduleFolders->module.'/build');

        $moduleFolders->tests          = $this->getDirService()->mkDir($moduleFolders->module.'/tests');

        $moduleFolders->data           = $this->getDirService()->mkDir($moduleFolders->module.'/data');

        $moduleFolders->language       = $this->getDirService()->mkDir($moduleFolders->module.'/language');

        $moduleFolders->src            = $this->getDirService()->mkDir($moduleFolders->module.'/src');
        $moduleFolders->submodule      = $this->getDirService()->mkDir($moduleFolders->src.'/'.$moduleName);

        $moduleFolders->controller     = $this->getDirService()->mkDir($moduleFolders->submodule.'/Controller');

        $moduleFolders->entity         = $this->getDirService()->mkDir($moduleFolders->submodule.'/Entity');
        $moduleFolders->factory        = $this->getDirService()->mkDir($moduleFolders->submodule.'/Factory');
        $moduleFolders->filter         = $this->getDirService()->mkDir($moduleFolders->submodule.'/Filter');
        $moduleFolders->form           = $this->getDirService()->mkDir($moduleFolders->submodule.'/Form');
        $moduleFolders->repository     = $this->getDirService()->mkDir($moduleFolders->submodule.'/Repository');
        $moduleFolders->service        = $this->getDirService()->mkDir($moduleFolders->submodule.'/Service');


        $moduleFolders->view           = $this->getDirService()->mkDir($moduleFolders->module.'/view');
        $moduleFolders->viewsubmodule  = $this->getDirService()->mkDir($moduleFolders->view.'/'.$this->str('url',$moduleName));
        $moduleFolders->layout         = $this->getDirService()->mkDir($moduleFolders->view.'/layout');

        return $moduleFolders;
    }

    public function makeModuleFile()
    {
        $moduleFile = $this->getServiceLocator()->get('moduleFileService');
        $moduleFile->setConfig($this->getConfig());

        $file = $moduleFile->generate();

        $moduleFile = $this->getFileService()->mkPHP(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/src/'.$this->getConfig()->getModule(),
            'Module',
            $file
        );

        $moduleFile = $this->getFileService()->mkPHP(
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule(),
            'Module',
            'require_once __DIR__.\'/src/'.$this->getConfig()->getModule().'/Module.php\';'.PHP_EOL
        );

        return $moduleFile;
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


    public function createPages()
    {
        //ler Json
        //verificar se módulo existe, se não existe criar.
        //verificar se páginas já existem, se não existe criar.
        //verificar se segurança já existem, se não existem criar.
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

        $fixture  = new \Gear\Model\FixtureGear($this->getConfig());
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



    public function initCrudStructure($modName,$tablesName,$moduleFolders,$dbAdapter)
    {
        $testGear    = new TestGear();
        $modelUnit  = new ModelUnitGear();
        $model       = new ModelGear();
        $contrUnit  = new ControllerUnitGear();
        $controller  = new ControllerGear();
        $form        = new FormGear();
        $filterGear  = new FilterGear();
        $view        = new ViewGear();

        //Testes unitários para os Models
        $modelUnit->createModuleController($tablesName,$modName,$moduleFolders->testcontroller);

        //Models
        $model->createModuleModel($tablesName,$modName,$moduleFolders->model,$moduleFolders->testmodel);

        //Testes unitários para os Controllers
        $contrUnit->createModuleController($tablesName,$modName,$moduleFolders->testcontroller);

        //Controllers
        $controller->createModuleController($tablesName,$modName,$moduleFolders->controller,$moduleFolders->testcontroller);

        //Forms
        $form->setAdapter($dbAdapter);
        $form->createModuleForm($modName,$tablesName,$moduleFolders->form,$moduleFolders->filter);

        //Filters
        $filterGear->setAdapter($dbAdapter);
        $filterGear->createModuleFilter($modName,$tablesName,$moduleFolders->filter);

        //Views
        $view->setAdapter($dbAdapter);
        $view->createModuleView($modName,$tablesName,$moduleFolders->viewsubmodule);

        return true;
    }



    public function getFunctionAutoloaderConfig()
    {
        $b = '';
        $b .= $this->getIndent(1).trim("public function getAutoloaderConfig()").PHP_EOL;
        $b .= $this->getIndent(1).trim("{").PHP_EOL;
        $b .= $this->getIndent(2).trim("    return array(").PHP_EOL;
        $b .= $this->getIndent(3).trim("        'Zend\Loader\ClassMapAutoloader' => array(").PHP_EOL;
        $b .= $this->getIndent(4).trim("            __DIR__ . '/autoload_classmap.php',").PHP_EOL;
        $b .= $this->getIndent(3).trim("        ),").PHP_EOL;
        $b .= $this->getIndent(3).trim("        'Zend\Loader\StandardAutoloader' => array(").PHP_EOL;
        $b .= $this->getIndent(4).trim("            'namespaces' => array(").PHP_EOL;
        $b .= $this->getIndent(5).trim("                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,").PHP_EOL;
        $b .= $this->getIndent(4).trim("            ),").PHP_EOL;
        $b .= $this->getIndent(3).trim("        ),").PHP_EOL;
        $b .= $this->getIndent(2).trim("    );").PHP_EOL;
        $b .= $this->getIndent(1).trim("}").PHP_EOL;
        return $b;
    }

    /**
     * Função responsável por alterar o application.config.php e adicionar o novo módulo
     */
    public function registerModule()
    {
        $applicationConfig = __DIR__.'/../../../../../../config/application.config.php';

        $data = include $applicationConfig;

        $data['modules'***REMOVED***[***REMOVED*** = $this->getConfig()->getModule();

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($applicationConfig, '<?php return ' . $dataArray . '; ?>');
        /*
        $module = $this->str('class',$module);
        $basedir = realpath($this->getLocal().'/config');
        $file = file_get_contents($basedir.'/application.config.php');
        //preg_match('/\[(\{(.*)\s\})\***REMOVED***/', $file, $matches );
        preg_match_all('/\'[(a-zA-Z)***REMOVED****\'/', $file, $matches );
        $lastKey = end($matches[0***REMOVED***);
        $lenght = strlen($lastKey);
        $pos = strpos($file, $lastKey)+$lenght+1;
        //$pos = strpos($file, $lastKey)+$lenght+1;
        //echo substr($file, $pos-1, 1);
         //die('fim');
        $virgula = (substr($file, $pos-1, 1) != ',') ? ',' : '';
        $str = substr($file, 0, $pos-1).$virgula."\n        ".'\''.$module.'\''.substr($file, $pos);
        $update = file_put_contents($basedir.'/application.config.php',$str);
        return true;
        */
    }

    /**
     * Função responsável por alterar o application.config.php e deletar o módulo escolhido
     */
    public function unregisterModule($module)
    {


        /*
        $module = $this->str('class',$module);
        $basedir = realpath($this->getLocal().'/config');
        $file = file_get_contents($basedir.'/application.config.php');
        $file_update = preg_replace('/\''.$module.'\'/',"",$file);
        $update = file_put_contents($basedir.'/application.config.php',$file_update);
        if($update) {
            return true;
        } else {
            return false;
        }
        */
    }

    public function getFunctionGetConfig()
    {
        $b = '';
        $b .= $this->getIndent(1).trim("public function getConfig()").PHP_EOL;
        $b .= $this->getIndent(1).trim("{").PHP_EOL;
        $b .= $this->getIndent(2).trim("    return include __DIR__ . '/config/module.config.php';").PHP_EOL;
        $b .= $this->getIndent(1).trim("}").PHP_EOL;
        $b .= PHP_EOL;
        return $b;
    }

    public function getUse()
    {
        return 'use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;'.PHP_EOL.PHP_EOL;
    }

    public function getInit()
    {
        $b  = '';
        $b  = $this->getIndent(1).trim('public function init(\Zend\ModuleManager\ModuleManager $moduleManager)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $moduleManager->getEventManager()->getSharedManager()->attach(__NAMESPACE__, \'dispatch\', function ($event) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $event->getTarget()->layout(\'layout/'.$this->str('url',$this->getModule()).'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    });').PHP_EOL;
        $b .= $this->getIndent(1).trim(' }').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getModuleFileService()
    {
        return $this->moduleFileService;
    }

    public function setModuleFileService(ModuleFileService $moduleFileService)
    {
        if (!isset($this->moduleFileService)) {
            $this->moduleFileService = $moduleFileService;
        }
        return $this->moduleFileService;
    }


    public function getServiceConfig($module)
    {
        $b = $this->powerline(1,'/**');
        $b .= $this->powerline(1,' * @SuppressWarnings(PHPMD.ExcessiveMethodLength)');
        $b .= $this->powerline(1,' * @SuppressWarnings(PHPMD.CyclomaticComplexity)');
        $b .= $this->powerline(1,'*/');
        $b .= $this->getIndent(1).trim('public function getServiceConfig()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        $b .= $this->getIndent(2).trim('return array(').PHP_EOL;


        //invokables
        $b .= $this->getIndent(3).trim('    \'invokables\' => array(').PHP_EOL;
        $entities = $this->getConfig()->getTables();
        //var_dump($entities);die();
        //make all model
        if(count($entities)>0) {
            foreach($entities as $i => $v) {
                $b .= $this->getIndent(4).trim('\'model_'.$this->str('uline',$this->getFileName($this->str('class',$v))).'\' => \''.$this->str('class',$module).'\Model\\'.$this->getFileName($this->str('class',$v)).'Model\',').PHP_EOL;
            }
        }
        //make all logic
        if(count($entities)>0) {
            foreach($entities as $i => $v) {
                $b .= $this->getIndent(4).trim('\'logic_'.$this->str('uline',$this->getFileName($this->str('class',$v))).'\' => \''.$this->str('class',$module).'\Logic\\'.$this->getFileName($this->str('class',$v)).'Logic\',').PHP_EOL;
            }
        }

        $b .= $this->getIndent(3).trim('     ),').PHP_EOL;
        //factories

        $b .= $this->getIndent(3).trim('    \'factories\' => array(').PHP_EOL;

        if(count($entities)>0) {
            $tableService = $this->getConfig()->getServiceLocator()->get('tableService');
            foreach($entities as $i => $v) {
                $tableUline = $this->str('uline',$this->getFileName($this->str('class',$v)));
                $tableClass = $this->getFileName($this->str('class',$v));
                $b .= $this->getIndent(4).trim(' \'form_'.$tableUline.'\' => function ($serviceLocator) {').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $entityManager = $serviceLocator->get(\'doctrine.entitymanager.orm_default\');').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $form = new \\'.$this->getModule().'\Form\\'.$tableClass.'Form($entityManager);').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $hydrator = new DoctrineEntity($entityManager, \''.$this->getModule().'\Entity\\'.$this->str('class',$v).'\');').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $form->setHydrator($hydrator);').PHP_EOL;


                $table = $tableService->getTable($tableUline);
                var_dump($table->getHasUnique());

                $b .= $this->getIndent(5).trim('    $filter = new \\'.$this->getModule().'\Filter\\'.$tableClass.'Filter(').PHP_EOL;
                $b .= $this->getIndent(6).trim('        $serviceLocator->get(\'Zend\Db\Adapter\Adapter\')').PHP_EOL;
                $b .= $this->getIndent(5).trim('    );').PHP_EOL;

                if ($table->getHasUnique() == true) {

                    $b .= $this->powerLine(5 ,'$request = $serviceLocator->get(\'Request\');');
                    $b .= $this->powerLine(5 ,'if (preg_match(\'/editar/\', $request->getUri())) {');
                    $b .= $this->powerLine(6 ,'    if (preg_match(\'/[0-9***REMOVED****$/\', $request->getUri()->getPath(), $match)) {');
                    $b .= $this->powerLine(7 ,'        $id%s = $match[0***REMOVED***;', $tableClass);
                    $b .= $this->powerLine(6 ,'    }');
                    $b .= $this->powerLine(5 ,'} else {');
                    $b .= $this->powerLine(6 ,'    $id%s = null;', $tableClass);
                    $b .= $this->powerLine(5 ,'}');
                    $b .= $this->powerLine(5 ,'$form->setInputFilter($filter->getInputFilter($id%s));',$tableClass).PHP_EOL;
                } else {
                    $b .= $this->getIndent(5).trim('    $form->setInputFilter($filter->getInputFilter());').PHP_EOL;
                }
                $b .= $this->getIndent(5).trim('    return $form;').PHP_EOL;
                $b .= $this->getIndent(4).trim('},').PHP_EOL;
                $b .= $this->getIndent(4).trim(' \'form_search_'.$tableUline.'\' => function ($serviceLocator) {').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $entityManager = $serviceLocator->get(\'doctrine.entitymanager.orm_default\');').PHP_EOL;
                $b .= $this->getIndent(5).trim('    $form = new \\'.$this->getModule().'\Form\\'.$tableClass.'SearchForm($entityManager);').PHP_EOL;
                $b .= $this->getIndent(5).trim('    return $form;').PHP_EOL;
                $b .= $this->getIndent(4).trim('},').PHP_EOL;
            }
        }

        $b .= $this->getIndent(3).trim('     ),').PHP_EOL;

        $b .= $this->getIndent(2).trim(');').PHP_EOL;


        $b .= $this->getIndent(1).trim('}').PHP_EOL;

        return $b;
    }

    public function getClassModule()
    {
        $buffer = '';
        $buffer  = $this->getIndent(0).trim('/**').PHP_EOL;
        $buffer .= $this->getIndent(0).trim('  * @SuppressWarnings(PHPMD.CouplingBetweenObjects)').PHP_EOL;
        $buffer .= $this->getIndent(0).trim('  */').PHP_EOL;
        $buffer .= 'class Module'.PHP_EOL;
        $buffer .= '{'.PHP_EOL;
        return $buffer;
    }


    public function clearModule($moduleName)
    {
        $register = $this->removeFromRegisterModule($moduleName);
        if($register) {
            return $this->rmDir($this->getLocal().'/module/'.$moduleName);
        } else return $register;
    }

    public function getTablesNames($targetInfo)
    {
        unset($targetInfo['module_name'***REMOVED***);
        unset($targetInfo['send'***REMOVED***);
        return array_keys($targetInfo);
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
