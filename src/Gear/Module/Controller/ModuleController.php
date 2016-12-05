<?php
namespace Gear\Module\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;
use Gear\Cache\CacheServiceTrait;
use Gear\Module\ModuleServiceTrait;
use Gear\Mvc\Entity\EntityServiceTrait;
use Gear\Mvc\Fixture\FixtureServiceTrait;
use Gear\Module\Diagnostic\DiagnosticServiceTrait;
use Gear\Module\ConstructServiceTrait;
use Gear\Module\Upgrade\ModuleUpgradeTrait;
use Gear\Module\Config\ApplicationConfigTrait;
use Gear\Autoload\ComposerAutoloadTrait;

/**
 * Funções para manipulação de Módulos
 */
class ModuleController extends AbstractConsoleController
{
    use ComposerAutoloadTrait;
    use ApplicationConfigTrait;
    use CacheServiceTrait;
    use ModuleServiceTrait;
    use EntityServiceTrait;
    use FixtureServiceTrait;
    use DiagnosticServiceTrait;
    use ConstructServiceTrait;
    use ModuleUpgradeTrait;

    public function constructAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-construct'));

        $module = $this->getRequest()->getParam('module', false);

        $basepath = $this->getRequest()->getParam('basepath');

        $file = $this->getRequest()->getParam('file');

        $data = $this->getConstructService()->construct($module, $basepath, $file);

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

        $type = $this->getRequest()->getParam('type', 'web');

        if ($type == false) {
            $type = 'web';
        }

        $just = $this->getRequest()->getParam('just', null);

        $this->getDiagnosticService()->diagnostic($type, $just);

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

        $moduleName = $this->getRequest()->getParam('module', null);
        $cli = $this->getRequest()->getParam('type', 'web');

        $module = $this->getModuleService();
        $module->create($moduleName, $cli);

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

        $type            = $this->getRequest()->getParam('type', 'web');
        $moduleName      = $this->getRequest()->getParam('module');
        $basepath        = $this->getRequest()->getParam('basepath');

        $module = $this->getModuleService();
        $module->moduleAsProject($moduleName, $basepath, $type);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }


    public function upgradeAction()
    {
        $type = $this->getRequest()->getParam('type', 'web');
        $force = $this->getRequest()->getParam('force', false);
        $just = $this->getRequest()->getParam('just', null);

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-upgrade'));

        $module = $this->getModuleUpgrade();
        $module->upgrade($type, $just, $force);

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

    /**
     * Carrega um módulo no projeto por meio do application.config.php
     *
     * @return \Zend\View\Model\ConsoleModel
     */
    public function loadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-load'));

        $module = $this->getApplicationConfig();
        $module->addModuleToProject();

        $this->getCacheService()->renewFileCache();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    /**
     * Remove um módulo do application.config.php do projeto
     *
     * @return \Zend\View\Model\ConsoleModel
     */
    public function unloadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-unload'));

        $module = $this->getApplicationConfig();
        $module->unload();

        $this->getCacheService()->renewFileCache();

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
}
