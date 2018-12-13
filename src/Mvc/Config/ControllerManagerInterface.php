<?php
namespace Gear\Mvc\Config;

use Gear\Schema\Controller\Controller;

interface ControllerManagerInterface
{
    public function create(Controller $controller);

    public function delete(Controller $controller);

    public function get(Controller $controller);
}
