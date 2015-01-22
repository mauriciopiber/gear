<?php
namespace Gear\Service;

use Gear\ValueObject\Config\Globally;
use Gear\ValueObject\Config\Local;

class ConfigService extends AbstractService
{
    public function setUpGlobal(Globally $global)
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

        $this->createFileFromTemplate(
            $template,
            array('dbname' => $global->getDbname(), 'dbhost' => $global->getDbhost()),
            'global.php',
            \Gear\ValueObject\Project::getStaticFolder().'/config/autoload'
        );
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

        $cmd = sprintf('%s %s %s', $htaccess, $local->getEnvironment(), \Gear\ValueObject\Project::getStaticFolder());

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->run($cmd);

        return true;
    }


}
