<?php
namespace Gear\Project;

use Gear\Service\AbstractJsonService;
use Gear\Script\ScriptServiceTrait;
use Gear\Project\Project;
use Gear\Project\Composer\ComposerServiceTrait;
use GearVersion\Service\VersionServiceTrait;
use Gear\Project\DeployServiceTrait;
use Gear\Edge\DirEdgeTrait;
use Gear\Project\ProjectLocationTrait;
use Gear\Project\Docs\DocsTrait;
use Gear\Upgrade\AntUpgradeTrait;
use Gear\Upgrade\NpmUpgradeTrait;
use Gear\Project\ProjectConfigTrait;

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

    use ProjectConfigTrait;

    use DirEdgeTrait;

    use ComposerServiceTrait;

    use VersionServiceTrait;

    use DeployServiceTrait;

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

        $this->projectConfig = new \Gear\Project\Project(array(
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

        $this->setProject($this->projectConfig->getProjectLocation());

        $this->getScriptService()->setLocation($this->projectConfig->getProjectLocation());




        $this->executeClone();


        //cria
        $this->createIndexFile($this->projectConfig->getProjectLocation());

        //cria
        $this->createApplicationConfigFile($this->projectConfig->getProjectLocation());

        //cria
        $this->getPhinxConfig(
            $this->projectConfig->getProjectLocation(),
            $this->projectConfig->getDatabase(),
            $this->projectConfig->getUsername(),
            $this->projectConfig->getPassword()
        );

        //cria
        $this->getComposerService()->createComposer($this->projectConfig);

        //script
        //$this->getComposerService()->runComposerUpdate($this->projectConfig);

        $this->createDir($this->projectConfig->getProjectLocation());

        $this->createBuild();

        $this->createGulp();

        //cria
        $this->createScriptDeploy();

        //cria($dbname, $username, $password, $host, $environment)
        $this->setUpConfig(
            $this->projectConfig->getDatabase(),
            $this->projectConfig->getUsername(),
            $this->projectConfig->getPassword(),
            $this->str('url', $this->projectConfig->getProject()).'.gear.dev',
            $this->projectConfig->getEnvironment()
        );

        //cria
        $this->getConfigDocs();

        //cria
        $this->getIndexDocs();

        //cria
        $this->getReadme();

        //cria
        $this->createNFS();

        //cria
        $this->createGit();

        return true;
    }


    public function getReadme()
    {
        return $this->getDocs()->createReadme($this->projectConfig->getProjectLocation());
    }

    public function getConfigDocs()
    {
        return $this->getDocs()->createConfig($this->projectConfig->getProjectLocation());
    }

    public function getIndexDocs()
    {

        return $this->getDocs()->createIndex($this->projectConfig->getProjectLocation());
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
            $this->projectConfig->getFolder(),
            $this->projectConfig->getProjectLocation(),
            $this->projectConfig->getProject()
        );

        $scriptService = $this->getScriptService();
        $scriptService->setLocation($this->projectConfig->getFolder());
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

        $this->projectConfig = new \Gear\Project\Project(array(
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

        $projectName   = $this->projectConfig->getProject();
        $projectFolder = $this->projectConfig->getFolder();
        $database      = $this->projectConfig->getDatabase();

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

        $cmd = sprintf('%s %s', $install, $this->projectConfig->getProjectLocation());
        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);
    }



    public function executeConfig()
    {


        $global = new \Gear\Project\Config\Globally(array(
            'dbms' => 'mysql',
            'dbname' => $this->projectConfig->getDatabase(),
            'dbhost' => 'localhost'
        ));

        $local = new \Gear\Project\Config\Local(array(
            'username' => $this->projectConfig->getUsername(),
            'password' => $this->projectConfig->getPassword(),
            'host'     => $this->projectConfig->getHost(),
            'environment' => 'development'
        ));


        $this->setUpConfig();

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
        $this->projectConfig = new \Gear\Project\Project(
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
        $this->projectConfig = new \Gear\Project\Project(
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

        $this->projectConfig = new \Gear\Project\Project(
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
        if ($this->projectConfig->getHost() == null) {
            return false;
        }

        $env = ($this->projectConfig->getEnvironment()!== null) ? $this->projectConfig->getEnvironment() : 'development';

        $script  = realpath(__DIR__.'/../../../bin/virtualhost');
        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }
        $cmd = sprintf('%s %s %s %s', $script, $this->projectConfig->getProjectLocation(), $this->projectConfig->getHost(), $env);
        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);
        return true;
    }

    public function createNFS()
    {
        if ($this->projectConfig->getNfs() == null) {
            return false;
        }

        $script  = realpath(__DIR__.'/../../../bin/nfs');

        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf('%s %s', $script, $this->projectConfig->getProjectLocation());

        $scriptService = $this->getScriptService();
        echo $scriptService->run($cmd);

        return true;
    }

    public function createGit()
    {
        if ($this->projectConfig->getGit() == null) {
            return false;
        }

        $script  = realpath(__DIR__.'/../../../bin/git');

        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $cmd = sprintf('%s %s %s', $script, $this->projectConfig->getProjectLocation(), $this->projectConfig->getGit());

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
            $this->projectConfig->getProjectLocation()
        );
    }

    public function getGulpfileConfig()
    {
        $this->getFileCreator()->createFile(
            'template/project/config.phtml',
            array(
            ),
            'config.json',
            $this->projectConfig->getProjectLocation().'/data'
        );
    }

    public function copyPHPMD()
    {
        if (!is_dir($this->projectConfig->getProjectLocation().'/config/jenkins')) {
            $this->getDirService()->mkDir($this->projectConfig->getProjectLocation().'/config/jenkins');
            //mkdir($this->projectConfig->getProjectLocation().'/config/jenkins/', 0777);
        }

        $this->getFileCreator()->createFile(
            'template/project/test/phpmd.xml.phtml',
            array(
                'project' => $this->str('label', $this->projectConfig->getProject()),
            ),
            'phpmd.xml',
            $this->projectConfig->getProjectLocation().'/config/jenkins/'
        );

        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/config/jenkins/phpmd.xml');
    }

    public function getScriptDevelopment()
    {
        if (isset($this->projectConfig) && $this->projectConfig instanceof Project) {
            $script = $this->projectConfig->getProjectLocation().'/script';
            $projectName = $this->projectConfig->getProject();
            $projectUrl = $this->str('url', $this->projectConfig->getProject());
            //$projectHost = $this->projectConfig->getHost();
        } else {
            $script = $this->getProject().'/script';

            $projectName = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
            $projectUrl = $this->str('url', $projectName);
            //$name = $this->config['gear'***REMOVED***['project'***REMOVED***['host'***REMOVED***;
        }

        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-development.phtml',
            array(
                'project' => $projectName,
                'projectUrl' => $projectUrl,
                //'database' => $this->projectConfig->getDatabase(),
                //'databaseUrl' => $this->str('url', $this->projectConfig->getProject()),
                //'host' => $this->projectConfig->getHost()
            ),
            'deploy-development.sh',
            $script
        );
    }

    public function getScriptStaging()
    {
        $script = $this->projectConfig->getProjectLocation().'/script';


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
        $script = $this->projectConfig->getProjectLocation().'/script';


        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-testing.phtml',
            array(
                'database' => $this->projectConfig->getDatabase(),
                'databaseUrl' => $this->str('url', $this->projectConfig->getProject()),
                'host' => $this->projectConfig->getHost()
            ),
            'deploy-testing.sh',
            $script
        );

    }

    public function getScriptProduction()
    {
        $script = $this->projectConfig->getProjectLocation().'/script';

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
                'project' => $this->str('url', $this->projectConfig->getProject()),
                'git' => ($this->projectConfig->getGit() !== null) ? $this->projectConfig->getGit() : ''
            ),
            'package.json',
            $this->projectConfig->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/package.json');

        $this->getNpmUpgrade()->setProject($this->projectConfig->getProjectLocation());
        $this->getNpmUpgrade()->upgradeProject('web');
    }

    public function getKarmaConfig()
    {
        $this->getFileCreator()->createFile(
            'template/project/test/karma.phtml',
            array(

            ),
            'karma.conf.js',
            $this->projectConfig->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/package.json');
    }

    public function getProtractorConfig()
    {
        $this->getFileCreator()->createFile(
            'template/project/test/end2end.phtml',
            array(
                'host' => $this->projectConfig->getHost()
            ),
            'protractor.conf.js',
            $this->projectConfig->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/package.json');
    }

    public function getPhpdoxConfig()
    {
        $this->getFileCreator()->createFile(
            'template/project/test/phpdox.xml.phtml',
            array(
                'project' => $this->str('url', $this->projectConfig->getProject()),
            ),
            'phpdox.xml',
            $this->projectConfig->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/phpdox.xml');
    }

    public function createBuildFile()
    {
        $this->getFileCreator()->createFile(
            'template/project/project.build.xml.phtml',
            array(
                'project' => $this->str('url', $this->projectConfig->getProject()),
            ),
            'build.xml',
            $this->projectConfig->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/build.xml');
    }

    public function createBuildXml()
    {
        $this->createBuildFile();

        $this->getAntUpgrade()->setProject($this->projectConfig->getProjectLocation());
        $this->getAntUpgrade()->upgradeProject('web');
    }

    /*
    public function createBuildSh()
    {

        $buildService = $this->getServiceLocator()->get('buildService');

        $share = $buildService->getShared();

        copy($share.'/build.sh', $this->projectConfig->getProjectLocation().'/build.sh');
        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/build.sh');
    }
    */

    public function getCodeception()
    {
        $this->getFileCreator()->createFile(
            'template/project/project.codeception.yml.phtml',
            array(
                'project' => $this->str('url', $this->projectConfig->getProject()),
            ),
            'codeception.yml',
            $this->projectConfig->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->projectConfig->getProjectLocation().'/codeception.yml');
    }

    public function getFolder()
    {
        return \GearBase\Module::getProjectFolder();
    }
    /**
     * Modificar o export e o .htaccess do sistema para rodar no staging correto.
     */

    public function setUpEnvironment($environment)
    {
        if (!in_array($environment, ['development', 'testing', 'staging', 'production'***REMOVED***)) {
            return false;
        }

        $htaccess = 'RewriteEngine On'."\n".
'SetEnv APP_ENV '.$environment."\n".
'RewriteCond %{REQUEST_FILENAME} -s [OR***REMOVED***'."\n".
'RewriteCond %{REQUEST_FILENAME} -l [OR***REMOVED***'."\n".
'RewriteCond %{REQUEST_FILENAME} -d'."\n".
'RewriteRule ^.*$ - [NC,L***REMOVED***'."\n".
'RewriteCond %{REQUEST_URI}::\$1 ^(/.+)(.+)::\2$'."\n".
'RewriteRule ^(.*) - [E=BASE:%1***REMOVED***'."\n".
'RewriteRule ^(.*)$ %{ENV:BASE}index.php [NC,L***REMOVED***';



        file_put_contents($this->getProject().'/public/.htaccess', $htaccess);

        return true;
    }

    public function setUpConfig($dbname, $username, $password, $host, $environment)
    {
        $this->setUpGlobal($dbname, $host, $environment);
        $this->setUpLocal($username, $password);
        $this->setUpEnvironment($environment);

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

        $localDist = $this->getFileCreator()->renderPartial(
            'template/project/config/autoload/local.phtml',
            array(
                'username' => $local->getUsername(),
                'password' => $local->getPassword(),
            )
        );

        file_put_contents($this->getProject().'/config/autoload/local.php.dist', '<?php'.PHP_EOL.$localDist);

        return true;
    }
}
