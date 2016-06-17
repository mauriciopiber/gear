<?php
namespace Gear\Script;

use Gear\Service\AbstractJsonService;

/**
 *
 * @author Mauricio Piber mauriciopiber@gmail.com
 *         Classe responsável por rodar scripts
 */
class ScriptService extends AbstractJsonService
{
    protected $location;

    protected $current;

    public function setLocation($location)
    {
        if (is_dir($location)) {
            $this->location = $location;
        }
        return $this;
    }

    public function getLocation()
    {
        if (!isset($this->location)) {

            if (
                null !== $this->getModule()
                && $this->getModule()->getMainFolder() !== null
              && is_dir($this->getModule()->getMainFolder())
            ) {
                $this->location = $this->getModule()->getMainFolder();
            } else {
                $this->location = null;
            }
        }
        return $this->location;
    }

    public function run($cmd)
    {
        $this->setCurrent(getcwd());

        chdir($this->getLocation());

        $shell = shell_exec($cmd);

        chdir($this->getCurrent());

        return $shell;
    }

    public function getCurrent()
    {
        return $this->current;
    }

    public function setCurrent($current)
    {
        $this->current = $current;
        return $this;
    }
}
