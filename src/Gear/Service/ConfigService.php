<?php
namespace Gear\Service;

use Gear\ValueObject\Config\Globally;
use Gear\ValueObject\Config\Local;

class ConfigService extends AbstractService
{

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
        $htaccess = realpath($script.'/installer/htaccess.sh');

        $cmd = sprintf('%s %s %s', $htaccess, $local->getEnvironment(), $locationProject);

        echo $cmd;die();

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
        $htaccess = realpath($script.'/installer/htaccess.sh');

        $cmd = sprintf('%s %s %s', $htaccess, $local->getEnvironment(), \GearBase\Module::getProjectFolder());

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->run($cmd);

        return true;
    }


}
