<?php
namespace Gear\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Gear\Service\AbstractService;

class DeployService extends AbstractService
{

    protected $configService;

    protected $folder;

    protected $deployName;

    protected $environment;

    public function deploy($environment)
    {
        $project = \Gear\Service\ProjectService::getProjectFolder();

        $composer = $project . '/composer.json';

        $composerData = \Zend\Json\Json::decode(file_get_contents($composer), 1);

        $projectName = $composerData['name'***REMOVED***;

        $projectExplode = explode('/', $projectName);

        $name = end($projectExplode);

        $specification = $project . '/specifications/';

        $file = ($specification . '/' . $this->str('url', $name) . '.json');

        if (! is_file($file)) {
            return null;
        }

        $specifications = \Zend\Json\Json::decode(file_get_contents($file), 1);

        $global = new \Gear\ValueObject\Config\Globally($specifications[$environment['environment'***REMOVED******REMOVED***);
        $local = new \Gear\ValueObject\Config\Local($specifications[$environment['environment'***REMOVED******REMOVED***);

        $this->getConfigService()->setUpGlobal($global);
        $this->getConfigService()->setUpLocal($local);
        $this->getConfigService()->setUpEnvironment($local);

        return true;

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
