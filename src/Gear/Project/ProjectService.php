<?php
namespace Gear\Project;

use Gear\Service\AbstractJsonService;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Yaml;
use Gear\Service\Module\ScriptService;
use Gear\Project\Project;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ProjectService extends AbstractJsonService
{
    use \GearVersion\Service\VersionServiceTrait;

    use \Gear\Project\DeployServiceTrait;

    use \Gear\Config\Service\ConfigServiceTrait;

    use \Gear\Script\ScriptServiceTrait;

    //use \Gear\ContinuousIntegration\JenkinsTrait;

    /*
     * Função responsável por criar projetos do zero e inicia-los no servidor onde o Gear está instalado
     * Gerará projetos na pasta irmã ao projeto específico
     * @return string
     */
    public function create()
    {
        $request = $this->getRequest();

        $basepath = $request->getParam('basepath', null);

        if ($basepath) {
            $basepath = realpath($basepath);
        }

        $this->project = new \Gear\Project\Project(array(
            'project'  => $request->getParam('project', null),
            'host'     => $request->getParam('host', null),
            'git'      => $request->getParam('git', null),
            'database' => $request->getParam('database', null),
            'username' => $request->getParam('username', null),
            'password' => $request->getParam('password', null),
            'nfs'      => $request->getParam('nfs', null),
            'folder'   => $basepath
        ));

        $this->executeInstallation();

        $this->executeConfig();
        $this->executeGear();
        $this->createVirtualHost();
        $this->createNFS();

        $this->createScriptDeploy();
        //$this->createJenkins();
        $this->createGit();

        $this->createBuild();
        $this->createGulp();

        return true;
    }

    public function dumpAutoload()
    {
        return true;
    }

    public function delete()
    {
        $request = $this->getRequest();

        $basepath = $request->getParam('basepath', null);

        if ($basepath) {
            $basepath = realpath($basepath);
        }

        $this->project = new \Gear\Project\Project(array(
            'project'  => $request->getParam('project', null),
            'host'     => $request->getParam('host', null),
            'database' => $request->getParam('database', null),
            'nfs'      => $request->getParam('nfs', null),
            'folder'   => $basepath
        ));



        $script = realpath(__DIR__.'/../../../bin');
        $remove = realpath($script.'/remove');

        if (!is_file($remove)) {
            throw new \Gear\Exception\FileNotFoundException('Script of remove can\'t be found on Gear');
        }

        $projectName   = $this->project->getProject();
        $projectFolder = $this->project->getFolder();
        $database      = $this->project->getDatabase();

        $cmd = sprintf('%s "%s" "%s"', $remove, $projectFolder, $projectName, $database);

        $scriptService = $this->getScriptService();
        return $scriptService->run($cmd);
    }

    public function projectJenkins()
    {
        $jenkins = $this->getJenkins();
        $job = new \Gear\ContinuousIntegration\Jenkins\Job();
        $jenkins->createJob($job);

    }

    public function createJenkins()
    {
        $jenkins = $this->getJenkins();

        $job = new \Gear\ContinuousIntegration\Jenkins\Job();
        $job->setName($this->str('url', $this->project->getProject()));
        $job->setPath($this->project->getProjectLocation());
        $job->setStandard($jenkins->getConfigMap('project-codeception'));

        $jenkins->createJob($job);
        return true;
    }

    /**
    public function getScriptService()
    {
        if (!isset($this->scriptService)) {
            $this->scriptService = $this->getServiceLocator()->get('scriptService');
            $this->scriptService->setLocation(\GearBase\Module::getProjectFolder());
        }
        return $this->scriptService;
    }
    */

    public function build()
    {
        return $this->getBuildService()->buildProject();
    }

    public function executeGear()
    {
        $script  = realpath(__DIR__.'/../../../bin');

        $install = realpath($script.'/installer-utils/run-gear.sh');


        if (!is_file($install)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf('%s %s', $install, $this->project->getProjectLocation());
        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);
    }


    public function executeInstallation()
    {
        $script  = realpath(__DIR__.'/../../../bin');
        $install = realpath($script.'/installer');


        if (!is_file($install)) {
            throw new \Gear\Exception\FileNotFoundException();
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

        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);
    }

    public function executeConfig()
    {
        $global = new \Gear\Project\Config\Globally(array(
            'dbms' => 'mysql',
            'dbname' => $this->project->getDatabase(),
            'dbhost' => 'localhost'
        ));

        $local = new \Gear\Project\Config\Local(array(
            'username' => $this->project->getUsername(),
            'password' => $this->project->getPassword(),
            'host'     => $this->project->getHost(),
            'environment' => 'development'
        ));

        $this->getConfigService()->setUPGlobalProject($global, $this->project->getProjectLocation());
        $this->getConfigService()->setUpLocalProject($local, $this->project->getProjectLocation());
        $this->getConfigService()->setUpEnvironmentProject($local, $this->project->getProjectLocation());
    }

    public function virtualHost()
    {
        $request = $this->getRequest();

        $environment = $request->getParam('environment');

        if (!in_array($environment, ['development', 'production', 'testing', 'staging'***REMOVED***)) {
            throw new \Exception('Não é seguro iniciar o sistema com ambiente: '.$environment);
        }


        $folderToExport = \GearBase\Module::getProjectFolder();
        $name = explode('/', $folderToExport);
        $name = end($name);
        $this->project = new \Gear\Project\Project(
            array(
                'host'  => $this->getServiceLocator()->get('config')['webhost'***REMOVED***,
                'project' => $name,
                'environment' => $environment
            )
        );

        $this->createVirtualHost();
    }

    public function git()
    {
        $request = $this->getRequest();

        $folderToExport = \GearBase\Module::getProjectFolder();
        $name = explode('/', $folderToExport);
        $name = end($name);
        $this->project = new \Gear\Project\Project(
            array(
                'git'  => $request->getParam('git'),
                'project' => $name,
            )
        );

        $this->createGit();
    }

    public function nfs()
    {
        $request = $this->getRequest();


        $folderToExport = \GearBase\Module::getProjectFolder();
        $name = explode('/', $folderToExport);
        $name = end($name);

        $this->project = new \Gear\Project\Project(
            array(
                'git'  => $request->getParam('git'),
                'project' => $name,
                'nfs'  => true
            )
        );

        $name = explode('/', $folderToExport);
        $name = end($name);

        $this->createNFS();
    }


    public function createVirtualHost()
    {
        if ($this->project->getHost() == null) {
            return false;
        }

        $env = ($this->project->getEnvironment()!== null) ? $this->project->getEnvironment() : 'development';

        $script  = realpath(__DIR__.'/../../../bin/virtualhost');
        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }
        $cmd = sprintf('%s %s %s %s', $script, $this->project->getProjectLocation(), $this->project->getHost(), $env);
        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);
        return true;
    }

    public function createNFS()
    {
        if ($this->project->getNfs() == null) {
            return false;
        }

        $script  = realpath(__DIR__.'/../../../bin/nfs');

        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf('%s %s', $script, $this->project->getProjectLocation());

        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);

        return true;
    }

    public function createGit()
    {
        if ($this->project->getGit() == null) {
            return false;
        }

        $script  = realpath(__DIR__.'/../../../bin/git');

        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf('%s %s %s', $script, $this->project->getProjectLocation(), $this->project->getGit());

        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);

        return true;
    }

    /** x@ */
    public function createBuild()
    {
        $this->copyPHPMD();
        $this->createPHPDox();
        $this->createBuildXml();
        $this->createCodeceptionYml();
        $this->createPackage();
        $this->createKarma();
        $this->createProtractor();
        //$this->createBuildSh();
    }

    public function createGulp()
    {
        $this->createGulpfile();
        $this->createConfig();
    }

    public function createGulpFile()
    {
        $this->getFileCreator()->createFile(
            'template/project/gulpfile.phtml',
            array(
            ),
            'gulpfile.js',
            $this->project->getProjectLocation()
        );
    }

    public function createConfig()
    {
        $this->getFileCreator()->createFile(
            'template/project/config.phtml',
            array(
            ),
            'config.json',
            $this->project->getProjectLocation()
        );
    }

    public function copyPHPMD()
    {
        if (!is_dir($this->project->getProjectLocation().'/config/jenkins/')) {
            mkdir($this->project->getProjectLocation().'/config/jenkins/', 0777);
        }

        $this->getFileCreator()->createFile(
            'template/project/test/phpmd.xml.phtml',
            array(
                'project' => $this->str('label', $this->project->getProject()),
            ),
            'phpmd.xml',
            $this->project->getProjectLocation().'/config/jenkins/'
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/config/jenkins/phpmd.xml');
    }

    public function createScriptDeploy()
    {
        $script = $this->project->getProjectLocation().'/script';

        $this->getFileCreator()->createFile(
            'template/project/script/deploy-development.phtml',
            array(
                'database' => $this->project->getDatabase(),
                'databaseUrl' => $this->str('url', $this->project->getProject()),
                'host' => $this->project->getHost()
            ),
            'deploy-development.sh',
            $script
        );

        $this->getFileCreator()->createFile(
            'template/project/script/deploy-staging.phtml',
            array(
            ),
            'deploy-staging.sh',
            $script
        );

        $this->getFileCreator()->createFile(
            'template/project/script/deploy-testing.phtml',
            array(
                'database' => $this->project->getDatabase(),
                'databaseUrl' => $this->str('url', $this->project->getProject()),
                'host' => $this->project->getHost()
            ),
            'deploy-testing.sh',
            $script
        );

        $this->getFileCreator()->createFile(
            'template/project/script/deploy-production.phtml',
            array(
            ),
            'deploy-production.sh',
            $script
        );
    }

    public function createPackage()
    {
        $this->getFileCreator()->createFile(
            'template/project/package.phtml',
            array(
                'project' => $this->str('url', $this->project->getProject()),
                'git' => ($this->project->getGit() !== null) ? $this->project->getGit() : ''
            ),
            'package.json',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/package.json');
    }

    public function createKarma()
    {
        $this->getFileCreator()->createFile(
            'template/project/test/karma.phtml',
            array(

            ),
            'karma.conf.js',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/package.json');
    }

    public function createProtractor()
    {
        $this->getFileCreator()->createFile(
            'template/project/test/end2end.phtml',
            array(
                'host' => $this->project->getHost()
            ),
            'protractor.conf.js',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/package.json');
    }

    public function createPHPDox()
    {
        $this->getFileCreator()->createFile(
            'template/project/test/phpdox.xml.phtml',
            array(
                'project' => $this->str('url', $this->project->getProject()),
            ),
            'phpdox.xml',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/phpdox.xml');
    }

    public function createBuildXml()
    {
        $this->getFileCreator()->createFile(
            'template/project/project.build.xml.phtml',
            array(
                'project' => $this->str('url', $this->project->getProject()),
            ),
            'build.xml',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/build.xml');
    }

    /*
    public function createBuildSh()
    {

        $buildService = $this->getServiceLocator()->get('buildService');

        $share = $buildService->getShared();

        copy($share.'/build.sh', $this->project->getProjectLocation().'/build.sh');
        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/build.sh');
    }
    */

    public function createCodeceptionYml()
    {
        $this->getFileCreator()->createFile(
            'template/project.codeception.yml.phtml',
            array(
                'project' => $this->str('url', $this->project->getProject()),
            ),
            'codeception.yml',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/codeception.yml');
    }

    public function getFolder()
    {
        return \GearBase\Module::getProjectFolder();
    }
    /**
     * Modificar o export e o .htaccess do sistema para rodar no staging correto.
     */

    public function setUpEnvironment($data)
    {
        $globaly = new \Gear\Project\Config\Globaly($data);
        $script = realpath(__DIR__.'/../../../../bin');
        $htaccess = realpath($script.'/installer-utils/htaccess.sh');

        $folder = $this->getFolder();

        $cmd = sprintf('%s %s %s', $htaccess, $globaly->getEnvironment(), $folder);

        $scriptService = $this->getScriptService();
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
        $globaly = new \Gear\Project\Config\Globaly($data);

        $this->getFileCreator()->createFile(
            'autoload/global',
            array('host' => $globaly->getHost()),
            'global.php',
            $this->getConfig()->getLocal().'/config/autoload'
        );

        $this->getFileCreator()->createFile(
            sprintf('autoload/db.%s.config', $globaly->getDbms()),
            array(
                'dbname' => $globaly->getDbname()
            ),
            sprintf('db.%s.config.php', $globaly->getEnvironment()),
            $this->getConfig()->getLocal().'/config/autoload/'
        );

        $this->getFileCreator()->createFile(
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
        $local = new \Gear\Project\Config\Local($data);

        $this->getFileCreator()->createFile(
            'autoload/local',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword()
            ),
            'local.php',
            $this->getModule()->getConfigAutoloadFolder()
        );

        return true;
    }
    /*
    public function setUpSqlite(array $data)
    {
        $db = $data['dbname'***REMOVED***;
        $dump = $data['dump'***REMOVED***;

        $script = realpath(__DIR__.'/../../../script');
        $database = realpath($script.'/sqlitefromschema.sh');

        $folder = $this->getFolder();

        $cmd = sprintf('%s %s %s %s', $database, $folder, $db, $dump);

        $scriptService = $this->getScriptService();
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

        $scriptService = $this->getScriptService();
        return $scriptService->run($cmd);

    }

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
}
