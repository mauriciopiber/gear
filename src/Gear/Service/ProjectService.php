<?php
namespace Gear\Service;

use Gear\Service\AbstractService;
use Gear\Service\Module\ScriptService;
use Gear\ValueObject\Project;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ProjectService extends AbstractService
{

    /*
     * Função responsável por criar projetos do zero e inicia-los no servidor onde o Gear está instalado
     * Gerará projetos na pasta irmã ao projeto específico
     * @return string
     */
    public function create()
    {
        $request = $this->getRequest();

        $this->project = new \Gear\ValueObject\Project( array(
            'project'  => $request->getParam('project', null),
            'host'     => $request->getParam('host', null),
            'git'      => $request->getParam('git', null),
            'database' => $request->getParam('database', null),
            'username' => $request->getParam('username', null),
            'password' => $request->getParam('password', null),
            'nfs'      => $request->getParam('nfs', null)
        ));

        //$this->executeInstallation();
        //$this->executeConfig();
        //$this->executeGear();
        //$this->createVirtualHost();
        //$this->createGit();
        $this->createNFS();
        return true;
        $this->createBuild();
        return true;
    }

    public function executeGear()
    {
        $script  = realpath(__DIR__.'/../../../script/utils');
        $install = realpath($script.'/installer/run-gear.sh');
        $cmd = sprintf('%s %s', $install, $this->project->getProjectLocation());
        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);
    }


    public function executeInstallation()
    {
        $script  = realpath(__DIR__.'/../../../script/utils');
        $install = realpath($script.'/installer.sh');


        if (!is_file($install)) {
            throw new \Exception('Script of installation can\'t be found on Gear');
        }

        $cmd = sprintf(
            '%s "%s" "%s" "%s" "%s" "%s" "%s" "%s" "%s" "%s" "%s"',
            $install,
            $script,
            $this->project->getFolder(),
            $this->project->getProject(),
            $this->project->getProjectLocation(),
            $this->project->getHost(),
            $this->project->getGit(),
            $this->project->getDatabase(),
            $this->project->getUsername(),
            $this->project->getPassword(),
            $this->str('url', $this->project->getProject())
        );

        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);
    }

    public function executeConfig()
    {
        $global = new \Gear\ValueObject\Config\Globally(array(
            'dbms' => 'mysql',
            'dbname' => $this->project->getDatabase(),
            'dbhost' => 'localhost'
        ));

        $local = new \Gear\ValueObject\Config\Local(array(
            'username' => $this->project->getUsername(),
            'password' => $this->project->getPassword(),
            'host'     => $this->project->getHost(),
            'environment' => 'development'
        ));

        $this->getConfigService()->setUPGlobalProject($global, $this->project->getProjectLocation());
        $this->getConfigService()->setUpLocalProject($local, $this->project->getProjectLocation());
        $this->getConfigService()->setUpEnvironmentProject($local, $this->project->getProjectLocation());
    }


    public function createVirtualHost()
    {
        if ($this->project->getHost() == null) {
            return false;
        }
        $script  = realpath(__DIR__.'/../../../script/utils/installer/virtualhost.sh');
        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }
        $cmd = sprintf('%s %s %s', $script, $this->project->getProjectLocation(), $this->project->getHost());
        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);
        return true;
    }

    public function createNFS()
    {
        if ($this->project->getNfs() == null) {
            return false;
        }

        $script  = realpath(__DIR__.'/../../../script/utils/installer/nfs.sh');

        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf('%s %s', $script, $this->project->getProjectLocation());

        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);

        return true;
    }

    public function createGit()
    {
        if ($this->project->getGit() == null) {
            return false;
        }

        $script  = realpath(__DIR__.'/../../../script/utils/installer/git.sh');

        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf('%s %s %s', $script, $this->project->getProjectLocation(), $this->project->getGit());

        $scriptService = $this->getServiceLocator()->get('scriptService');
        echo $scriptService->run($cmd);

        return true;
    }

    /** x@ */
    public function createBuild()
    {
        //copiar arquivo phpmd do projeto.
        //copiar arquivo phpdox do projeto.
        //copiar build.xml do projeto.
        //copiar build.sh do projeto.

    }

    public function delete($data)
    {
        $project = new \Gear\ValueObject\Project($data);


        $script = realpath(__DIR__.'/../../../script');
        $remove = realpath($script.'/remover.sh');

        if (!is_file($remove)) {
            throw new \Exception('Script of remove can\'t be found on Gear');
        }

        $projectName   = $project->getName();
        $projectFolder = $project->getFolder();

        $cmd = sprintf('%s "%s" "%s"', $remove, $projectFolder, $projectName);

        //echo $cmd;die();
        $scriptService = $this->getServiceLocator()->get('scriptService');
        return $scriptService->run($cmd);
    }

    public function dump($type)
    {
        return $this->getJsonService()->dump($type);
    }

    public function push()
    {
        $this->description = $this->getRequest()->getParam('description', null);

        $configFolder = \GearBase\Module::getProjectFolder();

        if (!is_file($configFolder.'/config/autoload/global.php')) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $moduleConfig = require $configFolder.'/config/autoload/global.php';

        if (!isset($moduleConfig['gear'***REMOVED***['version'***REMOVED***)) {
            throw new \Gear\Exception\ProjectMissingGearException();
        }

        $version = $this->getVersionService()->increment($moduleConfig['gear'***REMOVED***['version'***REMOVED***);

        $this->replaceInFile($configFolder.'/config/autoload/global.php', $moduleConfig['gear'***REMOVED***['version'***REMOVED***, $version);

        $this->getDeployService()->push($configFolder, $version, $this->description);
    }


    public static function getProjectFolder()
    {
        $folder = realpath(__DIR__ . '/../../../../');


        if (is_dir($folder . '/module')) {
            $projectBase = realpath($folder);
            return $projectBase;
        }
        $folder = realpath(__DIR__ . '/../../../../../');


        if (is_dir($folder . '/vendor')) {
            $projectBase = realpath($folder);
            return $projectBase;
        }


        if (is_dir($folder) && substr($folder, -6) == 'vendor') {
            $projectBase = realpath($folder.'/../');
            return $projectBase;
        }

        return null;
    }

    public function getFolder()
    {
        return \Gear\ValueObject\Project::getStaticFolder();
    }

    /**
     * Modificar o export e o .htaccess do sistema para rodar no staging correto.
     */

    public function setUpEnvironment($data)
    {
        $globaly = new \Gear\ValueObject\Config\Globaly($data);
        $script = realpath(__DIR__.'/../../../script');
        $htaccess = realpath($script.'/installer/htaccess.sh');

        $folder = $this->getFolder();

        $cmd = sprintf('%s %s %s', $htaccess, $globaly->getEnvironment(), $folder);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->run($cmd);

        return true;
    }
    /**
     * Modificar o banco de dados utilizado para conexão
     *
     * Permite a criação
     *
     * mysql - bancoteste - dev
     * mysql - bancoteste - prod
     * sqlite - bancoteste - dev
     * sqlite - bancoteste - stag
     *
     */
    public function setUpGlobal(array $data)
    {
        $globaly = new \Gear\ValueObject\Config\Globaly($data);

        $this->createFileFromTemplate(
            'autoload/global',
            array('host' => $globaly->getHost()),
            'global.php',
            $this->getConfig()->getLocal().'/config/autoload'
        );

        $this->createFileFromTemplate(
            sprintf('autoload/db.%s.config', $globaly->getDbms()),
            array(
                'dbname' => $globaly->getDbname()
            ),
            sprintf('db.%s.config.php', $globaly->getEnvironment()),
            $this->getConfig()->getLocal().'/config/autoload/'
        );

        $this->createFileFromTemplate(
            sprintf('autoload/doctrine.%s.config', $globaly->getDbms()),
            array(
                'dbname' => $globaly->getDbname()
            ),
            sprintf('doctrine.%s.config.php', $globaly->getEnvironment()),
            $this->getConfig()->getLocal().'/config/autoload/'
        );

        return true;
    }

    /**
     * Modificar o usuário e senha das conexões doctrine e db.
     */
    public function setUpLocal($data)
    {
        $local = new \Gear\ValueObject\Config\Local($data);

        $this->createFileFromTemplate(
            'autoload/local',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword()
            ),
            'local.php',
            $this->getConfig()->getLocal().'/config/autoload'
        );

        return true;
    }

    public function setUpSqlite(array $data)
    {
        $db = $data['dbname'***REMOVED***;
        $dump = $data['dump'***REMOVED***;

        $script = realpath(__DIR__.'/../../../script');
        $database = realpath($script.'/sqlitefromschema.sh');

        $folder = $this->getFolder();

        $cmd = sprintf('%s %s %s %s', $database, $folder, $db, $dump);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->run($cmd);

        return true;
    }


    public function setUpMysql(array $data)
    {
        $dbname = $data['dbname'***REMOVED***;
        $username = $data['username'***REMOVED***;
        $password = $data['password'***REMOVED***;

        $script = realpath(__DIR__.'/../../../script');
        $database = realpath($script.'/mysqlfromschema.sh');

        $folder = $this->getFolder();

        $cmd = sprintf('%s %s %s %s %s', $database, $folder, $dbname, $username, $password);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        return $scriptService->run($cmd);

    }
/*
    public function getSqliteFromMysql($db, $dump)
    {
        $script = realpath(__DIR__.'/../../../script');
        $database = realpath($script.'/sqlitefrommysql.sh');

        $folder = $this->getFolder();

        $cmd = sprintf('%s %s %s', $database, $db, $dump);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        return  $scriptService->run($cmd);

    }
 */
    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get('Gear\Service\Config');
        }
        return $this->configService;
    }

    public function getJsonService()
    {
        if (!isset($this->jsonService)) {
            $this->jsonService = $this->getServiceLocator()->get('jsonService');
        }
        return $this->jsonService;
    }
}
