<?php
namespace Gear\Service\Module;

use Gear\Service\AbstractService;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar scripts
 */
class ScriptService extends AbstractService
{
    public function run($cmd)
    {
        $dirCurrenct = getcwd();
        chdir($this->getConfig()->getModuleFolder());

        $shell  = "Ready to run build\n";

        $shell .= shell_exec($cmd);

        chdir($dirCurrenct);

        return $shell;
    }
}
