<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Common\ProjectServiceTrait;
use Gear\Common\AclServiceTrait;
use Gear\Common\EntityServiceTrait;
use Gear\Common\ComposerServiceTrait;
use Gear\Common\DeployServiceTrait;
use Zend\View\Model\ConsoleModel;

class ProjectController extends AbstractConsoleController
{
    use ProjectServiceTrait;
    use AclServiceTrait;
    use EntityServiceTrait;
    use ComposerServiceTrait;
    use DeployServiceTrait;

    public function projectAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-create'));

        $projectService = $this->getProjectService();

        $projectService->create();

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function mysql2sqliteAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $request = $this->getRequest();
        $deployService = $this->getDeployService();

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'mysql2sqlite', 'params' => array('from', 'target')));

        $deployService->mysql2sqlite();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function deployAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $deployService = $this->getDeployService();

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-deploy', 'params' => array('environment')));

        $deployService->deploy();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }




    public function globalAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $environment = $this->getRequest()->getParam('environment');
        $dbms        = $this->getRequest()->getParam('dbms');
        $dbname      = $this->getRequest()->getParam('dbname');
        $host        = $this->getRequest()->getParam('host');

        $project = $this->getProjectService();

        $this->gear()->loopActivity($project, array('environment' => $environment, 'dbms' => $dbms , 'dbname' => $dbname, 'host' => $host), 'GlobalConfig');
        return new ConsoleModel();
    }


    public function localAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $project = $this->getProjectService();

        $username = $this->getRequest()->getParam('username');
        $password = $this->getRequest()->getParam('password');

        $project = $this->getProjectService();

        $this->gear()->loopActivity($project, array('username' => $username, 'password' => $password), 'LocalConfig');
        return new ConsoleModel();
    }

    public function environmentAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $project = $this->getProjectService();

        $environment = $this->getRequest()->getParam('environment');

        $project = $this->getProjectService();

        $this->gear()->loopActivity($project, array('environment' => $environment), 'EnvironmentConfig');
        return new ConsoleModel();
    }

    public function aclAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $withReset = (bool) $this->getRequest()->getParam('withReset');
        $user = (bool) $this->getRequest()->getParam('user');
        $role = (bool) $this->getRequest()->getParam('role');

        $acl     = $this->getAclService();

        $this->gear()->loopActivity($acl, array('reset' => $withReset, 'user' => $user, 'role' => $role), 'Acl create data on kernel');
        return new ConsoleModel();
    }


    public function resetAclAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);



        $acl     = $this->getAclService();

        $this->gear()->loopActivity($acl, array(), 'Acl Drop data on kernel');
        return new ConsoleModel();
    }


    public function configAction()
    {
        $request    = $this->getRequest();


        $environment = $request->getParam('environment');
        $username    = $request->getParam('username');
        $password    = $request->getParam('password');
        $host        = $request->getParam('host');
        $dbname      =  $request->getParam('dbname');
        $dbms        = $request->getParam('dbms');

        /* @var $project \Gear\Service\ProjectService */
        $project = $this->getProjectService();

        $this->gear()->loopActivity($project,
            array(
                'environment' => $environment,
                'dbms' => $dbms,
                'dbname' => $dbname,
                'host' => $host,
                'password' => $password,
                'username' => $username
            ),

            'Config'
        );
        return new ConsoleModel();
    }



    public function sqliteAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $request = $this->getRequest();

/*         $fromMysql  = $request->getParam('from-mysql');
        $fromSchema = $request->getParam('from-schema') */;

        $dbname     = $request->getParam('dbname');
        $dump       = $request->getParam('dump');
        $username   = $request->getParam('username', null);
        $password   = $request->getParam('password', null);

        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getProjectService();

        $this->gear()->loopActivity($projectService, array('dbname' => $dbname, 'username' => $username, 'password' => $password, 'dump' => $dump), 'SQLITE');

        return new ConsoleModel();
    }

    public function mysqlAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $request = $this->getRequest();
        //$fromSchema = $request->getParam('from-schema');

        $dbname   = $request->getParam('dbname', null);
        $username   = $request->getParam('username', null);
        $password   = $request->getParam('password', null);

        /* @var $projectService \Gear\Service\ProjectService */
        $projectService = $this->getProjectService();
        $this->gear()->loopActivity($projectService, array('dbname' => $dbname, 'username' => $username, 'password' => $password), 'MYSQL');
        return new ConsoleModel();
    }


    public function composerAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $this->getEventManager()->trigger('module.pre', $this);

        $request    = $this->getRequest();
        /* @var $module \Gear\Service\Module\ModuleService */
        $composer = $this->getComposerService();

        $this->gear()->loopActivity($composer, array(), 'Composer', null);
        return new ConsoleModel();

    }


}
