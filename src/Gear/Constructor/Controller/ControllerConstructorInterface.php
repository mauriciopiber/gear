<?php
namespace Gear\Constructor\Controller;

use GearJson\Controller\Controller;

interface ControllerConstructorInterface
{
    public function build(Controller $controller);
}
