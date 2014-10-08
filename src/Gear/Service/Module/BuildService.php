<?php
namespace Gear\Service\Module;

use Gear\Service\AbstractService;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class BuildService extends AbstractService
{
    public function getBuildFileFromModule()
    {

    }

    public function getBuildScriptFromModule()
    {

    }


    /**
     * Executa build completa a cada execução
     * @param string $build
     * @return string
     */
    public function build($build = 'dev')
    {
        $buildFile = $this->getConfig()->getModuleFolder().'/build.xml';

        if (!is_file($buildFile)) {
            return sprintf('Build.xml file in module %s is missing', $this->getConfig()->getModule());
        }

        $scriptFile = $this->getConfig()->getModuleFolder().'/build.sh';

        if (!is_file($scriptFile)) {
            return sprintf('Build.sh file in module %s is missing', $this->getConfig()->getModule());
        }

        $cmd = sprintf('%s %s', $scriptFile, $build);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $shell = $scriptService->run($cmd);
        return $shell;
    }
}
