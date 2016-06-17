<?php
namespace Gear\Config\Service;

use Gear\Project\Config\Globally;
use Gear\Project\Config\Local;
use Gear\Service\AbstractJsonService;

class ConfigService extends AbstractJsonService
{
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
}
