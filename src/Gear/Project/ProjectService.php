<?php
namespace Gear\Project;

use Gear\Service\AbstractService;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Yaml;
use Gear\Service\Module\ScriptService;
use Gear\Project\Project;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ProjectService extends AbstractService
{
    use \GearVersion\Service\VersionServiceTrait;
    use \Gear\Project\DeployServiceTrait;
    use \Gear\Project\BuildServiceTrait;
    //use \Gear\ContinuousIntegration\JenkinsTrait;

    /*
     * Função responsável por criar projetos do zero e inicia-los no servidor onde o Gear está instalado
     * Gerará projetos na pasta irmã ao projeto específico
     * @return string
     */
    public function create()
    {
        $request = $this->getRequest();

        $this->project = new \Gear\Project\Project(array(
            'project'  => $request->getParam('project', null),
            'host'     => $request->getParam('host', null),
            'git'      => $request->getParam('git', null),
            'database' => $request->getParam('database', null),
            'username' => $request->getParam('username', null),
            'password' => $request->getParam('password', null),
            'nfs'      => $request->getParam('nfs', null)
        ));

        $this->executeInstallation();
        $this->executeConfig();
        $this->executeGear();
        $this->createHelper();
        $this->createVirtualHost();
        $this->createNFS();
        $this->createBuild();
        $this->createJenkins();
        $this->createGit();

        return true;
    }

    public function projectJenkins()
    {
        $jenkins = $this->getJenkins();
        $job = new \Gear\ContinuousIntegration\Jenkins\Job();
        $jenkins->createJob($job);

    }

    public function helper()
    {

        $this->createHelper();
    }

    public function createHelper()
    {
        //gear_help.php
        copy(
            realpath(__DIR__.'/../../../script/gear_help.php'),
            \GearBase\Module::getProjectFolder().'/data/gear_help.php'
        );

        chmod(\GearBase\Module::getProjectFolder().'/data/gear_help.php', 775);

        $helper = file_get_contents(realpath(__DIR__.'/../../../script/gear_help.sh'));

        $helper = str_replace('/var/www/Gear', \GearBase\Module::getProjectFolder(), $helper);

        file_put_contents(\GearBase\Module::getProjectFolder().'/gear_help.sh', $helper);

        return true;
    }

    public function diagnosticFolder($baseDir)
    {
        if (!is_dir($baseDir)) {

            $this->message = sprintf(
                'Deves criar o diretório %s',
                $baseDir
            );
            $this->console->writeLine($this->message, 2);
        }

        if (!is_writable($baseDir)) {
            $this->message = sprintf(
                'Deves dar permissão de escrita no diretório %s',
                $baseDir
            );
            $this->console->writeLine($this->message, 2);
        }

        if (!is_file($baseDir.'/.gitignore')) {
            $this->message = sprintf(
                'Deve adicionar arquivo .gitignore para pasta %s',
                $baseDir
            );
            $this->console->writeLine($this->message, 2);
        }
    }

    public function diagnosticSuiteConfig($suiteLocation)
    {


        if (is_file($suiteLocation)) {

            $suiteLocationYaml = Yaml::parse($suiteLocation);

            if (isset($suiteLocationYaml['modules'***REMOVED***['config'***REMOVED***['WebDriver'***REMOVED***)) {
                $this->message = sprintf(
                    'Remover webdriver do teste de aceitação para'
                    . 'Módulo %s, só é permitido configuração global.',
                    $suiteLocation
                );
                $this->console->writeLine($this->message, 2);
            }

            if (isset($suiteLocationYaml['modules'***REMOVED***['config'***REMOVED***['Db'***REMOVED***)) {
                $this->message = sprintf(
                    'Remover db do teste de aceitação para Módulo %s,'
                    . 'só é permitido configuração global.',
                    $suiteLocation
                );
                $this->console->writeLine($this->message, 2);
                $this->console->writeLine($this->message, 2);
            }


            if ($suiteLocationYaml['class_name'***REMOVED*** == 'UnitTester') {

                if (isset($suiteLocationYaml['coverage'***REMOVED***) && $suiteLocationYaml['coverage'***REMOVED***['enabled'***REMOVED*** == false) {
                    $this->message = sprintf(
                        'Habilitar code-coverage para testes unitários',
                        $suiteLocation
                    );
                    $this->console->writeLine($this->message, 2);
                    $this->console->writeLine($this->message, 2);
                }
            }


            if ($suiteLocationYaml['class_name'***REMOVED*** != 'UnitTester') {

                if (isset($suiteLocationYaml['coverage'***REMOVED***) && $suiteLocationYaml['coverage'***REMOVED***['enabled'***REMOVED*** == true) {
                    $this->message = sprintf(
                        'Desabilitar code-coverage para testes unitários',
                        $suiteLocation
                    );
                    $this->console->writeLine($this->message, 2);
                    $this->console->writeLine($this->message, 2);
                }
            }
        }
    }


    public function diagnosticCodeception()
    {
        $projectCodeception = \GearBase\Module::getProjectFolder().'/codeception.yml';
        $projectCodeceptionDecoded = Yaml::parse($projectCodeception);

        if (empty($projectCodeceptionDecoded['include'***REMOVED***)) {
            return false;
        }

        $modules = $projectCodeceptionDecoded['include'***REMOVED***;

        foreach ($modules as $module) {

            $moduleYaml = \GearBase\Module::getProjectFolder().'/'.$module.'/codeception.yml';

            if (!is_file($moduleYaml)) {
                $this->message = sprintf(
                    'Módulo %s adicionado ao projeto mas não possui arquivo codeception.yml',
                    $module
                );
                $this->console->writeLine($this->message, 2);
            }


            $moduleDecoded = Yaml::parse($moduleYaml);

            //Todos módulos tem que ter apenas o arquivo principal de configuração para WebDriver e DB.

            if (!isset($moduleDecoded['modules'***REMOVED***['config'***REMOVED***['WebDriver'***REMOVED***)) {
                $this->message = sprintf(
                    'Módulo %s não possui configuração WebDriver no arquivo codeception.yml',
                    $module
                );
                $this->console->writeLine($this->message, 2);
            }

            if (!isset($moduleDecoded['modules'***REMOVED***['config'***REMOVED***['Db'***REMOVED***)) {
                $this->message = sprintf(
                    'Módulo %s não possui configuração Db no arquivo codeception.yml',
                    $module
                );
                $this->console->writeLine($this->message, 2);
            }

            $acceptance = \GearBase\Module::getProjectFolder().'/'.$module.'/test/acceptance.suite.yml';

            $this->diagnosticSuiteConfig($acceptance);

            $functional = \GearBase\Module::getProjectFolder().'/'.$module.'/test/functional.suite.yml';

            $this->diagnosticSuiteConfig($functional);

            $unit = \GearBase\Module::getProjectFolder().'/'.$module.'/test/unit.suite.yml';

            $this->diagnosticSuiteConfig($unit);
            //Para cada módulo, deve ter 1 configuração de
            //WebDriver e 1 configuração de DB Logo no arquivo principal.
        }
    }

    public function diagnostics()
    {

        $this->baseDir = \GearBase\Module::getProjectFolder();

        $this->console = $this->getServiceLocator()->get('console');

        $this->diagnosticFolder($this->baseDir.'/data/logs');
        $this->diagnosticFolder($this->baseDir.'/data/DoctrineORMModule/Proxy');
        $this->diagnosticFolder($this->baseDir.'/data/DoctrineModule/cache');
        $this->diagnosticFolder($this->baseDir.'/data/cache/configcache');
        $this->diagnosticFolder($this->baseDir.'/data/session');

        //$this->diagnosticCodeception();

        if (empty($this->message)) {
            $this->message = 'Diagnóstico Ok, sistema pronto para produção.';
            $this->console->writeLine($this->message, 3);
        } else {
            $this->message = 'Corrija os erros antes de continuar';
            $this->console->writeLine($this->message, 2);
        }
        //se está ok exibe mensagem verde.
        //se está errado exibe mensagem vermelha.
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

    public function getScriptService()
    {
        if (!isset($this->scriptService)) {
            $this->scriptService = $this->getServiceLocator()->get('scriptService');
            $this->scriptService->setLocation(\GearBase\Module::getProjectFolder());
        }
        return $this->scriptService;
    }

    public function build()
    {
        return $this->getBuildService()->buildProject();
    }

    public function executeGear()
    {
        $script  = realpath(__DIR__.'/../../../script/utils');
        $install = realpath($script.'/installer/run-gear.sh');
        $cmd = sprintf('%s %s', $install, $this->project->getProjectLocation());
        $scriptService = $this->getScriptService();
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

        $script  = realpath(__DIR__.'/../../../bin/git.sh');

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
        $this->createBuildSh();
        $this->createCodeceptionYml();
    }

    public function copyPHPMD()
    {
        if (!is_dir($this->project->getProjectLocation().'/config/jenkins/')) {
            mkdir($this->project->getProjectLocation().'/config/jenkins/', 0777);
        }

        $this->createFileFromTemplate(
            'template/shared/jenkins/phpmd.xml.phtml',
            array(
                'moduleName' => $this->str('label', $this->project->getProject()),
            ),
            'phpmd.xml',
            $this->project->getProjectLocation().'/config/jenkins/'
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/config/jenkins/phpmd.xml');
    }

    public function createPHPDox()
    {
        $this->createFileFromTemplate(
            'template/project.phpdox.xml.phtml',
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
        $this->createFileFromTemplate(
            'template/project.build.xml.phtml',
            array(
                'project' => $this->str('url', $this->project->getProject()),
            ),
            'build.xml',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/build.xml');
    }

    public function createBuildSh()
    {

        $buildService = $this->getServiceLocator()->get('buildService');

        $share = $buildService->getShared();

        copy($share.'/build.sh', $this->project->getProjectLocation().'/build.sh');
        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/build.sh');

    }

    public function createCodeceptionYml()
    {
        $this->createFileFromTemplate(
            'template/project.codeception.yml.phtml',
            array(
                'project' => $this->str('url', $this->project->getProject()),
            ),
            'codeception.yml',
            $this->project->getProjectLocation()
        );

        $this->getFileService()->chmod(0777, $this->project->getProjectLocation().'/codeception.yml');
    }

    public function delete($data)
    {
        $project = new \Gear\Project\Project($data);


        $script = realpath(__DIR__.'/../../../script');
        $remove = realpath($script.'/remover.sh');

        if (!is_file($remove)) {
            throw new \Exception('Script of remove can\'t be found on Gear');
        }

        $projectName   = $project->getName();
        $projectFolder = $project->getFolder();

        $cmd = sprintf('%s "%s" "%s"', $remove, $projectFolder, $projectName);

        //echo $cmd;die();
        $scriptService = $this->getScriptService();
        return $scriptService->run($cmd);
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
        return \GearBase\Module::getProjectFolder();
    }

    /**
     * Modificar o export e o .htaccess do sistema para rodar no staging correto.
     */

    public function setUpEnvironment($data)
    {
        $globaly = new \Gear\Project\Config\Globaly($data);
        $script = realpath(__DIR__.'/../../../script');
        $htaccess = realpath($script.'/installer/htaccess.sh');

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
        $local = new \Gear\Project\Config\Local($data);

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
}
