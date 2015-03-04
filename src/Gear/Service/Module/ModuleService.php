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
    /** @var $jsonService \Gear\Service\Constructor\JsonService */
    protected $jsonService;

    use \Gear\Common\TestServiceTrait;

    //rodar os testes no final do processo, alterando o arquivo application.config.php do sistema principal.
    public function create()
    {
        $this->build    = $this->getRequest()->getParam('build', null);
        $this->layout   = $this->getRequest()->getParam('layout', null);
        $this->noLayout = $this->getRequest()->getParam('no-layout', null);

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
        $testService->createTests();
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

        if (isset($this->build) && null !== $this->build) {
            $buildService = $this->getServiceLocator()->get('buildService');
            $output = $buildService->build($this->build);
            $console->writeLine("$output", ColorInterface::RESET, 3);

        }

        return true;
    }

    public function createLight($options = array())
    {

        $this->setOptions();
        //module structure
        $moduleStructure = $this->getServiceLocator()->get('moduleStructure');
        $moduleStructure->minimal()->writeMinimal($this->getOptions());

        /* @var $configService \Gear\Service\Mvc\ConfigService */
        $configService         = $this->getServiceLocator()->get('Gear\Service\Mvc\ConfigService');
        $configService->generateForLightModule($this->getOptions());

        $this->createLightModuleFile();
        $this->createModuleFileAlias();
        $this->registerModule();

        if ($this->hasOptions('gear')) {

            $this->registerJson();
        }

        if ($this->hasOptions('ci')) {
            $buildService = $this->getServiceLocator()->get('buildService');
            $buildService->copy();
        }

        if ($this->hasOptions('unit')) {
            /* @var $testService \Gear\Service\Module\TService */
            $testService = $this->getTestService();
            $testService->createTests();

            $codeceptionService = $this->getServiceLocator()->get('codeceptionService');
            $codeceptionService->mainBootstrap();
            $codeceptionService->unitBootstrap();
        }
        /* $module = $moduleStructure->prepare()->write(); */
    }

    public function hasOptions($optionName)
    {
        return in_array($optionName, $this->getOptions());
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

        $this->createModuleFileTest();

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

    public function createModuleFileTest()
    {
        return $this->createFileFromTemplate(
            'template/test/unit/module.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
            ),
            'ModuleTest.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
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
        $this->after  = $this->getRequest()->getParam('after', null);
        $this->before = $this->getRequest()->getParam('before', null);

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

        $json = $this->getJsonService()->registerJson();
        return $json;
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

    /**
     * Função responsável por alterar o application.config.php e adicionar o novo módulo
     */
    public function registerModule()
    {

        if (isset($this->before) && $this->before !== null) {
            return $this->registerBeforeModule();
        }

        if (isset($this->after) && $this->after !== null) {
            return $this->registerAfterModule();
        }


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

    public function registerAfterModule()
    {
        $after = $this->after;

        $data = $this->getApplicationConfigArray();

        $addValue = $this->getConfig()->getModule();

        if (($key = array_search($addValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $keyAfter = array_search($after, $data['modules'***REMOVED***);

        if ($keyAfter !== false) {
            $data['modules'***REMOVED*** = array_merge
            (
                array_slice($data['modules'***REMOVED***, 0, ($keyAfter+1)),
                array($addValue),
                array_slice($data['modules'***REMOVED***, ($keyAfter+1), null)
            );
        } else {
            $data['modules'***REMOVED***[***REMOVED*** = $addValue;
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents($this->getApplicationConfig(), '<?php return ' . $dataArray . '; ?>');

        return true;
    }

    public function registerBeforeModule()
    {
        $before = $this->before;

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

    public function push()
    {
        $this->description = $this->getRequest()->getParam('description', null);

        $config = $this->getModule()->getConfigFolder();

        if (!is_file($config.'/module.config.php')) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $moduleConfig = require $config.'/module.config.php';

        if (!isset($moduleConfig['gear'***REMOVED***['version'***REMOVED***)) {
            throw new \Exception(sprintf('Module %s was not ready for versioning', $this->getConfig()->getModule()));
        }

        $versions = explode('.', $moduleConfig['gear'***REMOVED***['version'***REMOVED***);
        $last = end($versions);
        $lastTo = $last + 1;
        end($versions);         // move the internal pointer to the end of the array
        $key = key($versions);

        $versions[$key***REMOVED*** = $lastTo;
        $version = implode('.', $versions);

        $file = file_get_contents($config.'/module.config.php');
        $file = str_replace($moduleConfig['gear'***REMOVED***['version'***REMOVED***, $version, $file);
        file_put_contents($config.'/module.config.php', $file);

        $description = $this->description;

        $script = realpath(__DIR__.'/../../../../script/utils');
        $pushScript = realpath($script.'/push.sh');

        $folder = $this->getModule()->getMainFolder();

        $cmd = sprintf('%s %s %s %s', $pushScript, $folder, $version, $description);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);

        return true;
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


    public function setOptions($optionsParam = array())
    {
        $request = $this->getRequest();

        $options = [***REMOVED***;

        if ($request->getParam('doctrine')) {
            $options[***REMOVED*** = 'doctrine';
        }
        if ($request->getParam('doctrine-fixture')) {
            $options[***REMOVED*** = 'doctrine-fixture';
        }
        if ($request->getParam('unit')) {
            $options[***REMOVED*** = 'unit';
        }
        if ($request->getParam('codeception')) {
            $options[***REMOVED*** = 'codeception';
        }
        if ($request->getParam('ci')) {
            $options[***REMOVED*** = 'ci';
        }

        if ($request->getParam('gear')) {
            $options[***REMOVED*** = 'gear';
        }

        if ($request->getParam('repository')) {
            $options[***REMOVED*** = 'repository';
        }

        if ($request->getParam('service')) {
            $options[***REMOVED*** = 'service';
        }

        $this->options = array_merge($optionsParam, $options);
        return $this;
    }


}
