<?php
namespace Gear\Upgrade;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Gear\Service\AbstractJsonService;
use Gear\Project\ProjectServiceTrait;
use Gear\Module\ModuleServiceTrait;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;

class FileUpgrade extends AbstractJsonService implements ServiceLocatorAwareInterface
{
    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    use ProjectServiceTrait;

    use ModuleServiceTrait;

    public function __construct($console, $consolePrompt, $moduleService, $projectService, $module = null)
    {
        $this->console = $console;
        $this->moduleService = $moduleService;
        $this->projectService = $projectService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
    }
    //use DirEdgeTrait;

    use ServiceLocatorAwareTrait;

    public function upgradeModule($type = 'web')
    {
        return [***REMOVED***;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
