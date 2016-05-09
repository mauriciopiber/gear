<?php
namespace Gear\Project\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Project\DeployServiceTrait;
use Gear\Project\ProjectServiceTrait;
use Gear\Mvc\Entity\EntityServiceTrait;
use Gear\Module\ComposerServiceTrait;
use Zend\View\Model\ConsoleModel;

class ProjectController extends AbstractConsoleController
{
    use ProjectServiceTrait;
    use EntityServiceTrait;
    use ComposerServiceTrait;
    use DeployServiceTrait;
    use \Gear\Mvc\Fixture\FixtureServiceTrait;
    use \Gear\Cache\CacheServiceTrait;
    use \Gear\Project\UpgradeTrait;
    use \Gear\Project\DiagnosticServiceTrait;

    public function dumpAutoloadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-upgrade'));

        $projectService = $this->getProjectService();
        $projectService->dumpAutoload();

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }
/*
    public function upgradeAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-upgrade'));

        $projectService = $this->getUpgrade();
        $projectService->upgrade();


        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function helperAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-helper'));

        $projectService = $this->getProjectService();

        $projectService->helper();


        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }
*/
    public function gitAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-git'));

        $projectService = $this->getProjectService();

        $projectService->git();


        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function virtualHostAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-virtual-host'));

        $projectService = $this->getProjectService();

        $projectService->virtualHost();


        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function nfsAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-nfs'));

        $projectService = $this->getProjectService();

        $projectService->nfs();


        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function diagnosticsAction()
    {

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-diagnostics'));

        $projectService = $this->getDiagnosticService();

        $projectService->diagnostics();


        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function renewCacheAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-cache'));

        $this->getCacheService()->renewCache();

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function fixtureAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-fixture'));

        $projectService = $this->getFixtureService();

        $projectService->importProject();


        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-create'));

        $projectService = $this->getProjectService();

        $projectService->create();

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }


    public function deleteAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-create'));

        $projectService = $this->getProjectService();

        $projectService->delete();

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function globalAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-global'));

        $environment = $this->getRequest()->getParam('environment');
        $dbms        = $this->getRequest()->getParam('dbms');
        $dbname      = $this->getRequest()->getParam('dbname');
        $host        = $this->getRequest()->getParam('host');

        $project = $this->getProjectService();
        $project->setUpGlobal(
            array(
                'environment' => $environment,
                'dbms' => $dbms ,
                'dbname' => $dbname,
                'host' => $host
            )
        );
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }


    public function localAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-local'));

        $project = $this->getProjectService();

        $username = $this->getRequest()->getParam('username');
        $password = $this->getRequest()->getParam('password');

        $project = $this->getProjectService();
        $project->setUpLocal(array('username' => $username, 'password' => $password));

        $this->getEventManager()->trigger('gear.pos', $this);
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
        $project->setUpConfig(
            array(
                'environment' => $environment,
                'dbms' => $dbms,
                'dbname' => $dbname,
                'host' => $host,
                'password' => $password,
                'username' => $username
            )
        );

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }
}
