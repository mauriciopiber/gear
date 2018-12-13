<?php
namespace Gear\Constructor\Controller;

use Gear\Schema\Controller\Controller;

interface ControllerConstructorInterface
{
    public function buildController(Controller $controller);

    public function buildAction(Controller $controller);
}
