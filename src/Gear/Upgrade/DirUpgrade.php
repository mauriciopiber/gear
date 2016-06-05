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

    static public $createFolder = 'Criar Pasta %s?';

    static public $created = 'Pasta %s criada com permissão de escrita e gitignore';


    public function __construct(Posix $console, $dirService, $module = null, $consolePrompt)
    {
        $this->console = $console;
        $this->dirService = $dirService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
    }

    public function upgradeDir($writable)
    {
        $folder = $this->getModule()->getMainFolder().'/'.$writable;

        if (!is_dir($folder)) {
            $create = $this->getConsolePrompt()->show(sprintf(static::$createFolder, $writable));
            if ($create === false) {
                return;
            }

            $this->getDirService()->mkDir($folder);
            chmod($folder, 0777);
        }

        if (!is_file($folder.'/.gitignore')) {
            file_put_contents($folder.'/.gitgnore', <<<EOS
*
!.gitignore
EOS
            );
        }

        $this->upgrades[***REMOVED*** = sprintf(static::$created, $writable);
    }

    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        $mainFolder = $this->getModule()->getMainFolder();


        $edge = $this->getDirEdge()->getDirModule($type);


        foreach ($edge['writable'***REMOVED*** as $writable) {
            $this->upgradeDir($writable);
        }


        return $this->upgrades;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
