<?php
namespace Gear\Module\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;

/**
 * Funções para manipulação de Módulos
 */
class ModuleController extends AbstractConsoleController
{
    use \Gear\Module\ModuleServiceTrait;
    use \Gear\Mvc\Entity\EntityServiceTrait;
    use \Gear\Mvc\Fixture\FixtureServiceTrait;
    use \Gear\Module\Diagnostic\DiagnosticServiceTrait;
    use \Gear\Module\ConstructServiceTrait;
    //use \Gear\ContinuousIntegration\JenkinsTrait;

    public function constructAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-diagnostic'));

        $module = $this->getRequest()->getParam('module', false);

        $basepath = $this->getRequest()->getParam('basepath');

        $config = $this->getRequest()->getParam('config');

        $data = $this->getConstructService()->construct($module, $basepath, $config);

        $this->console = $this->getServiceLocator()->get('console');

        if (count($data['created-msg'***REMOVED***)) {
            foreach ($data['created-msg'***REMOVED*** as $msg) {
                $this->console->writeLine($msg, 0, 3);
            }
        }

        if (count($data['skipped-msg'***REMOVED***)) {
            foreach ($data['skipped-msg'***REMOVED*** as $msg) {
                $this->console->writeLine($msg, 0, 4);
            }
        }



        $this->getEventManager()->trigger('gear.pos', $this);
        return new ConsoleModel();
    }

    public function diagnosticAction()
    {

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-diagnostic'));

        $cli = $this->getRequest()->getParam('type', 'web');

        if ($cli == false) {
            $cli = 'web';
        }

        $this->getDiagnosticService()->diagnostic($cli);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-create'));

        $cli = $this->getRequest()->getParam('type', 'web');

        $module = $this->getModuleService();
        $module->create($cli);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function moduleAsProjectAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-create'));

        $type            = $this->getRequest()->getParam('type');
        $moduleName      = $this->getRequest()->getParam('module');
        $basepath        = $this->getRequest()->getParam('basepath');

        $module = $this->getModuleService();
        $module->moduleAsProject($type, $moduleName, $basepath);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }


    public function upgradeAction()
    {
        $cli = $this->getRequest()->getParam('type', 'web');

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-upgrade'));

        $module = $this->getModuleService();
        $module->upgrade($cli);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function createAngularAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-create-angular'));

        $module = $this->getModuleService();
        $module->createAngular();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function dumpAutoloadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-autoload'));

        $module = $this->getModuleService();
        $module->dumpAutoload();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function fixtureAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-fixture'));

        $module = $this->getFixtureService();
        $module->importModule();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function deleteAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-delete'));

        $module = $this->getModuleService();
        $module->delete();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function loadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-load'));

        $module = $this->getModuleService();
        $module->load();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function unloadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-unload'));

        $module = $this->getModuleService();
        $module->unload();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }



    public function entityAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-entity'));

        $request = $this->getRequest();
        $prefix  = $request->getParam('prefix', false);
        $tables  = $request->getParam('entity', array());

        $entityService = $this->getEntityService();
        $entityService->setUpEntity(array('prefix' => $prefix, 'tables' => $tables));

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function entitiesAction()
    {

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-entities'));


        $request = $this->getRequest();
        $entityService = $this->getEntityService();
        $entityService->setUpEntities(array('prefix' => $request->getParam('prefix', false)));

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function dumpAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-dump'));


        $json = $this->getRequest()->getParam('json');
        $array = $this->getRequest()->getParam('array');

        if ($json === false && $array === false) {
            return 'Type not specified';
        }

        $module = $this->getJsonService();

        if ($json) {
            $dump = $module->dump('json')."\n";
        } elseif ($array) {
            $dump = $module->dump('array')."\n";
        }

        echo $dump;

        $this->getEventManager()->trigger('gear.pos', $this);


        return new ConsoleModel();

    }
}
