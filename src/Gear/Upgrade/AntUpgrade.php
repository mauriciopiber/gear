<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Util\Console\ConsoleAwareTrait;
use Gear\Util\Prompt\ConsolePromptTrait;
use Gear\Edge\AntEdgeTrait;

class AntUpgrade extends AbstractJsonService
{
    use AntEdgeTrait;

    use ConsolePromptTrait;

    use ConsoleAwareTrait;

    static public $created = 'Arquivo %s do %s criado';

    static public $confirm = 'Deseja criar arquivo %s?';

    public function __construct($console, $consolePrompt, $module = null)
    {
        $this->console = $console;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
    }


    public function upgradeModule($type = 'web')
    {
        return [***REMOVED***;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
