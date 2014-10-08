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
    public function create($name, $host)
    {
        $project = new \Gear\ValueObject\Project($name, $host);

        $script = realpath(__DIR__.'/../../../script/installer.sh');


        if (!is_file($script)) {
            throw new \Exception('Script of installation can\'t be found on Gear');
        }

        $cmd = sprintf('%s "%s" "%s" "%s"', $script, $project->getName(), $project->getHost(), $project->getFolder()."/");

        $scriptService = $this->getServiceLocator()->get('scriptService');
        return $scriptService->run($cmd);
    }


}
