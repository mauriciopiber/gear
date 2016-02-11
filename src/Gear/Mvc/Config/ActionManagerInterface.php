<?php
namespace Gear\Mvc\Config;

use GearJson\Action\Action;

interface ActionManagerInterface
{
    public function create(Action $action);

    public function delete(Action $action);

    public function get(Action $action);
}
