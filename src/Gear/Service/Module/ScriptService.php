<?php
namespace Gear\Service\Module;

use Gear\Service\AbstractService;

/**
 *
 * @author Mauricio Piber mauriciopiber@gmail.com
 *         Classe responsável por rodar scripts
 */
class ScriptService extends AbstractService
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
        if (! isset($this->location)) {
            $this->location = $this->getConfig()->getModuleFolder();
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
