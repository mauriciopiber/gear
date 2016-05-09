<?php
namespace Gear\Module\Diagnostic;

use Gear\Service\AbstractJsonService;

/**
 * Classe responsável por fazer o diagnóstico dos módulos para ter certeza que possui todos componentes
 * necessários para utilização do Gear, Jenkins.
 */
class DiagnosticService extends AbstractJsonService
{
    /**
     * @var array $errors Erros encontrados
     */
    public $errors = [***REMOVED***;

    /**
     * Construtor do diagnóstico
     *
     * @param Zend\Console $console
     * @param Gear\Module\BasicModuleStructure $module
     */
    public function __construct($console, $module)
    {
        $this->console = $console;
        $this->module = $module;
    }

    /**
     * Responsável por mostrar as mensagens de erro conforme vão aparecendo.
     *
     * @param string $message Mensagem do Erro.
     * @return void
     */

    public function showError($message)
    {
        $this->errors[***REMOVED*** = $message;
        $this->console->writeLine($message, 0, 2);
    }

    /**
     * Responsável por mostrar as mensagens de sucesso conforme vão aparecendo
     *
     * @param string $message Mensagem de sucesso.
     * @return void
     */
    public function showCheck($message)
    {
        $this->console->writeLine($message, 0, 3);
    }

    /**
     * Verifica se existe o arquivo build.xml no módulo citado.
     * @return bool
     */
    public function moduleHasBuildFile()
    {
        $build = $this->module->getMainFolder().'/build.xml';

        if (!is_file($build)) {
            $this->showError(sprintf('Está faltando o arquivo %s', $build));
            return false;
        }

        $this->showCheck(sprintf('Verificação %s ok', $build));
        return true;
    }

    public function diagnostic()
    {
        $module = $this->module->getModule();

        $this->moduleHasBuildFile();

        if (count($this->errors)) {

            $count = count($this->errors);

            $errors = ($count==1) ? 'Foi encontrado %s erro, corrijá-o.' : 'Foram encontrados %d erros, corrijá-os';

            $this->showError(sprintf($errors, count($this->errors)));
            return;
        }


        $this->console->writeLine('O Módulo está pronto para o trabalho.', 0, 3);
        return;
    }
}
