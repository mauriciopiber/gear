<?php
namespace Gear\Project;

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

        if (
            !isset($this->specifications[$this->environment['environment'***REMOVED******REMOVED***)
            || !is_array($this->specifications[$this->environment['environment'***REMOVED******REMOVED***)
        ) {
            throw new \Gear\Exception\EnvironmentNotFoundException();
        }

        $global = new \Gear\Project\Config\Globally($this->specifications[$this->environment['environment'***REMOVED******REMOVED***);
        $local = new \Gear\Project\Config\Local($this->specifications[$this->environment['environment'***REMOVED******REMOVED***);

        $this->getConfigService()->setUpGlobal($global);
        $this->getConfigService()->setUpLocal($local);
        //$this->getConfigService()->setUpEnvironment($local);

        $this->setUpTests();

        return true;
    }

    public function setUpTests()
    {
        $projectCodeception = \GearBase\Module::getProjectFolder().'/codeception.yml';


        $projectCode = Yaml::parse($projectCodeception);


        if (empty($projectCode['include'***REMOVED***)) {
            return false;
        }

        $modules = $projectCode['include'***REMOVED***;

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
        if (!isset($this->configService)) {
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
