<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Gear\Service\AbstractService;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Yaml;

class DeployService extends AbstractService
{

    protected $configService;

    protected $folder;

    protected $deployName;

    protected $environment;

    public function push($folder, $version, $description)
    {
        $script = realpath(__DIR__.'/../../../script/utils');
        $pushScript = realpath($script.'/push.sh');

        $cmd = sprintf('%s %s %s %s', $pushScript, $folder, $version, $description);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);
    }


    public function mysql2sqlite()
    {

        $especification = $this->getSpecifications();

        $from = $this->getServiceLocator()->get('application')->getMvcEvent()->getRequest()->getParam('from');
        $target = $this->getServiceLocator()->get('application')->getMvcEvent()->getRequest()->getParam('target');

        if (!isset($especification[$from***REMOVED***) || !is_array($especification[$from***REMOVED***)) {
            throw new \Gear\Exception\EnvironmentNotFoundException();
        }

        if (!isset($especification[$target***REMOVED***) || !is_array($especification[$target***REMOVED***)) {
            throw new \Gear\Exception\EnvironmentNotFoundException();
        }


        if ($especification[$from***REMOVED***['dbms'***REMOVED*** !== 'mysql') {
            throw new \Exception();
        }

        if ($especification[$target***REMOVED***['dbms'***REMOVED*** !== 'sqlite') {
            throw new \Exception();
        }


        $database = $especification[$from***REMOVED***['dbname'***REMOVED***;
        $username = $especification[$from***REMOVED***['username'***REMOVED***;
        $password = $especification[$from***REMOVED***['password'***REMOVED***;

        $sqliteLocation =  $especification[$target***REMOVED***['dbname'***REMOVED***;


        $script = realpath(__DIR__.'/../../../script/convertMysql2sqlite.sh');

        $folder = \Gear\ValueObject\Project::getStaticFolder();

        $scriptFolder = realpath(__DIR__.'/../../../script/');

        $cmd = sprintf('%s %s %s %s %s %s %s', $script, $scriptFolder, $folder, $username, $password, $database, $sqliteLocation);


        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);

        return true;



    }

    public function getSpecifications()
    {
        $composer = $this->getServiceLocator()->get('composerService');

        $composerData = $composer->getProjectComposer();

        if (!isset($composerData['name'***REMOVED***) || empty($composerData['name'***REMOVED***)) {
            throw new \Exception('Composer.json is without a name');
        }

        $projectName = $composerData['name'***REMOVED***;


        $projectExplode = explode('/', $projectName);

        $name = end($projectExplode);

        $specification = \Gear\Service\ProjectService::getProjectFolder() . '/data/specifications/';

        $file = ($specification . '/' . $this->str('url', $name) . '.json');

        if (! is_file($file)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $this->specifications = \Zend\Json\Json::decode(file_get_contents($file), 1);

        return $this->specifications;
    }

    public function deploy()
    {
        $this->environment = $this->getServiceLocator()->get('application')->getMvcEvent()->getRequest()->getParams();

        $this->getSpecifications();

        if (!isset($this->specifications[$this->environment['environment'***REMOVED******REMOVED***) || !is_array($this->specifications[$this->environment['environment'***REMOVED******REMOVED***)) {
            throw new \Gear\Exception\EnvironmentNotFoundException();
        }

        $global = new \Gear\ValueObject\Config\Globally($this->specifications[$this->environment['environment'***REMOVED******REMOVED***);
        $local = new \Gear\ValueObject\Config\Local($this->specifications[$this->environment['environment'***REMOVED******REMOVED***);

        $this->getConfigService()->setUpGlobal($global);
        $this->getConfigService()->setUpLocal($local);
        //$this->getConfigService()->setUpEnvironment($local);

        $this->setUpTests();

        return true;
    }

    public function setUpTests()
    {
        $projectCodeception = \GearBase\Module::getProjectFolder().'/codeception.yml';


        $projectCodeceptionDecoded = Yaml::parse($projectCodeception);


        if (empty($projectCodeceptionDecoded['include'***REMOVED***)) {
            return false;
        }

        $modules = $projectCodeceptionDecoded['include'***REMOVED***;

        foreach ($modules as $module) {

            $moduleYaml = \GearBase\Module::getProjectFolder().'/'.$module.'/codeception.yml';

            $moduleDecoded = Yaml::parse($moduleYaml);

            $dataEnvironment = $this->specifications[$this->environment['environment'***REMOVED******REMOVED***;


            if (isset($moduleDecoded['modules'***REMOVED***['config'***REMOVED***['WebDriver'***REMOVED***)) {

                $webDriver = $moduleDecoded['modules'***REMOVED***['config'***REMOVED***['WebDriver'***REMOVED***;

                $webDriver['url'***REMOVED*** = sprintf('http://%s/', $dataEnvironment['host'***REMOVED***);

                $moduleDecoded['modules'***REMOVED***['config'***REMOVED***['WebDriver'***REMOVED*** = $webDriver;
            }

            if (isset($moduleDecoded['modules'***REMOVED***['config'***REMOVED***['Db'***REMOVED***)) {

                $db = $moduleDecoded['modules'***REMOVED***['config'***REMOVED***['Db'***REMOVED***;

                $db['dsn'***REMOVED*** = sprintf('mysql:dbname=%s;host=%s', $dataEnvironment['dbname'***REMOVED***, $dataEnvironment['dbhost'***REMOVED***);
                $db['user'***REMOVED*** = $dataEnvironment['username'***REMOVED***;
                $db['password'***REMOVED*** = $dataEnvironment['dbname'***REMOVED***;

                $moduleDecoded['modules'***REMOVED***['config'***REMOVED***['Db'***REMOVED*** = $db;

            }

            file_put_contents($moduleYaml, Yaml::dump($moduleDecoded));
        }

        //verificar módulos na pasta Módulo.
        //verificar módulos no arquivo codeception.yml


        //todos testes são setados ou por módulo ou por projeto.
        //aqui, será setado por projeto, e chamará todos módulos habilitados.
    }

    public function getConfigService()
    {
        if (!isset($configService)) {
            $this->configService = $this->getServiceLocator()->get('Gear\Service\Config');
        }
        return $this->configService;
    }

    public function setConfigService($configService)
    {
        $this->configService = $configService;
        return $this;
    }
}
