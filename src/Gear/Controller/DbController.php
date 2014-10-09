<?php
namespace Gear\Controller;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Gear\Model\Schema;

class DbController extends AbstractActionController
{

    public function addAction()
    {

        $request = $this->getRequest();

        if (!$request instanceof  \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $project    = $request->getParam('project', false);
        $module     = $request->getParam('module',false);
        $controller = $request->getParam('controllerTo',false);
        $action     = $request->getParam('actionTo',false);
        $role       = $request->getParam('role',false);

        $database = $this->getServiceLocator()->get('database_gear');
        $database->addRule($project,$module,$controller,$action,$role);

    }

    public function checkDbAction()
    {
        $request = $this->getRequest();
        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $database = $this->getServiceLocator()->get('database_gear');

        $prefix  = $request->getParam('table_prefix',false);
        $exclude  = $request->getParam('table_exclude',false);

        if (strpos($prefix,',') !== false) {
            foreach (explode(',',$prefix) as $i => $v) {
                $database->checkNormalization($v,$exclude);
            }
        } else {

            $database->checkNormalization($prefix,$exclude);
        }

    }

    public function dropi18nAction()
    {

        $request = $this->getRequest();
        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }
        $database = $this->getServiceLocator()->get('database_gear');

        $prefix  = $request->getParam('i18n_prefix','i18n');

        $database->dropi18n($prefix);
    }

    public function upi18nAction()
    {

        $request = $this->getRequest();
        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request) {
            throw new \RuntimeException('You can only use this action from a console!');
        }
    }

}
