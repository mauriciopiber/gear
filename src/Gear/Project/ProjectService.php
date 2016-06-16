<?php
namespace Gear\Project;

use Gear\Service\AbstractJsonService;
use Gear\Script\ScriptServiceTrait;
use Gear\Project\Project;
use Gear\Project\Composer\ComposerServiceTrait;
use GearVersion\Service\VersionServiceTrait;
use Gear\Project\DeployServiceTrait;
use Gear\Config\Service\ConfigServiceTrait;
use Gear\Edge\DirEdgeTrait;
use Gear\Project\ProjectLocationTrait;
use Gear\Project\Docs\DocsTrait;
use Gear\Upgrade\AntUpgradeTrait;
use Gear\Upgrade\NpmUpgradeTrait;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ProjectService extends AbstractJsonService
{
    use AntUpgradeTrait;

    use NpmUpgradeTrait;

    use DocsTrait;

    use ProjectLocationTrait;

    use DirEdgeTrait;

    use ComposerServiceTrait;

    use VersionServiceTrait;

    use DeployServiceTrait;

    use ConfigServiceTrait;

    use ScriptServiceTrait;

    static public $clone = 'installer-utils/clone-skeleton';

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

        $type = $request->getParam('type', 'web');

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
            'type'     => $type,
            'folder'   => $basepath
        ));

        $this->getScriptService()->setLocation($this->project->getProjectLocation());

        $this->createBuild();

        return;

        $this->executeClone();

        $this->createIndexFile($this->project->getProjectLocation());

        $this->createApplicationConfigFile($this->project->getProjectLocation());

        $this->getPhinxConfig(
            $this->project->getProjectLocation(),
            $this->project->getDatabase(),
            $this->project->getUsername(),
            $this->project->getPassword()
        );

        $this->getComposerService()->createComposer($this->project);
        $this->getComposerService()->runComposerUpdate($this->project);

        $this->createDir($this->project->getProjectLocation());


        $this->createGulp();



        $this->executeInstallation();


        $this->createScriptDeploy();


        $this->executeConfig();

        $this->executeGear();

        $this->createVirtualHost();

        $this->getConfigDocs();

        $this->getIndexDocs();

        $this->getReadme();

        $this->createNFS();

        $this->createGit();

        return true;
    }


    public function getReadme()
    {
        return $this->getDocs()->createReadme($this->project->getProjectLocation());
    }

    public function getConfigDocs()
    {
        return $this->getDocs()->createConfig($this->project->getProjectLocation());
    }

    public function getIndexDocs()
    {
        return $this->getDocs()->createIndex($this->project->getProjectLocation());
    }

    /**
     * Cria diretórios extras e ignores.
     * @param string $projectLocation
     * @return boolean Diretórios foram criados corretamente
     */
    public function createDir($projectLocation)
    {
        $edge = $this->getDirEdge()->getDirProject('web');

        if (count($edge['writable'***REMOVED***)>0) {
            foreach ($edge['writable'***REMOVED*** as $folder) {
                $fullpath = $projectLocation.'/'.$folder;
                $this->getDirService()->mkDir($fullpath);
            }
        }

        if (count($edge['ignore'***REMOVED***)>0) {
            foreach ($edge['ignore'***REMOVED*** as $folder) {
                $fullpath = $projectLocation.'/'.$folder.'/.gitignore';
                file_put_contents(
                    $fullpath,
                    <<<EOS
*
!.gitignore

EOS
                );
            }
        }

        return true;
    }

    /**
     * Cria o arquivo public/index.php
     */
    public function createIndexFile($projectLocation)
    {
        return $this->getFileCreator()->createFile(
            'template/project/public/index.php.phtml',
            array(
            ),
            'index.php',
            $projectLocation.'/public'
        );
    }

    public function createApplicationConfigFile($projectLocation)
    {
        return $this->getFileCreator()->createFile(
            'template/project/config/application.config.phtml',
            array(
            ),
            'application.config.php',
            $projectLocation.'/config'
        );
    }

    public function getPhinxConfig($projectLocation, $database, $username, $password)
    {
        return $this->getFileCreator()->createFile(
            'template/project/phinx.phtml',
            array(
                'database' => $database,
                'username' => $username,
                'password' => $password
            ),
            'phinx.yml',
            $projectLocation
        );
    }

    /**
     * Clona o ZendSkeleton
     */
    public function executeClone()
    {
        $install = realpath((new \Gear\Module())->getLocation().'/../../bin/'.static::$clone);

        if (!is_file($install)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf(
            '%s %s %s %s',
            $install,
            $this->project->getFolder(),
            $this->project->getProjectLocation(),
            $this->project->getProject()
        );

        $scriptService = $this->getScriptService();
        $scriptService->setLocation($this->project->getFolder());
        echo $scriptService->run($cmd);
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

    public function getBuildpath()
    {
        $file = $this->getFileCreator();

        $template = 'template/project/buildpath.phtml';
        $filename = '.buildpath';
        $location = $this->getModule()->getMainFolder();

        $file->setTemplate($template);
        $file->setOptions([***REMOVED***);
        $file->setFileName($filename);
        $file->setLocation($location);

        return $file->render();
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
        $this->getPhpdoxConfig();
        $this->createBuildXml();
        $this->getCodeception();
        $this->getPackageConfig();
        $this->getKarmaConfig();
        $this->getProtractorConfig();
        //$this->createBuildSh();
    }



    public function createGulp()
    {
        $this->getGulpfileJs();
        $this->getGulpfileConfig();
    }

    public function getGulpfileJs()
    {
        $this->getFileCreator()->createFile(
            'template/project/gulpfile.phtml',
            array(
            ),
            'gulpfile.js',
            $this->project->getProjectLocation()
        );
    }

    public function getGulpfileConfig()
    {
        $this->getFileCreator()->createFile(
            'template/project/config.phtml',
            array(
            ),
            'config.json',
            $this->project->getProjectLocation().'/data'
        );
    }

    public function copyPHPMD()
    {
        if (!is_dir($this->project->getProjectLocation().'/config/jenkins')) {
            $this->getDirService()->mkDir($this->project->getProjectLocation().'/config/jenkins');
            //mkdir($this->project->getProjectLocation().'/config/jenkins/', 0777);
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

    public function getScriptDevelopment()
    {
        $script = $this->project->getProjectLocation().'/script';

        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-development.phtml',
            array(
                'database' => $this->project->getDatabase(),
                'databaseUrl' => $this->str('url', $this->project->getProject()),
                'host' => $this->project->getHost()
            ),
            'deploy-development.sh',
            $script
        );
    }

    public function getScriptStaging()
    {
        $script = $this->project->getProjectLocation().'/script';


        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-staging.phtml',
            array(
            ),
            'deploy-staging.sh',
            $script
        );

    }

    public function getScriptTesting()
    {
        $script = $this->project->getProjectLocation().'/script';


        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-testing.phtml',
            array(
                'database' => $this->project->getDatabase(),
                'databaseUrl' => $this->str('url', $this->project->getProject()),
                'host' => $this->project->getHost()
            ),
            'deploy-testing.sh',
            $script
        );

    }

    public function getScriptProduction()
    {
        $script = $this->project->getProjectLocation().'/script';

        $this->getFileCreator()->createFile(
            'template/project/script/deploy-production.phtml',
            array(
            ),
            'deploy-production.sh',
            $script
        );
    }

    public function createScriptDeploy()
    {
        $this->getScriptDevelopment();
        $this->getScriptStaging();
        $this->getScriptProduction();
        $this->getScriptTesting();

    }

    public function getPackageConfig()
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

    public function getKarmaConfig()
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

    public function getProtractorConfig()
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

    public function getPhpdoxConfig()
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

    public function createBuildFile()
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

    public function createBuildXml()
    {
        $this->createBuildFile();

        $this->getAntUpgrade()->setProject($this->project->getProjectLocation());
        $this->getAntUpgrade()->upgradeProject('web');
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

    public function getCodeception()
    {
        $this->getFileCreator()->createFile(
            'template/project/project.codeception.yml.phtml',
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

    public function setUpConfig($dbname, $username, $password, $host, $environment)
    {
        $this->setUpGlobal($dbname, $host, $environment);
        $this->setUpLocal($username, $password);
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
    public function setUpGlobal($dbname, $host, $environment)
    {

        $this->getFileCreator()->createFile(
            'template/project/config/autoload/global.phtml',
            [***REMOVED***,
            'global.php',
            $this->getProject().'/config/autoload'
        );

        $this->getFileCreator()->createFile(
            'template/project/config/autoload/global-environment.phtml',
            [
                'dbname' => $dbname,
                'host' => $host,
                'environment' => $environment
            ***REMOVED***,
            sprintf('global.%s.php', $environment),
            $this->getProject().'/config/autoload'
        );

        return true;
    }

    /**
     * Modificar o usuário e senha das conexões doctrine e db.
     */
    public function setUpLocal($username, $password)
    {
        $local = new \Gear\Project\Config\Local([
            'username' => $username,
            'password' => $password
        ***REMOVED***);

        $this->getFileCreator()->createFile(
            'template/project/config/autoload/local.phtml',
            [
                'username' => $local->getUsername(),
                'password' => $local->getPassword()
            ***REMOVED***,
            'local.php',
            $this->getProject().'/config/autoload'
        );

        return true;
    }
}
