<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Upgrade\ComposerUpgradeTrait;
use Gear\Upgrade\NpmUpgradeTrait;
use Gear\Upgrade\DirUpgradeTrait;
use Gear\Upgrade\FileUpgradeTrait;
use Gear\Upgrade\AntUpgradeTrait;

abstract class AbstractUpgrade extends AbstractJsonService
{
    use ComposerUpgradeTrait;

    use NpmUpgradeTrait;

    use DirUpgradeTrait;

    use FileUpgradeTrait;

    use AntUpgradeTrait;

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
    public function printUpgrades()
    {
        $count = count($this->errors);

        $errors = ($count==1) ? 'Realizado %s upgrade.' : 'Realizados %s upgrades.';

        $this->showError(sprintf($errors, count($this->errors)));

        foreach ($this->errors as $i => $item) {
            $this->showError(($i+1).'° '.$item);
        }
    }

    public function show()
    {
        if (count($this->errors)) {
            $this->printUpgrades();
            return;
        }

        $this->console->writeLine('O sistema está atualizado.', 0, 3);
        return;
    }
    //abstract public function upgradeModule();

    //abstract public function upgradeProject();
}
