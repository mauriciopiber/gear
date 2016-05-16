<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

abstract class AbstractDiagnostic extends AbstractJsonService
{
    /**
     * @var array $errors Erros encontrados
     */
    public $errors = [***REMOVED***;

    use \Gear\Diagnostic\AntServiceTrait;

    use \Gear\Diagnostic\DirServiceTrait;

    use \Gear\Diagnostic\FileServiceTrait;

    use \Gear\Diagnostic\NpmServiceTrait;

    use \Gear\Diagnostic\ComposerServiceTrait;
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

    /**
     * Responsável por exibir todas mensagens após a conclusão do teste.
     */
    public function printErrors()
    {
        $count = count($this->errors);

        $errors = ($count==1) ? 'Foi encontrado %s erro, corrijá-o.' : 'Foram encontrados %d erros, corrijá-os';

        $this->showError(sprintf($errors, count($this->errors)));

        foreach ($this->errors as $i =>  $item) {
            $this->showError(($i+1).'° '.$item);
        }
    }

    public function show()
    {
        if (count($this->errors)) {
            $this->printErrors();
            return;
        }

        $this->console->writeLine('O Módulo está pronto para o trabalho.', 0, 3);
        return;
    }
}