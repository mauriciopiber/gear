<?php
namespace Gear\Database;

use GearBase\Script\ScriptService;
use Gear\Module\BasicModuleStructure;
use GearBase\Util\String\StringService;
use Gear\Script\ScriptServiceTrait;
use Zend\Console\Adapter\Posix;
use Gear\Project\ProjectLocationTrait;

class BackupService extends DbAbstractService
{
    use ProjectLocationTrait;

    use ScriptServiceTrait;

    public function __construct(
        array $config,
        StringService $string,
        ScriptService $service,
        Posix $console,
        BasicModuleStructure $module = null
    ) {
        $this->config = $config;
        $this->console = $console;
        $this->scriptService = $service;
        $this->stringService = $string;
        $this->module = $module;
    }

    public function projectLoad()
    {
        if (!isset($this->config['gear'***REMOVED***['project'***REMOVED***)) {
            throw new \Gear\Database\Exception\RunningProjectWithoutConfig();
        }

        $project = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;

        $location = $this->getProject();

        $this->file = $location.'/data/'.$this->str('url', $project).'.mysql.sql';

        $this->backupName = $this->str('url', $project).'.mysql.sql';

        $this->init();

        return $this->runLoad();
    }

    public function projectDump()
    {

        if (!isset($this->config['gear'***REMOVED***['project'***REMOVED***)) {
            throw new \Gear\Database\Exception\RunningProjectWithoutConfig();
        }

        $project = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;

        $location = $this->getProject();

        $this->file = $location.'/data/'.$this->str('url', $project).'.mysql.sql';

        $this->backupName = $this->str('url', $project).'.mysql.sql';

        $this->init();

        return $this->runDump();
    }

    public function moduleLoad()
    {
        $module = $this->getModule()->getModuleName();

        $location = $this->getModule()->getDataFolder();

        $this->file = $location.'/'.$this->str('url', $module).'.mysql.sql';

        if (!is_file($this->file)) {
            throw new \Exception('Dump não foi criado corretamente');
        }

        $this->backupName = $this->str('url', $module).'.mysql.sql';

        $this->init();

        return $this->runLoad();
    }

    public function moduleDump()
    {
        $module = $this->getModule()->getModuleName();

        $location = $this->getModule()->getDataFolder();

        $this->file = $location.'/'.$this->str('url', $module).'.mysql.sql';

        $this->backupName = $this->str('url', $module).'.mysql.sql';

        $this->init();

        return $this->runDump();
    }

    public function getLocation()
    {
        $location = $this->getRequest()->getParam('location');
        return $location;
    }

    public function init()
    {
        $this->username = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['user'***REMOVED***;
        $this->password = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['password'***REMOVED***;
        $this->dbname   = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***;
    }

    public function runLoad()
    {
        $command = sprintf(
            "mysql -u %s --password=%s %s < %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );

        $this->getScriptService()->runScriptAt($command);



        $this->console->writeLine(sprintf('Carregado %s', $this->backupName));
        $this->console->writeLine(sprintf($this->file));

        return $this->file;
    }

    public function runDump()
    {
        $command = sprintf(
            "mysqldump -u %s --password=%s --opt %s > %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );

        $this->getScriptService()->runScriptAt($command);

        if (!is_file($this->file)) {
            throw new \Exception('Dump não foi criado com sucesso');
        }

        $this->console->writeLine(sprintf('Criado dump de %s', $this->file));

        return $this->file;
    }

    public function dump()
    {
        $this->init();

        $location = $this->getLocation();


        $this->file = $location;


        $this->runDump();


        return true;
    }

    public function load()
    {
        $this->init();

        $this->file = sprintf(
            '%s',
            $this->getLocation()
        );

        if (!is_file($this->file)) {
            throw new \Exception("Arquivo não é um dump válido");
        }

        $command = sprintf(
            "mysql -u %s --password=%s %s < %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );

        $this->getScriptService()->runScriptAt($command);

        if (is_file($this->file)) {
            echo sprintf('Carregado database de %s', $this->file)."\n";
        } else {
            throw new \Exception('Dump não foi criado com sucesso');
        }
        return true;
    }
}
