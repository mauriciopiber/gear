<?php
namespace Gear\Database;

use Gear\Util\Script\ScriptService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Script\ScriptServiceTrait;
use Zend\Console\Adapter\Posix;
use Gear\Locator\ModuleLocatorTrait;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Util\String\StringServiceAwareInterface;
use Gear\Util\String\StringServiceTrait;
use Zend\Console\Request;

class BackupService implements ModuleStructureInterface, StringServiceAwareInterface
{
    use StringServiceTrait;

    use ModuleStructureTrait;

    use ModuleLocatorTrait;

    use ScriptServiceTrait;

    const LOADED = 'Carregado dump de %s';

    const DUMPED = 'Criado dump de %s';

    const DUMP_ERROR = 'Dump não foi criado com sucesso';

    public function __construct(
        array $config,
        StringService $string,
        ScriptService $service,
        Posix $console,
        ModuleStructure $module = null,
        Request $request
    ) {
        $this->config = $config;
        $this->console = $console;
        $this->scriptService = $service;
        $this->stringService = $string;
        $this->module = $module;
        $this->request = $request;
    }

    protected $request;

    public function getRequest()
    {
        if (!isset($this->request)) {
            $this->request = $this->getServiceLocator()->get('application')->getMvcEvent()->getRequest();
        }
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function projectLoad()
    {
        if (!isset($this->config['gear'***REMOVED***['project'***REMOVED***)) {
            throw new \Gear\Database\Exception\RunningProjectWithoutConfig();
        }

        $project = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;

        $location = $this->getModuleFolder();

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

        $location = $this->getModuleFolder();

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
        $this->host = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['host'***REMOVED***;
    }

    public function runLoad()
    {
        $command = sprintf(
            "mysql -u %s --password=%s -h%s %s < %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->host),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );

        $this->getScriptService()->runScriptAt($command);



        $this->console->writeLine(sprintf(self::LOADED, $this->file));
        //$this->console->writeLine(sprintf($this->file));

        return $this->file;
    }

    public function runDump()
    {
        $command = sprintf(
            "mysqldump -u %s --password=%s -h%s --opt %s > %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->host),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );

        $this->getScriptService()->runScriptAt($command);

        if (!is_file($this->file)) {
            throw new \Exception(self::DUMP_ERROR);
        }

        $this->console->writeLine(sprintf(self::DUMPED, $this->file));

        return $this->file;
    }

    public function dump()
    {
        $this->init();

        $this->file = sprintf(
            '%s/%s',
            $this->getModuleFolder(),
            $this->getLocation()
        );

        $this->runDump();


        return true;
    }

    public function load()
    {
        $this->init();

        $this->file = sprintf(
            '%s/%s',
            $this->getModuleFolder(),
            $this->getLocation()
        );

        if (!is_file($this->file)) {
            throw new \Exception("Arquivo não é um dump válido");
        }

        $command = sprintf(
            "mysql -u %s --password=%s -h%s %s < %s",
            escapeshellcmd($this->username),
            escapeshellcmd($this->password),
            escapeshellcmd($this->host),
            escapeshellcmd($this->dbname),
            escapeshellcmd($this->file)
        );

        $this->getScriptService()->runScriptAt($command);

        if (is_file($this->file)) {
            $this->console->writeLine(sprintf('Carregado database de %s', $this->file));
        } else {
            throw new \Exception('Dump não foi criado com sucesso');
        }
        return true;
    }
}
