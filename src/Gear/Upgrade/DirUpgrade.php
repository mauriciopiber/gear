<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Edge\DirEdgeTrait;
use Gear\Util\Console\ConsoleAwareTrait;
use Zend\Console\Adapter\Posix;
use Gear\Util\Prompt\ConsolePromptTrait;

class DirUpgrade extends AbstractJsonService
{
    use ConsolePromptTrait;
    use ConsoleAwareTrait;
    use DirEdgeTrait;

    static protected $createFolder = 'Criar Pasta %s?';


    public function __construct(Posix $console, $dirService, $module = null, $consolePrompt)
    {
        $this->console = $console;
        $this->dirService = $dirService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
    }

    public function upgradeDir($writable)
    {
        if (!is_dir($writable)) {
            $create = $this->getConsolePrompt()->show(sprintf(static::$createFolder, $writable));
            if ($create === false) {
                return;
            }
        }
    }

    public function upgradeModule($type = 'web')
    {
        $mainFolder = $this->getModule()->getMainFolder();


        $edge = $this->getDirEdge()->getDirModule($type);


        foreach ($edge['writable'***REMOVED*** as $writable) {
            $this->upgradeDir($writable);
        }

        //$confirm = new Prompt\Confirm('Are you sure you want to continue?');
        //$result = $confirm->show();

        //if ($result == 'Y') {
        //    var_dump($mainFolder);
        //    var_dump($edge);
        //}


        return [***REMOVED***;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
