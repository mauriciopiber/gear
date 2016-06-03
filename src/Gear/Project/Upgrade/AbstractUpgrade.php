<?php
namespace Gear\Project\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Upgrade\ComposerUpgradeTrait;
use Gear\Upgrade\NpmUpgradeTrait;

abstract class AbstractUpgrade extends AbstractJsonService
{
    use ComposerUpgradeTrait;

    use NpmUpgradeTrait;

    protected $console;
    protected $request;

//    public function __construct($serviceLocator)
//    {
//        $this->request         = $serviceLocator->get('application')->getMvcEvent()->getRequest();
//        $this->console         = $serviceLocator->get('console');
//        unset($serviceLocator);
//    }

    public function showCompare()
    {
        $this->console->writeLine('', 8, 1);
        $this->console->writeLine('Arquivo antigo:', 8, 1);
        $this->console->writeLine('', 8, 1);
        $this->console->write($this->realFile, 7, 1);
        $this->console->writeLine('', 8, 1);
        $this->console->writeLine('Arquivo novo:', 8, 1);
        $this->console->writeLine('', 8, 1);
        $this->console->write($this->template, 7, 1);
    }

    public function getRealFile()
    {
        if (!is_file($this->realFilePath)) {
            return false;
        }
        return file_get_contents($this->realFilePath);
    }
}
