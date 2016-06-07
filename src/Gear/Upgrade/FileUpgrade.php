<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectServiceTrait;
use Gear\Module\ModuleServiceTrait;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\FileEdgeTrait;

class FileUpgrade extends AbstractJsonService implements ServiceLocatorAwareInterface
{
    use FileEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    use ProjectServiceTrait;

    use ModuleServiceTrait;

    static public $created = 'Arquivo %s do %s criado';

    static public $confirm = 'Deseja criar arquivo %s?';

    protected $type;

    public function __construct($console, $consolePrompt, $moduleService, $projectService, $module = null)
    {
        $this->console = $console;
        $this->moduleService = $moduleService;
        $this->projectService = $projectService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
    }
    //use DirEdgeTrait;

    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        //$mainFolder = $this->getModule()->getMainFolder();
        $this->edge = $this->getFileEdge()->getFileModule($type);

        if (isset($this->edge['files'***REMOVED***) && count($this->edge['files'***REMOVED***)) {

            foreach ($this->edge['files'***REMOVED*** as $file) {
                $this->upgradeModuleFile($type, $file);
            }
        }

        return $this->upgrades;
    }

    public function moduleMap($type, $fileName)
    {
        $found = false;

        switch ($fileName) {
            case 'codeception.yml':
                $this->getModuleService()->codeception();
                $found = true;
                break;
            case 'script/deploy-development.sh':
                $this->getModuleService()->scriptDevelopment($type);
                $found = true;
                break;
            default:
                $found = false;
        }


        if ($found === false) {
            throw new \Exception('Implementar mapa para arquivo '.$fileName);
        }

        return $found;

    }

    public function upgradeModuleFile($type, $file)
    {
        $fileLocation = $this->getModule()->getMainFolder().'/'.$file;

        if (is_file($fileLocation)) {
            return;
        }

        if ($this->getConsolePrompt()->show(sprintf(static::$confirm, $file)) === false) {
            return;
        }

        if ($this->moduleMap($type, $file)) {
            $this->upgrades[***REMOVED*** = sprintf(static::$created, $file, 'Module');
        }

        return true;
    }

    public function upgradeProjectFile($file)
    {

    }


    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
