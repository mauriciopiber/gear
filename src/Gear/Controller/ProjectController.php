<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Common\ProjectServiceTrait;
use Gear\Common\AclServiceTrait;
use Gear\Common\EntityServiceTrait;
use Zend\View\Model\ConsoleModel;

class ProjectController extends AbstractConsoleController
{
    use ProjectServiceTrait;
    use AclServiceTrait;
    use EntityServiceTrait;

    public function projectAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $request = $this->getRequest();

        $project = $request->getParam('project', null);
        $host    = $request->getParam('host', null);
        $git     = $request->getParam('git', null);

        $projectService = $this->getProjectService();

        $this->gear()->loopActivity(
            $projectService,
            array(
                'project' => $project,
                'host' => $host,
                'git' => $git
            ),
            'Project'
        );

        return new ConsoleModel();
    }


    public function dumpAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);

        $json = $this->getRequest()->getParam('json');
        $array = $this->getRequest()->getParam('array');

        if ($json === false && $array === false) {
            return 'Type not specified';
        }

        $module = $this->getProjectService();

        if ($json) {
            return $module->dump('json')."\n";
        }

        if ($array) {
            return $module->dump('array')."\n";
        }

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

        $acl     = $this->getAclService();

        $this->gear()->loopActivity($acl, array(), 'Acl create data on kernel');
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

    public function entityAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $request = $this->getRequest();

        $prefix  = $request->getParam('prefix', false);
        $tables  = $request->getParam('entity', array());
        $entityService = $this->getEntityService();
        $this->gear()->loopActivity($entityService, array('prefix' => $prefix, $tables => $tables), 'ENTITY');
        return new ConsoleModel();
    }

    public function entitiesAction()
    {
        $this->getEventManager()->trigger('console.pre', $this);
        $request = $this->getRequest();

        $prefix  = $request->getParam('prefix', false);
        $entityService = $this->getEntityService();
        $this->gear()->loopActivity($entityService, array('prefix' => $prefix), 'ENTITIES');
        return new ConsoleModel();
    }

}
