<?php
namespace Gear\Service;

use Gear\Service\AbstractService;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 * Bem como a classe Module.php e suas dependências
 */
class ProjectService extends AbstractService
{
    /**
     * Função responsável por criar projetos do zero e inicia-los no servidor onde o Gear está instalado
     * Gerará projetos na pasta irmã ao projeto específico
     * @return string
     */
    public function create($name, $host, $git)
    {
        $project = new \Gear\ValueObject\Project($name, $host, $git);


        $script  = realpath(__DIR__.'/../../../script');
        $install = realpath($script.'/installer.sh');
        $projectName   = $project->getName();
        $projectHost   = $project->getHost();
        $projectGit    = $project->getGit();
        $projectFolder = $project->getFolder();

        if (!is_file($install)) {
            throw new \Exception('Script of installation can\'t be found on Gear');
        }

        /**
            1 - script base
            2 - dir dos scrips
            3 - dir base do projeto
            4 - nome do projeto
            5 - dir do projeto
            6 - host do projeto
            7 - git do projeto
         */
        $cmd = sprintf('%s "%s" "%s" "%s" "%s" "%s" "%s"', $install, $script, $projectFolder, $projectName,  $projectFolder.'/'.$projectName, $projectHost, $projectGit);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        return $scriptService->run($cmd);
    }

    public function delete($name)
    {
        $project = new \Gear\ValueObject\Project($name);


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

    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get('configService');
        }
        return $this->configService;
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
    public function setUpGlobal($dbms, $dbname, $environment)
    {

        $this->createFileFromTemplate(
            sprintf('config/db.%s.autoload.config', $dbms),
            array(
                'module' => $this->getConfig()->getModule(),
                'dbname' => $dbname
            ),
            sprintf('db.%s.config.php', $environment),
            $this->getConfig()->getLocal().'/config/autoload/'
        );

        $this->createFileFromTemplate(
            sprintf('config/doctrine.%s.autoload.config', $dbms),
            array(
                'module' => $this->getConfig()->getModule(),
                'dbname' => $dbname
            ),
            sprintf('db.%s.config.php', $environment),
            $this->getConfig()->getLocal().'/config/autoload/'
        );

        //generate a new global.php

        return $this->createFileFromTemplate(
            'autoload/global',
            array(),
            'global.php',
            $this->getConfig()->getLocal().'/config/autoload'
        );



    }

    /**
     * Modificar o usuário e senha das conexões doctrine e db.
     */
    public function setUpLocal($username, $password)
    {
        return $this->createFileFromTemplate(
            'autoload/local',
            array(
        	    'username' => $username,
                'password' => $password
            ),
            'local.php',
            $this->getConfig()->getLocal().'/config/autoload'
        );
    }

    /**
     * Modificar o export e o .htaccess do sistema para rodar no staging correto.
     */

    public function setUpEnvironment()
    {
        $script = realpath(__DIR__.'/../../../script');
        $htaccess = realpath($script.'/installer/htaccess.sh');

        $folder = \Gear\ValueObject\Project::getStaticFolder();

    }

    /**
     * Modificar os dados do banco de dados para ter acesso as páginas de acordo com os módulos ativos
     */
    public function setUpImport()
    {

    }


}
