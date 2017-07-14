<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Symfony\Component\Yaml\Parser;
use GearJson\Db\DbServiceTrait as DbSchemaTrait;
use GearJson\Src\SrcServiceTrait as SrcSchemaTrait;
use GearJson\App\AppServiceTrait as AppSchemaTrait;
use GearJson\Controller\ControllerServiceTrait as ControllerSchemaTrait;
use GearJson\Action\ActionServiceTrait as ActionSchemaTrait;
use GearJson\Db\DbService as DbSchema;
use GearJson\Src\SrcService as SrcSchema;
use GearJson\App\AppService as AppSchema;
use GearJson\Controller\ControllerService as ControllerSchema;
use GearJson\Action\ActionService as ActionSchema;
use GearJson\Src\Src;
use GearJson\Db\Db;
use GearJson\Action\Action;
use GearJson\Controller\Controller;
use GearJson\App\App;
use Gear\Constructor\Db\DbServiceTrait;
use Gear\Constructor\App\AppServiceTrait;
use Gear\Constructor\Src\SrcServiceTrait;
use Gear\Constructor\Controller\ControllerServiceTrait;
use Gear\Constructor\Action\ActionServiceTrait;
use Gear\Constructor\Db\DbService;
use Gear\Constructor\App\AppService;
use Gear\Constructor\Src\SrcService;
use Gear\Constructor\Controller\ControllerService;
use Gear\Constructor\Action\ActionService;
use Gear\Module\Exception\GearfileNotFoundException;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Module\ConstructStatusObject;

/**
 * Cria os componentes para o módulo de acordo com o arquivo de configuração gear.
 *
 * Une todas funções de Constructor em um comando único.
 *
 * @category Module
 * @package  Gear
 * @author   Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @license  FreeBds http://www.freebsd.org/copyright/freebsd-license.html
 * @version  Release: 1.0.0
 * @link     http://docs.pibernetwork.com/gear
 *
 */
class ConstructService extends AbstractJsonService
{
    private $constructStatus;

    use DbServiceTrait;

    use AppServiceTrait;

    use SrcServiceTrait;

    use ControllerServiceTrait;

    use ActionServiceTrait;

    use DbSchemaTrait;

    use SrcSchemaTrait;

    use AppSchemaTrait;

    use ControllerSchemaTrait;

    use ActionSchemaTrait;

    const CONTROLLER_SKIP = 'Controller "%s" já existe.';

    const CONTROLLER_VALIDATE = 'Controller "%s" apresentou erros na formatação:';

    const CONTROLLER_CREATED = 'Controller "%s" criado.';

    const ACTION_SKIP = 'Action "%s" do Controller "%s" já existe.';

    const ACTION_VALIDATE = 'Action "%s" do Controller "%s" apresentou erros na formatação';

    const ACTION_CREATED = 'Action "%s" do Controller "%s" criado.';

    const SRC_SKIP = 'Src nome "%s" do tipo "%s" já existe.';

    const SRC_VALIDATE = 'Src %s retornou erros durante validação';

    const SRC_CREATED = 'Src nome "%s" do tipo "%s" criado.';

    const DB_SKIP = 'Db tabela "%s" já existe.';

    const DB_VALIDATE = '';

    const DB_CREATED = 'Db tabela "%s" criado.';

    const APP_SKIP = 'App nome "%s" do tipo "%s" já existe.';

    const APP_VALIDATE = '';

    const APP_CREATED = 'App nome "%s" do tipo "%s" criado.';

    /** @var $configlocation Localizaçao para encontrar o arquivo de configuração */
    protected $configLocation;

    public function __construct(
        DbSchema $dbSchema,
        SrcSchema $srcSchema,
        AppSchema $appSchema,
        ControllerSchema $controllerSchema,
        ActionSchema $actionSchema,
        DbService $dbService,
        SrcService $srcService,
        AppService $appService,
        ControllerService $controllerService,
        ActionService $actionService
    ) {

        $this->actionConstructor = $actionService;
        $this->dbConstructor = $dbService;
        $this->srcConstructor = $srcService;
        $this->controllerConstructor = $controllerService;
        $this->appConstructor = $appService;

        $this->actionService = $actionSchema;
        $this->dbService = $dbSchema;
        $this->srcService = $srcSchema;
        $this->controllerService = $controllerSchema;
        $this->appService = $appSchema;
    }

