<?php
namespace Gear\Upgrade\Dir;

use Gear\Util\String\StringServiceTrait;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Edge\Dir\DirEdgeTrait;
use Gear\Edge\Dir\DirEdge;
use Gear\Console\Prompt\ConsolePromptTrait;
use Gear\Console\Prompt\ConsolePrompt;
use Gear\Project\ProjectLocationTrait;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Util\Dir\DirService;
use Gear\Config\GearConfig;
use Gear\Config\GearConfigTrait;

class DirUpgrade
{
    use GearConfigTrait;

    use DirServiceTrait;

    use StringServiceTrait;

    use ModuleStructureTrait;

    use ProjectLocationTrait;

    use ConsolePromptTrait;

    use DirEdgeTrait;

    static public $shouldDirWrite = 'Diretórios -> Você quer criar o diretório %s com permissão de escrita? Y/n';

    static public $shouldDirIgnore = 'Diretórios -> Você quer criar o diretório %s com .gitignore? Y/n';

    static public $shouldWrite = 'Diretórios -> O diretório %s existe, você quer permissão de escrita? Y/n';

    static public $shouldIgnore = 'Diretórios -> O diretório %s existe, você quer criar o arquivo .gitignore? Y/n';

    static public $dirWrite = 'Diretórios -> Diretório %s criado com permissão de escrita. - OK';

    static public $write = 'Diretórios -> Diretório %s recebeu permissão de escrita. - OK';

    static public $dirIgnore = 'Diretórios -> Diretório %s criado com .gitignore. - OK';

    static public $ignore = 'Diretórios -> Adicionado arquivo .gitignore à pasta %s. - OK';

    public $config;

    public function __construct(
        ModuleStructure $module,
        GearConfig $gearConfig,
        DirEdge $dirEdge,
        ConsolePrompt $consolePrompt,
        DirService $dirService
    ) {
        $this->dirService = $dirService;
        $this->module = $module;
        $this->consolePrompt = $consolePrompt;
        $this->gearConfig = $gearConfig;
        $this->dirEdge = $dirEdge;
    }

    public function upgradeDir($baseDir, $writable)
    {
        $folder = $baseDir.'/'.$writable;
        $this->getDirService()->mkDir($folder);
        return true;
    }

    public function upgradeWritable($baseDir, $folder)
    {
        $toWrite = $baseDir.'/'.$folder;

        if (is_dir($toWrite) && is_writable($toWrite)) {
            return;
        }

        if (is_dir($toWrite) && !is_writable($toWrite)) {
            $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldWrite, $folder));

            if ($confirm === false) {
                return;
            }

            chmod($toWrite, 0777);
            $this->upgrades[***REMOVED*** = sprintf(static::$write, $folder);
            return;
        }

        $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldDirWrite, $folder));

        if ($confirm === false) {
            return;
        }

        $this->upgradeDir($baseDir, $folder);
        chmod($toWrite, 0777);
        $this->upgrades[***REMOVED*** = sprintf(static::$dirWrite, $folder);
    }

    public function upgradeIgnore($baseDir, $folder)
    {
        $toIgnore = $baseDir.'/'.$folder;

        if (is_dir($toIgnore) && is_file($toIgnore.'/.gitignore')) {
            return;
        }

        if (is_dir($toIgnore) && !is_file($toIgnore.'/.gitignore')) {
            $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldIgnore, $folder));

            if ($confirm === false) {
                return;
            }

            $this->createGitIgnore($toIgnore.'/.gitignore');
            $this->upgrades[***REMOVED*** = sprintf(static::$ignore, $folder);
            return;
        }


        $confirm = $this->getConsolePrompt()->show(sprintf(static::$shouldDirIgnore, $folder));

        if ($confirm === false) {
            return;
        }

        $this->upgradeDir($baseDir, $folder);
        $this->createGitIgnore($toIgnore.'/.gitignore');

        $this->upgrades[***REMOVED*** = sprintf(static::$dirIgnore, $folder);
    }

    public function createGitIgnore($file)
    {
        return file_put_contents(
            $file,
            <<<EOS
*
!.gitignore

EOS
        );
    }


    public function upgradeModule($type = null)
    {
        if (empty($type)) {
            $type = $this->gearConfig->getCurrentType();
        }
        $this->upgrades = [***REMOVED***;

        $this->edge = $this->getDirEdge()->getDirModule($type);

        if (isset($this->edge['writable'***REMOVED***) && count($this->edge['writable'***REMOVED***)) {
            foreach ($this->edge['writable'***REMOVED*** as $writable) {
                $this->upgradeWritable($this->getModule()->getMainFolder(), $writable);
            }
        }

        if (isset($this->edge['ignore'***REMOVED***) && count($this->edge['ignore'***REMOVED***)) {
            foreach ($this->edge['ignore'***REMOVED*** as $ignore) {
                $this->upgradeIgnore($this->getModule()->getMainFolder(), $ignore);
            }
        }

        return $this->upgrades;
    }
}
