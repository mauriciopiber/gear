<?php
namespace Gear\Diagnostic;

use Gear\Service\AbstractJsonService;

abstract class AbstractDiagnostic extends AbstractJsonService
{
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
}