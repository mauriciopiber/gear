<?php
namespace Gear\Project\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Gear\Project\ProjectServiceTrait;
use Gear\Mvc\Entity\EntityServiceTrait;
use Gear\Module\ComposerServiceTrait;
use Zend\View\Model\ConsoleModel;
use Gear\Mvc\Fixture\FixtureServiceTrait;
use Gear\Cache\CacheServiceTrait;
use Gear\Project\Upgrade\ProjectUpgradeTrait;
use Gear\Project\Diagnostic\DiagnosticServiceTrait;

class ProjectController extends AbstractConsoleController
{
    //use ProjectServiceTrait;
    //use EntityServiceTrait;
    //use ComposerServiceTrait;
    use FixtureServiceTrait;
    use CacheServiceTrait;
    //use ProjectUpgradeTrait;
    //use DiagnosticServiceTrait;

    /*
    public function diagnosticsAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-diagnostics'));

        $projectService = $this->getDiagnosticService();

        $type = $this->getRequest()->getParam('type', 'web');

        if ($type == false) {
            $type = 'web';
        }

        $just = $this->getRequest()->getParam('just', null);

        $this->getDiagnosticService()->diagnostic($type, $just);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function upgradeAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-upgrade'));

        $type = $this->getRequest()->getParam('type', 'web');

        $force = $this->getRequest()->getParam('force', false);

        $just = $this->getRequest()->getParam('just', null);

        $projectService = $this->getProjectUpgrade();
        $projectService->upgrade($type, $just, $force);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

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

*/

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

    /**

    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-create'));

        $type = $this->getRequest()->getParam('type', 'web');

        $staging = $this->getRequest()->getParam('staging', null);
        $production = $this->getRequest()->getParam('production', null);

        $projectService = $this->getProjectService();
        $projectService->create($type, $staging, $production);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }
    public function deleteAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-delete'));

        $projectService = $this->getProjectService();

        $projectService->delete();

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function globalAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-global'));

        $environment = $this->getRequest()->getParam('environment');
        //$dbms        = $this->getRequest()->getParam('dbms');
        $dbname      = $this->getRequest()->getParam('dbname');
        $host        = $this->getRequest()->getParam('host');

        $project = $this->getProjectService();
        $project->setUpGlobal($dbname, $host, $environment);
        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }


    public function environmentAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-environment'));

        $project = $this->getProjectService();

        $env = $this->getRequest()->getParam('env');

        $project = $this->getProjectService();
        $project->setUpEnvironment($env);

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
        $project->setUpLocal($username, $password);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }


    public function configAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'project-config'));

        $request    = $this->getRequest();

        $environment = $request->getParam('environment');
        $username    = $request->getParam('username');
        $password    = $request->getParam('password');
        $host        = $request->getParam('host');
        $dbname      =  $request->getParam('dbname');
        //$dbms        = $request->getParam('dbms');

        $project = $this->getProjectService();
        $project->setUpConfig($dbname, $username, $password, $host, $environment);

        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }
    */
}
