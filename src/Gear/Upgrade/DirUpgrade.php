<?php
namespace Gear\Upgrade;

use Gear\Service\AbstractJsonService;
use Gear\Edge\DirEdgeTrait;
use Gear\Util\Console\ConsoleAwareTrait;
use Zend\Console\Adapter\Posix;
use Zend\Console\Prompt;

class DirUpgrade extends AbstractJsonService
{
    use ConsoleAwareTrait;
    use DirEdgeTrait;

    public function __construct(Posix $console, $dirService, $module = null)
    {
        $this->console = $console;
        $this->dirService = $dirService;
        $this->module = $module;
    }

    public function upgradeModule($type = 'web')
    {
        $mainFolder = $this->getModule()->getMainFolder();


        $edge = $this->getDirEdge()->getDirModule($type);

        //$confirm = new Prompt\Confirm('Are you sure you want to continue?');
        //$result = $confirm->show();

        //if ($result == 'Y') {
        //    var_dump($mainFolder);
        //    var_dump($edge);
        //}


        return [***REMOVED***;
    }

    public function upgradeProject($type = 'web')
    {
        return [***REMOVED***;
    }
}
