<?php
namespace Gear\Module\Controller;

use Zend\Mvc\Console\Controller\AbstractConsoleController;
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
use Gear\Cache\CacheService;
use Gear\Module\ModuleService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Module\Diagnostic\DiagnosticService;
use Gear\Module\ConstructService;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Module\Config\ApplicationConfig;
use Gear\Autoload\ComposerAutoload;

/**
 * Funções para manipulação de Módulos
 */
class ModuleController extends AbstractConsoleController
{
    protected $console;

    use ComposerAutoloadTrait;
    use ApplicationConfigTrait;
    use CacheServiceTrait;
    use ModuleServiceTrait;
    use EntityServiceTrait;
    use FixtureServiceTrait;
    use DiagnosticServiceTrait;
    use ConstructServiceTrait;
    use ModuleUpgradeTrait;

    public function __construct(
        ModuleService $moduleService,
        DiagnosticService $diagnosticService,
        ModuleUpgrade $moduleUpgrade,
        ConstructService $constructService,
        ApplicationConfig $applicationConfig,
        CacheService $cacheService
    ) {
        $this->cacheService = $cacheService;
        $this->constructService = $constructService;
        $this->moduleUpgrade = $moduleUpgrade;
        $this->diagnosticService = $diagnosticService;
        $this->moduleService = $moduleService;
        $this->applicationConfig = $applicationConfig;
    }

    public function setConsoleAdapter($console)
    {
        $this->console = $console;
    }

    public function getConsoleAdapter()
    {
        if (!isset($this->console)) {
            $this->console = $this->get('console');
        }
        return $this->console;
    }

    public function constructAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, ['message' => 'module-construct'***REMOVED***);

        $module = $this->getRequest()->getParam('module', false);

        $file = $this->getRequest()->getParam('file');

        $data = $this->getConstructService()->construct($module, $file);

        $this->console = $this->getConsole();

        if ($data->hasCreated()) {
            foreach ($data->getCreated() as $msg) {
                $this->console->writeLine($msg, 0, 3);
            }
        }

        if ($data->hasSkipped()) {
            foreach ($data->getSkipped() as $msg) {
                $this->console->writeLine($msg, 0, 4);
            }
        }

        if ($data->hasValidated()) {
            foreach ($data->getValidated() as $msg) {
                $this->console->writeLine($msg, 0, 2);
            }
        }


        $this->getEventManager()->trigger('gear.pos', $this);
        $model = new ConsoleModel();

        if ($data->hasSkipped() || $data->hasValidated()) {
            $model->setErrorLevel(1);
        }

        return $model;
    }

    public function diagnosticAction()
    {

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-diagnostic'));

        $type = $this->getRequest()->getParam('type', null);

        $just = $this->getRequest()->getParam('just', null);

        $this->getDiagnosticService()->diagnostic($type, $just);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }


    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function moduleAsProjectAction()
    {
        //die('aqui');
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-create'));

        $type            = $this->getRequest()->getParam('type', 'web');
        $moduleName      = $this->getRequest()->getParam('module');
        $basepath        = $this->getRequest()->getParam('basepath');
        $staging         = $this->getRequest()->getParam('staging', null);

        $module = $this->getModuleService();
        $module->moduleAsProject($moduleName, $basepath, $type, $staging);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }


    public function upgradeAction()
    {
        $type = $this->getRequest()->getParam('type', null);
        $force = $this->getRequest()->getParam('force', false);
        $just = $this->getRequest()->getParam('just', null);

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-upgrade'));

        $module = $this->getModuleUpgrade();
        $module->upgrade($type, $just, $force);

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

}
