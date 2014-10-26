<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;

class BuildController extends AbstractConsoleController
{
    use \Gear\Common\BuildTrait;

    public function buildAction()
    {
        $this->gear()->loopActivity($this->getBuildService(), array(), 'Build');
    }
}
