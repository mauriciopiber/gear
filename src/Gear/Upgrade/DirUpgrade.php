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

    static public $created = 'Pasta %s criada';

    static public $ignore = 'Pasta %s ignorada no git.';

    static public $writable = 'Pasta %s com permissão de escrita.';


    public function __construct(Posix $console, $dirService, $consolePrompt, $module = null)
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
                return false;
            }

            $this->getDirService()->mkDir($folder);
            $this->upgrades[***REMOVED*** = sprintf(static::$created, $writable);
        }

        return true;
    }

    public function upgradeWritable($folder)
    {
        $created = $this->upgradeDir($folder);

        if ($created) {
            $toWrite = $this->getModule()->getMainFolder().'/'.$folder;
            if (!is_writable($toWrite)) {
                chmod($toWrite, 0777);
                $this->upgrades[***REMOVED*** = sprintf(static::$writable, $folder);
            }

        }
    }

    public function upgradeIgnore($folder)
    {
        $created = $this->upgradeDir($folder);

        if ($created) {

            $toIgnore = $this->getModule()->getMainFolder().'/'.$folder;
            if (!is_file($toIgnore.'/.gitignore')) {
                file_put_contents(
                    $toIgnore.'/.gitignore',
<<<EOS
*
!.gitignore

EOS
                );
                $this->upgrades[***REMOVED*** = sprintf(static::$ignore, $folder);
            }

        }
    }

    public function upgradeModule($type = 'web')
    {
        $this->upgrades = [***REMOVED***;

        $mainFolder = $this->getModule()->getMainFolder();


        $this->edge = $this->getDirEdge()->getDirModule($type);

        if (isset($this->edge['writable'***REMOVED***) && count($this->edge['writable'***REMOVED***)) {
            foreach ($this->edge['writable'***REMOVED*** as $writable) {
                $this->upgradeWritable($writable);
            }
        }

        if (isset($this->edge['ignore'***REMOVED***) && count($this->edge['ignore'***REMOVED***)) {
            foreach ($this->edge['ignore'***REMOVED*** as $ignore) {
                $this->upgradeIgnore($ignore);
            }

        }

        return $this->upgrades;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
