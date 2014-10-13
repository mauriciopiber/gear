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


}
