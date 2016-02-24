<?php
namespace Gear\Constructor\App;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Constructor\App\AppServiceTrait;

class AppController extends AbstractConsoleController
{
    use AppServiceTrait;
}
