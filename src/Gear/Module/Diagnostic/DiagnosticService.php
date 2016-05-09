<?php
namespace Gear\Module\Diagnostic;

use Gear\Service\AbstractJsonService;

/**
 * Classe responsável por fazer o diagnóstico dos módulos para ter certeza que possui todos componentes
 * necessários para utilização do Gear, Jenkins.
 */
class DiagnosticService extends AbstractJsonService
{
    use \Gear\Diagnostic\AntServiceTrait;

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


    public function diagnostic()
    {
        $module = $this->module->getModule();

        $this->errors = [***REMOVED***;

        $this->errors = array_merge($this->errors, $this->getAntService()->diagnosticModule());

        if (count($this->errors)) {

            $count = count($this->errors);

            $errors = ($count==1) ? 'Foi encontrado %s erro, corrijá-o.' : 'Foram encontrados %d erros, corrijá-os';

            $this->showError(sprintf($errors, count($this->errors)));

            foreach ($this->errors as $i =>  $item) {
                $this->showError(($i+1).'° '.$item);
            }



            return;
        }


        $this->console->writeLine('O Módulo está pronto para o trabalho.', 0, 3);
        return;
    }
}
