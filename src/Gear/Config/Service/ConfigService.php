<?php
namespace Gear\Config\Service;

use Gear\Project\Config\Globally;
use Gear\Project\Config\Local;
use Gear\Service\AbstractJsonService;

class ConfigService extends AbstractJsonService
{

    public function configExists($value)
    {
        if (empty($value)) {
            return false;
        }

        $value = explode('.', $value);

        if (count($value) == 1) {
            return isset($this->config[$value[0***REMOVED******REMOVED***);
        }

        $search = $this->config;

        foreach ($value as $singleValue) {
//var_dump($search[$singleValue***REMOVED***);
            $isset = isset($search[$singleValue***REMOVED***);

            if (!$isset) {
                return false;
            }

            $search = $search[$singleValue***REMOVED***;
        }


        return isset($search);


    }

    public function getValue($value)
    {
        $value = explode('.', $value);

        if (count($value) == 1) {
            $value = $this->config[$value[0***REMOVED******REMOVED***;

            if (is_array($value)) {
                return print_r($value, true);
            }
            return $value;
        }

        $search = $this->config;

        foreach ($value as $singleValue) {
            $isset = isset($search[$singleValue***REMOVED***);

            if (!$isset) {
                return false;
            }

            $search = $search[$singleValue***REMOVED***;
        }


        if (is_array($search)) {
            return print_r($search, true);
        }
        return $search;

    }

    public function configAction()
    {
        $this->config = $this->getServiceLocator()->get('config');
        $this->key  = $this->getRequest()->getParam('key');
        $this->value = $this->getRequest()->getParam('value');
        $this->file = $this->getRequest()->getParam('file', null);

    }

    public function add()
    {
        $this->configAction();

        if (empty($this->key) || empty($this->value)) {
            return false;
        }

        if ($this->configExists($this->key)) {
            $this->outputConsole(sprintf('"%s" exists', $this->key), 1);

            return false;
            //console output.
        }

        $value = explode('.', $this->value);

        if (count($value) == 1) {
            $this->config[$this->key***REMOVED*** = $value[0***REMOVED***;
        }

        return true;

    }

    public function update()
    {
        $this->configAction();

    }

    public function delete()
    {
        $this->configAction();
    }

    public function listConfig()
    {
        $this->configAction();

        if ($this->configExists($this->key)) {
            $this->outputConsole($this->getValue($this->key), 1, 2);
            //console output.
        }
    }

    public function getTemplateToUse($global)
    {
        switch ($global->getDbms()) {
            case 'mysql':
                $template = 'template/project/config/autoload/global.mysql.phtml';
                break;
            case 'sqlite':
                $template = 'template/project/config/autoload/global.sqlite.phtml';

                break;
            case 'memory':
                $template = 'template/project/config/autoload/global.memory.phtml';

                break;
        }

        if (!isset($template)) {
            throw new \Exception(sprintf('Template for %s not found.', $global->getDbms()));
        }

        return $template;
    }

    public function setUpEnvironmentProject(Local $local, $locationProject)
    {

        $script = realpath(__DIR__.'/../../../../bin');
        $htaccess = realpath($script.'/installer-utils/htaccess.sh');

        if (!is_file($htaccess)) {
            throw new \Gear\Exception\FileNotFoundException($htaccess);
        }


        $cmd = sprintf('%s %s %s', $htaccess, $local->getEnvironment(), $locationProject);


        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->setLocation($locationProject);
        $scriptService->run($cmd);

        return true;
    }


    public function setUpLocalProject(Local $local, $locationProject)
    {
        $this->getFileCreator()->createFile(
            'template/project/config/autoload/local.phtml',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword(),
                'host'     => $local->getHost(),
                'environment' => $local->getEnvironment()
            ),
            'local.php',
            $locationProject.'/config/autoload'
        );

        $localDist = $this->getFileCreator()->renderPartial(
            'template/project/config/autoload/local.phtml',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword(),
                'host'     => $local->getHost(),
                'environment' => $local->getEnvironment()
            )
        );

        file_put_contents($locationProject.'/config/autoload/local.php.dist', $localDist);

        return true;
    }


    public function setUPGlobalProject(Globally $global, $locationProject)
    {


        $template = $this->getTemplateToUse($global);


        $file = $this->getFileCreator();

        $file->setTemplate($template);
        $file->setOptions(array(
            'dbname' => $global->getDbname(),
            'dbhost' => $global->getDbhost(),
            'version' => '0.1.0',
        ));
        $file->setFileName('global.php');
        $file->setLocation($locationProject.'/config/autoload');

        $file->render();

        return true;
    }

    public function setUpGlobal(Globally $global)
    {
        $template = $this->getTemplateToUse($global);

        // pegar o config global do projeto.

        $globalFile = \GearBase\Module::getProjectFolder().'/config/autoload/global.php';

        if (!is_file($globalFile)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $globalItens = require $globalFile;

        if (!array_key_exists('gear', $globalItens) || !array_key_exists('version', $globalItens['gear'***REMOVED***)) {
            throw new \Gear\Exception\ProjectMissingGearException();
        }

        $version = $globalItens['gear'***REMOVED***['version'***REMOVED***;

        $file = $this->getFileCreator();

        $file->setTemplate($template);
        $file->setOptions(
            array(
                'dbname' => $global->getDbname(),
                'dbhost' => $global->getDbhost(),
                'version' => $version
            )
        );
        $file->setFileName('global.php');
        $file->setLocation(\GearBase\Module::getProjectFolder().'/config/autoload');


        $file->render();

        return true;
    }

    public function setUpLocal(Local $local)
    {
        $this->getFileCreator()->createFile(
            'template/project/config/autoload/local.phtml',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword(),
                'host'     => $local->getHost(),
                'environment' => $local->getEnvironment()
            ),
            'local.php',
            \GearBase\Module::getProjectFolder().'/config/autoload'
        );
        return true;
    }

    public function setUpEnvironment(Local $local)
    {
        $script = realpath(__DIR__.'/../../../script');
        $htaccess = realpath($script.'/utils/installer/htaccess.sh');

        $cmd = sprintf('%s %s %s', $htaccess, $local->getEnvironment(), \GearBase\Module::getProjectFolder());

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->run($cmd);

        return true;
    }
}
