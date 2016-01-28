<?php
namespace Gear\Config\Service;

use Gear\ValueObject\Config\Globally;
use Gear\ValueObject\Config\Local;

class ConfigService extends AbstractService
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
        switch($global->getDbms()) {
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
        $script = realpath(__DIR__.'/../../../script');
        $htaccess = realpath($script.'/utils/installer/htaccess.sh');

        $cmd = sprintf('%s %s %s', $htaccess, $local->getEnvironment(), $locationProject);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->run($cmd);

        return true;
    }


    public function setUpLocalProject(Local $local, $locationProject)
    {
        $this->createFileFromTemplate(
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

        $this->createFileFromTemplate(
            'template/project/config/autoload/local.phtml',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword(),
                'host'     => $local->getHost(),
                'environment' => $local->getEnvironment()
            ),
            'local.php.dist',
            $locationProject.'/config/autoload'
        );
        return true;
    }


    public function setUPGlobalProject(Globally $global, $locationProject)
    {


        $template = $this->getTemplateToUse($global);


        $file = $this->getServiceLocator()->get('fileCreator');

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

        $globalFile = \Gear\ValueObject\Project::getStaticFolder().'/config/autoload/global.php';

        if (!is_file($globalFile)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $globalItens = require $globalFile;

        if (!array_key_exists('gear', $globalItens) || !array_key_exists('version', $globalItens['gear'***REMOVED***)) {
            throw new \Gear\Exception\ProjectMissingGearException();
        }

        $version = $globalItens['gear'***REMOVED***['version'***REMOVED***;

        $file = $this->getServiceLocator()->get('fileCreator');

        $file->setTemplate($template);
        $file->setOptions(array('dbname' => $global->getDbname(), 'dbhost' => $global->getDbhost(), 'version' => $version));
        $file->setFileName('global.php');
        $file->setLocation(\Gear\ValueObject\Project::getStaticFolder().'/config/autoload');


        $file->render();

        return true;
    }

    public function setUpLocal(Local $local)
    {
        $this->createFileFromTemplate(
            'template/project/config/autoload/local.phtml',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword(),
                'host'     => $local->getHost(),
                'environment' => $local->getEnvironment()
            ),
            'local.php',
            \Gear\ValueObject\Project::getStaticFolder().'/config/autoload'
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
