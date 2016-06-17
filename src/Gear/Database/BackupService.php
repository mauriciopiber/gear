<?php
namespace Gear\Database;

use Gear\Script\ScriptService;
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

    public function getBackupName()
    {
        $name = $this->getRequest()->getParam('name', null);

        if (!$name) {
            $backupName = sprintf(
                '%s_backup_%s.txt',
                $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***,
                date('H.i.s.d.m.Y')
            );

            return $backupName;
        }
        return $name;
    }

    public function projectLoad()
    {
        $project = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
        $location = $this->getProject();

        $this->file = $location.'/data/'.$this->str('url', $project).'.mysql.sql';

        $this->backupName = $this->str('url', $project).'.mysql.sql';

        $this->init();

        return $this->runLoad();
    }

    public function projectDump()
    {
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


        if (realpath($location) == false) {
            throw new \Exception('Location not found');
        }

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

        $this->getScriptService()->run($command);



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

        $this->getScriptService()->run($command);

        if (!is_file($this->file)) {
            throw new \Exception('Dump não foi criado com sucesso');
        }

        $this->console->writeLine(sprintf('Criado %s', $this->backupName));
        $this->console->writeLine(sprintf($this->file));

        return $this->file;
    }

    public function mysqlDump()
    {
        $this->init();

        $location = $this->getLocation();

        $path = realpath($location).'/';

        $this->file = sprintf(
            '%s%s',
            $path,
            $this->getBackupName()
        );

        $this->backupName = $this->getBackupName();

        $this->runDump();


        return true;
    }

    public function mysqlLoad()
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

        exec($command);

        if (is_file($this->file)) {
            echo sprintf('Carregado backup de %s', $this->file)."\n";
        } else {
            throw new \Exception('Dump não foi criado com sucesso');
        }
        return true;
    }
}