    /**
     * Cria componentes de acordo com o arquivo de configuração yml.
     *
     * @param string  $module     Nome do módulo
     * @param string  $basepath   Localização do módulo
     * @param unknown $fileConfig Localização do arquivo de configuração Gear.
     *
     * @return boolean
     */
    public function construct($module, $fileConfig = null)
    {
        $this->constructStatus = new ConstructStatusObject();

        if (!empty($fileConfig) && empty($this->configLocation)) {
            $this->setConfigLocation($fileConfig);
        }

        $data = $this->getGearfileConfig();

        if (isset($data['src'***REMOVED***)) {
            $entity = [***REMOVED***;
            $addon = [***REMOVED***;

            foreach ($data['src'***REMOVED*** as $i => $src) {
                if ($src['type'***REMOVED*** == 'Entity') {
                    $entity[***REMOVED*** = $src;
                    continue;
                }

                if (in_array($src['type'***REMOVED***, ['Factory', 'Trait'***REMOVED***)) {
                    $addon[***REMOVED*** = $src;
                    continue;
                }

                $this->constructSrc($module, $src);
            }

            if (count($entity) > 0) {
                $this->constructSrcEntity($entity);
                //$this->getSrcConstructor()->createEntities($entity);
            }

            if (count($addon) > 0) {
                $this->constructSrcAdditional($addon);
                //$this->getSrcConstructor()->createAdditional($addon);
            }
        }

        if (isset($data['db'***REMOVED***)) {
            foreach ($data['db'***REMOVED*** as $db) {
                $this->constructDb($module, $db);
            }
        }

        if (isset($data['controller'***REMOVED***)) {
            foreach ($data['controller'***REMOVED*** as $controller) {

                $this->constructController($module, $controller);

                if (isset($controller['actions'***REMOVED***)) {
                    foreach ($controller['actions'***REMOVED*** as $action) {
                        $action['controller'***REMOVED*** = $controller['name'***REMOVED***;
                        if (isset($controller['db'***REMOVED***)) {
                            $action['db'***REMOVED*** = $controller['db'***REMOVED***;
                        }
                        if (isset($controller['columns'***REMOVED***)) {
                            $action['columns'***REMOVED*** = $controller['columns'***REMOVED***;
                        }


                        $this->constructAction($module, $controller['name'***REMOVED***, $action);

                    }
                }
            }
        }

        if (isset($data['app'***REMOVED***)) {
            foreach ($data['app'***REMOVED*** as $app) {
                $this->constructApp($module, $app);
            }
        }

        //return $constructList;

        return $this->constructStatus;
    }

    public function constructSrcEntity($entity)
    {
        $data = $this->getSrcConstructor()->createEntities($entity);

        $this->processConstructor($data);
    }

    public function processConstructor($data)
    {
        if (isset($data['created'***REMOVED***)) {
            foreach ($data['created'***REMOVED*** as $src) {
                $this->constructStatus->addCreated(sprintf(self::SRC_CREATED, $src->getName(), $src->getType()));
            }
        }

        if (isset($data['skipped'***REMOVED***)) {
            foreach ($data['skipped'***REMOVED*** as $src) {
                $this->constructStatus->addSkipped(sprintf(self::SRC_SKIPPED, $src->getName(), $src->getType()));
            }
        }

        if (isset($data['validated'***REMOVED***)) {
            foreach ($data['validated'***REMOVED*** as $src) {
                $this->constructStatus->addValidated(
                    sprintf(
                        self::SRC_VALIDATE,
                        (isset($src['name'***REMOVED***) ? $src['name'***REMOVED*** : ''),
                        (isset($src['type'***REMOVED***) ? $src['type'***REMOVED*** : '')
                    )
                );
                $this->constructStatus->addValidated($srcItem->getErrors());
            }
        }
    }

    public function constructSrcAdditional($addon)
    {
        $data = $this->getSrcConstructor()->createAdditional($addon);

        $this->processConstructor($data);
    }


    public function constructSrc($module, array $src)
    {
        $srcItem = $this->getSrcService()->factory($module, $src, false);

        if ($srcItem instanceof ConsoleValidationStatus) {
            $this->constructStatus->addValidated(
                sprintf(
                    self::SRC_VALIDATE,
                    (isset($src['name'***REMOVED***) ? $src['name'***REMOVED*** : ''),
                    (isset($src['type'***REMOVED***) ? $src['type'***REMOVED*** : '')
                )
            );
            $this->constructStatus->addValidated($srcItem->getErrors());
            return;
        }

        if ($this->getSrcService()->srcExist($module, $srcItem)) {
            $this->constructStatus->addSkipped(sprintf(self::SRC_SKIP, $srcItem->getName(), $srcItem->getType()));
            return;
        }

        $created = $this->getSrcConstructor()->create($srcItem->export());

        $this->constructStatus->addCreated(sprintf(self::SRC_CREATED, $srcItem->getName(), $srcItem->getType()));
    }

    public function constructApp($module, array $app)
    {

        $appItem = new App($app);

        if ($this->getAppService()->appExist($module, $appItem)) {
            $this->constructStatus->addSkipped(sprintf(self::APP_SKIP, $appItem->getName(), $appItem->getType()));

            return;
        }

        $created = $this->getAppConstructor()->create($app);

        if ($created) {
            $this->constructStatus->addCreated(sprintf(self::APP_CREATED, $appItem->getName(), $appItem->getType()));
        }

        return null;
    }

    public function constructDb($module, array $db)
    {

        $dbItem = new Db($db);

        if ($this->getDbService()->dbExist($module, $dbItem)) {
            $this->constructStatus->addSkipped(sprintf(self::DB_SKIP, $dbItem->getTable()));

            return;
        }

        $created = $this->getDbConstructor()->create($db);

        if ($created instanceof ConsoleValidationStatus) {
            $this->constructStatus->addValidated(sprintf(self::DB_VALIDATE, $dbItem->getTable()));
            $this->constructStatus->addValidated($created->getErrors());
            return;
        }

        $this->constructStatus->addCreated(sprintf(self::DB_CREATED, $dbItem->getTable()));

        return;
    }

    public function constructController($module, array $controller)
    {

        $controllerItem = new Controller($controller);

        if ($this->getControllerService()->controllerExist($module, $controllerItem)) {
            $this->constructStatus->addSkipped(sprintf(self::CONTROLLER_SKIP, $controllerItem->getName()));

            return;
        }

        $created = $this->getControllerConstructor()->createController($controller);

        if ($created instanceof ConsoleValidationStatus) {
            $this->constructStatus->addValidated(sprintf(self::CONTROLLER_VALIDATE, $controllerItem->getName()));
            $this->constructStatus->addValidated($created->getErrors());

            /**
            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }

            return $constructList;
            */
            return;
        }

        $this->constructStatus->addCreated(sprintf(self::CONTROLLER_CREATED, $controllerItem->getName()));

        return;
    }

    public function constructAction($module, $controller, array $action)
    {
        $actionItem = new Action($action);

        if ($this->getActionService()->actionExist($module, $actionItem)) {
            $this->constructStatus->addSkipped(sprintf(
                self::ACTION_SKIP,
                $actionItem->getName(),
                $controller//->getName()
            ));

            return;
        }

        $created = $this->getActionConstructor()->createControllerAction($action);

        if ($created instanceof ConsoleValidationStatus) {
            $this->constructStatus->addValidated(sprintf(self::ACTION_VALIDATE, $actionItem->getName(), $controller));
            $this->constructStatus->addValidated($created->getErrors());
            return;
        }

        $this->constructStatus->addCreated(sprintf(
            self::ACTION_CREATED,
            $actionItem->getName(),
            $controller//->getName()
        ));

        return;
    }

    /**
     * Retorna a localização padrão do arquivo gearfile.yml
     *
     * @return string $defaultFile Arquivo padrão
     */
    public function getDefaultLocation()
    {
        $defaultFile = 'gearfile.yml';

        return $defaultFile;
    }

    /**
     * Seta a localização da configuração
     *
     * @param string $configLocation
     * @return \Gear\Module\ConstructService
     */
    public function setConfigLocation($configLocation)
    {
        if ($configLocation && is_file($configLocation)) {
            $this->configLocation = $configLocation;
            return $this;
        }

        if ($configLocation) {
            $basePath = $this->getBaseDir();

            $configPath = $basePath.'/'.$configLocation;

            if (!is_file($configPath)) {
                throw new GearfileNotFoundException($configPath);
            }
        } else {
            $configPath = $this->getDefaultLocation();
        }

        $this->configLocation = $configPath;
        return $this;
    }

    /**
     * Retorna a localização da configuração
     *
     * @return string
    */
    public function getConfigLocation()
    {
        return $this->configLocation;
    }

    /**
     * Lê o arquivo gearfile do disco e retorna as configurações que serão usadas.
     *
     * @throws \Gear\Module\Exception\GearfileNotFoundException
     *
     * @return array $config
    */
    public function getGearfileConfig()
    {
        if (empty($this->getConfigLocation())) {
            $this->setConfigLocation($this->getDefaultLocation());
        }

        $yaml = new Parser();

        $config = $yaml->parse(file_get_contents($this->getConfigLocation()));

        //var_dump($config);die();
        return $config;
    }
}
