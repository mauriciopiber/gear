<?php
namespace Gear\Upgrade;

use Zend\Console\Adapter\Posix;
use Gear\Upgrade\{
    AntUpgrade,
    AntUpgradeTrait
};
use Gear\Upgrade\{
    ComposerUpgrade,
    ComposerUpgradeTrait
};
use Gear\Upgrade\{
    FileUpgrade,
    FileUpgradeTrait
};
use Gear\Upgrade\{
    DirUpgrade,
    DirUpgradeTrait
};
use Gear\Upgrade\{
    NpmUpgrade,
    NpmUpgradeTrait
};


abstract class AbstractUpgrade
{
    const NO_FOUND = 'Não encontrado %s';

    use ComposerUpgradeTrait;

    use NpmUpgradeTrait;

    use DirUpgradeTrait;

    use FileUpgradeTrait;

    use AntUpgradeTrait;

    protected $console;

    protected $upgrades = [***REMOVED***;

    public function setUpgrades(array $upgrades)
    {
        $this->upgrades = $upgrades;
        return $this;
    }

    public function getUpgrades()
    {
        return $this->upgrades;
    }

    public function __construct(
        Posix $console,
        AntUpgrade $antUpgrade,
        ComposerUpgrade $composerUpgrade,
        FileUpgrade $fileUpgrade,
        DirUpgrade $dirUpgrade,
        NpmUpgrade $npmUpgrade
    ) {
        $this->console = $console;
        $this->antUpgrade = $antUpgrade;
        $this->composerUpgrade = $composerUpgrade;
        $this->fileUpgrade = $fileUpgrade;
        $this->dirUpgrade = $dirUpgrade;
        $this->npmUpgrade = $npmUpgrade;
    }

    public function getConsole()
    {
        return $this->console;
    }

    public function setConsole(Posix $console)
    {
        $this->console = $console;
        return $this;
    }


    public function checkJust($just)
    {
        if (!empty($just) && !in_array($just, ['composer', 'ant', 'npm', 'file', 'dir'***REMOVED***)) {
            $this->errors[***REMOVED*** = sprintf(self::NO_FOUND, $just);
            $this->showUpgrades();
            return false;
        }

        return true;
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

    /**
     * Responsável por exibir todas mensagens após a conclusão do teste.
     */
    public function showUpgrades()
    {
        if (count($this->upgrades) == 0) {
            $this->console->writeLine('O sistema está atualizado.', 0, 3);
            return;
        }

        $count = count($this->upgrades);

        $errors = ($count==1) ? 'Realizado %s upgrade.' : 'Realizados %s upgrades.';

        $this->showCheck(sprintf($errors, count($this->upgrades)));

        foreach ($this->upgrades as $item) {
            $this->showCheck($item);
        }

        $this->console->writeLine('O sistema está atualizado.', 0, 3);
    }

    //abstract public function upgradeModule();

    //abstract public function upgradeProject();
}
