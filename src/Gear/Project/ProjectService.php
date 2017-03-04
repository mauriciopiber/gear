<?php
namespace Gear\Project;

use Gear\Project\Exception\ProjectNotConfigurableException;
use Gear\Service\AbstractJsonService;
use Gear\Script\ScriptServiceTrait;
use Gear\Project\Project;
use Gear\Project\Composer\ComposerServiceTrait;
use GearVersion\Service\VersionServiceTrait;
//use Gear\Project\DeployServiceTrait;
use Gear\Edge\DirEdgeTrait;
use Gear\Project\ProjectLocationTrait;
use Gear\Project\Docs\DocsTrait;
use Gear\Upgrade\AntUpgradeTrait;
use Gear\Upgrade\NpmUpgradeTrait;
use Gear\Project\ProjectConfigTrait;
use Gear\Project\Exception\BasePathNotFoundException;

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

    use ScriptServiceTrait;

    static public $clone = 'installer-utils/clone-skeleton';

    protected $staging;
    
    protected $production;
    
    //use \Gear\ContinuousIntegration\JenkinsTrait;

    /*
     * Função responsável por criar projetos do zero e inicia-los no servidor onde o Gear está instalado
     * Gerará projetos na pasta irmã ao projeto específico
     * @return string
     */
    public function create($type, $staging = null, $production = null)
    {
        $request = $this->getRequest();

        $basepath = $request->getParam('basepath', null);

        $type = $request->getParam('type', 'web');
        $this->staging = $request->getParam('staging', null);
        $this->production = $request->getParam('production', null);

        if ($basepath !== null && !is_dir($basepath)) {
            throw new BasePathNotFoundException();
        }

        if ($basepath === null) {
            $basepath = \GearBase\Module::getProjectParentFolder();
        }

        if (($host = $request->getParam('host', null)) === null) {
            $host = sprintf('%s.gear.dev', $this->str('url', $request->getParam('project')));
        }

        if (($git = $request->getParam('git', null)) === null) {
            $git = sprintf('git@bitbucket.org:mauriciopiber/%s.git', $this->str('url', $request->getParam('project')));
        }

        if (($database = $request->getParam('database', null)) === null) {
            $database = $this->str('uline', $request->getParam('project'));
        }

        $this->projectConfig = new Project(array(
            'project'  => $request->getParam('project', null),
            'host'     => $host,
            'git'      => $git,
            'database' => $database,
            'username' => $request->getParam('username', 'root'),
            'password' => $request->getParam('password', 'gear'),
            'nfs'      => $request->getParam('nfs', null),
            'type'     => $type,
            'folder'   => $basepath
        ));

        $this->setProject($this->projectConfig->getProjectLocation());

        $this->getScriptService()->setLocation($this->projectConfig->getProjectLocation());


        $this->executeClone();

        $this->createDir($this->projectConfig->getProjectLocation());

        //cria($dbname, $username, $password, $host, $environment)
        $this->setUpConfig(
            $this->projectConfig->getDatabase(),
            $this->projectConfig->getUsername(),
            $this->projectConfig->getPassword(),
            $this->str('url', $this->projectConfig->getProject()).'.gear.dev',
            'development'
        );


        //cria
        $this->createIndexFile($this->projectConfig->getProjectLocation());

        //cria
        $this->createApplicationConfigFile($this->projectConfig->getProjectLocation());

        //cria
        $this->getPhinxConfig();

        //cria
        $this->getComposerService()->createComposer($this->projectConfig);

        //script
        //$this->getComposerService()->runComposerUpdate($this->projectConfig);

        $this->createBuild();

        $this->createGulp();

        //cria
        $this->createScriptDeploy();

        //cria
        $this->getConfigDocs();

        //cria
        $this->getIndexDocs();
        
        $this->getChangelogDocs();

        //cria
        $this->getReadme();

        $this->createGitIgnore();

        $this->createJenkinsFile();

        //cria
        //$this->createNFS();

        //cria
        //$this->createGit();

        return true;
    }


    /**
     * Cria arquivo config/application.config.php para módulos as project
     *
     * @param string $type Tipo do módulo Web|Cli
     *
     * @return string
     */
    public function createJenkinsFile()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/project/jenkinsfile.phtml');
        $file->setOptions(['projectUrl' => $this->str('url', $this->getProjectName())***REMOVED***);
        $file->setFileName('Jenkinsfile');
        $file->setLocation($this->getProjectRealFolder());
        return $file->render();
    }


    public function createGitIgnore()
    {
        $file = $this->getFileCreator();
        $file->setTemplate('template/project/gitignore.phtml');
        $file->setOptions([***REMOVED***);
        $file->setFileName('.gitignore');
        $file->setLocation($this->getProjectRealFolder());
        return $file->render();
    }


    public function getReadme()
    {
        return $this->getDocs()->createReadme($this->getProjectName(), $this->getProjectRealFolder());
    }

    
    public function getConfigDocs()
    {
        return $this->getDocs()->createConfig($this->getProjectName(), $this->getProjectRealFolder());
    }

    public function getIndexDocs()
    {

        return $this->getDocs()->createIndex($this->getProjectName(), $this->getProjectRealFolder());
    }


    public function getChangelogDocs()
    {
    
        return $this->getDocs()->createChangelog($this->getProjectName(), $this->getProjectRealFolder());
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

    public function getPhinxConfig()
    {
        if (isset($this->projectConfig) && $this->projectConfig instanceof Project) {
            $database = $this->projectConfig->getDatabase();
            $username = $this->projectConfig->getUsername();
            $password = $this->projectConfig->getPassword();
        } else {
            $database = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***;
            $username = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['username'***REMOVED***;
            $password = $this->config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['password'***REMOVED***;
        }

        return $this->getFileCreator()->createFile(
            'template/project/phinx.phtml',
            array(
                'database' => $database,
                'username' => $username,
                'password' => $password
            ),
            'phinx.yml',
            $this->getProjectRealFolder()
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

        $env = ($this->projectConfig->getEnvironment()!== null) ?
          $this->projectConfig->getEnvironment() : 'development';

        $script  = realpath(__DIR__.'/../../../bin/virtualhost');
        if (!is_file($script)) {
            throw new \Gear\Exception\FileNotFoundException();
        }
        $cmd = sprintf(
            '%s %s %s %s',
            $script,
            $this->projectConfig->getProjectLocation(),
            $this->projectConfig->getHost(),
            $env
        );

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
        $this->getProtractorReportConfig();
        $this->getPhpcsDocs();
        //$this->createBuildSh();
    }

    public function getPhpcsDocs()
    {
        $project = $this->getProjectRealFolder();

        return $this->getFileCreator()->createFile(
            'template/project/phpcs-docs.phtml',
            array(
                'project' => $this->str('label', $this->getProjectName())
            ),
            'phpcs-docs.xml',
            $project
        );
    }

    public function getJenkinsFile()
    {
        $project = $this->getProjectRealFolder();

        return $this->getFileCreator()->createFile(
            'template/project/jenkinsfile.phtml',
            array(
                'projectUrl' => $this->str('url', $this->getProjectName())
            ),
            'Jenkinsfile',
            $project
        );
    }



    public function createGulp()
    {
        $this->getGulpfileJs();
        $this->getGulpfileConfig();
    }

    public function getGulpfileJs()
    {
        $project = $this->getProjectRealFolder();

        return $this->getFileCreator()->createFile(
            'template/project/gulpfile.phtml',
            array(
            ),
            'gulpfile.js',
            $project
        );
    }

    public function getGulpfileConfig()
    {
        $project = $this->getProjectRealFolder();

        return $this->getFileCreator()->createFile(
            'template/project/config.phtml',
            array(
            ),
            'config.json',
            $project.'/data'
        );
    }

    public function copyPHPMD()
    {

        $file = $this->getFileCreator()->createFile(
            'template/project/test/phpmd.xml.phtml',
            array(
                'project' => $this->str('label', $this->getProjectName()),
            ),
            'phpmd.xml',
            $this->getProjectRealFolder()
        );

        $this->getFileService()->chmod(0777, $this->getProjectRealFolder().'/phpmd.xml');

        return $file;
    }

    public function getProjectHost()
    {
        if (isset($this->projectConfig) && $this->projectConfig instanceof Project) {
            $projectHost = $this->projectConfig->getHost();
        } else {
            $projectHost = $this->config['gear'***REMOVED***['project'***REMOVED***['host'***REMOVED***;
        }

        return $projectHost;
    }

    public function getProjectName()
    {
        if (isset($this->projectConfig) && $this->projectConfig instanceof Project) {
            $projectName = $this->projectConfig->getProject();
        } else {
            $projectName = $this->config['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;
        }

        return $projectName;
    }

    public function getProjectRealFolder()
    {
        if (isset($this->projectConfig) && $this->projectConfig instanceof Project) {
            $script = $this->projectConfig->getProjectLocation();
        } else {
            $script = $this->getProject();
        }

        return $script;
    }

    public function getProjectScript()
    {
        if (isset($this->projectConfig) && $this->projectConfig instanceof Project) {
            $script = $this->projectConfig->getProjectLocation().'/script';
        } else {
            $script = $this->getProject().'/script';
        }

        return $script;
    }
    
    public function getScriptInstallProduction()
    {
        $script = $this->getProjectScript();
        
        return $this->getFileCreator()->createFile(
            'template/project/script/install-remote-production.phtml',
            [***REMOVED***,
            'install-production.sh',
            $script
        );
    }
    
    public function getScriptInstallStaging()
    {
        $script = $this->getProjectScript();
        
        return $this->getFileCreator()->createFile(
            'template/project/script/install-remote-staging.phtml',
            [***REMOVED***,
            'install-staging.sh',
            $script
        );
    }

    public function getScriptDevelopment()
    {
        $script = $this->getProjectScript();
        $projectName = $this->getProjectName();
        $projectUrl = $this->str('url', $projectName);

        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-development.phtml',
            array(
                'project' => $projectName,
                'projectUrl' => $projectUrl,
            ),
            'deploy-development.sh',
            $script
        );
    }

    public function getScriptStaging()
    {
        $script = $this->getProjectScript();
        $projectName = $this->getProjectName();
        $projectUrl = $this->str('url', $projectName);



        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-staging.phtml',
            array(
                'project' => $projectName,
                'projectUrl' => $projectUrl,
            ),
            'deploy-staging.sh',
            $script
        );
    }


    public function getScriptLoad()
    {
        $script = $this->getProjectScript();

        return $this->getFileCreator()->createFile(
            'template/project/script/load.phtml',
            array(
            ),
            'load.sh',
            $script
        );
    }

    public function getScriptTesting()
    {
        $script = $this->getProjectScript();
        $projectName = $this->getProjectName();
        $projectUrl = $this->str('url', $projectName);



        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-testing.phtml',
            array(
                'project' => $projectName,
                'projectUrl' => $projectUrl,
            ),
            'deploy-testing.sh',
            $script
        );
    }

    public function getScriptProduction()
    {
        $script = $this->getProjectScript();
        $projectName = $this->getProjectName();
        $projectUrl = $this->str('url', $projectName);


        return $this->getFileCreator()->createFile(
            'template/project/script/deploy-production.phtml',
            array(
                'project' => $projectName,
                'projectUrl' => $projectUrl,
            ),
            'deploy-production.sh',
            $script
        );
    }

    public function createScriptDeploy()
    {
        $this->getScriptDevelopment();
        $this->getScriptStaging();
        $this->getScriptInstallStaging();
        $this->getScriptInstallProduction();
        $this->getScriptProduction();
        $this->getScriptTesting();
        $this->getScriptLoad();
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
        $this->getNpmUpgrade()->getConsolePrompt()->setForce(true);
        $this->getNpmUpgrade()->upgradeProject('web');
    }

    public function getKarmaConfig()
    {
        $file = $this->getFileCreator()->createFile(
            'template/project/test/karma.phtml',
            array(

            ),
            'karma.conf.js',
            $this->getProjectRealFolder()
        );

        $this->getFileService()->chmod(0777, $this->getProjectRealFolder().'/package.json');

        return $file;
    }

    public function getProtractorReportConfig()
    {
        $file = $this->getFileCreator()->createFile(
            'template/project/data/report.js.phtml',
            [***REMOVED***,
            'report.js',
            $this->getProjectRealFolder().'/data'
        );

        return $file;
    }


    public function getProtractorConfig()
    {
        $host = $this->getProjectHost();

        $file = $this->getFileCreator()->createFile(
            'template/project/test/end2end.phtml',
            array(
                'host' => $host
            ),
            'end2end.conf.js',
            $this->getProjectRealFolder()
        );

        return $file;
    }

    public function getPhpdoxConfig()
    {
        $file = $this->getFileCreator()->createFile(
            'template/project/test/phpdox.xml.phtml',
            array(
                'project' => $this->str('url', $this->getProjectName()),
            ),
            'phpdox.xml',
            $this->getProjectRealFolder()
        );

        $this->getFileService()->chmod(0777, $this->getProjectRealFolder().'/phpdox.xml');

        return $file;
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
        $this->getAntUpgrade()->getConsolePrompt()->setForce(true);
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
        $projectName = $this->getProjectName();

        $file = $this->getFileCreator()->createFile(
            'template/project/project.codeception.yml.phtml',
            array(
                'project' => $this->str('url', $projectName),
            ),
            'codeception.yml',
            $this->getProjectRealFolder()
        );

        $this->getFileService()->chmod(0777, $this->getProjectRealFolder().'/codeception.yml');

        return $file;
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


    public function getGlobalConfigFromFile($globalFile)
    {
        $version = $globalFile['gear'***REMOVED***['project'***REMOVED***['version'***REMOVED***;
        $git = $globalFile['gear'***REMOVED***['project'***REMOVED***['git'***REMOVED***;
        $label = $globalFile['gear'***REMOVED***['project'***REMOVED***['label'***REMOVED***;
        $aclKey = $globalFile['bjyauthorize'***REMOVED***['acl_key'***REMOVED***;
        $adminName = $globalFile['admin'***REMOVED***['name'***REMOVED***;
        $adminTitle = $globalFile['admin'***REMOVED***['title'***REMOVED***;
        $adminWelcome = $globalFile['admin'***REMOVED***['welcome'***REMOVED***;
        $name = $globalFile['gear'***REMOVED***['project'***REMOVED***['name'***REMOVED***;

        return [
            'version' => $version,
            'git' => $git,
            'label' => $label,
            'name' => $name,
            'adminTitle' => $adminTitle,
            'adminWelcome' => $adminWelcome,
            'adminName' => $adminName,
            'aclKey' => $aclKey
        ***REMOVED***;
    }

    public function getGlobalConfigFromStart()
    {

        if (!isset($this->projectConfig) || !($this->projectConfig instanceof Project)) {
            throw new ProjectNotConfigurableException();
        }

        $version = '0.1.0';

        $git = $this->projectConfig->getGit();


        $label = $this->str('label', $this->projectConfig->getProject());

        $name = $this->str('class', $this->projectConfig->getProject());

        $adminTitle = 'Admin '.$label;
        $adminWelcome = 'Bem vindo ao Admin '.$label;
        $adminName = $label;

        $aclKey = $this->str('uline', $name);

        return [
            'version' => $version,
            'git' => $git,
            'label' => $label,
            'name' => $name,
            'adminTitle' => $adminTitle,
            'adminWelcome' => $adminWelcome,
            'adminName' => $adminName,
            'aclKey' => $aclKey
        ***REMOVED***;
    }

    public function getGlobalConfig()
    {
        $global = $this->getProject().'/config/autoload/global.php';

        if (is_file($global)) {
            $globalFile = require $global;

            if (isset($globalFile['gear'***REMOVED***)) {
                $configRender = $this->getGlobalConfigFromFile($globalFile);
                return $configRender;
            }
        }

        $configRender = $this->getGlobalConfigFromStart();
        return $configRender;
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


        $configRender = $this->getGlobalConfig();


        $this->getFileCreator()->createFile(
            'template/project/config/autoload/global.phtml',
            array_merge(
                [
                    'dbname' => $dbname,
                    'host' => $host,
                    'environment' => $environment,
                ***REMOVED***,
                $configRender
            ),
            'global.php',
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
