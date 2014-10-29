<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;

class BuildController extends AbstractConsoleController
{
    use \Gear\Common\BuildTrait;

    public function buildAction()
    {
        $request = $this->getRequest();

        $this->gear()->loopActivity(
            $this->getBuildService(),
            array('build' => $request->getParam('trigger', 'dev')),
            'Build'
        );
    }
}
