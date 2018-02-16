<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Symfony\Component\Yaml\Parser;
use GearJson\Db\DbSchemaTrait as DbSchemaTrait;
use GearJson\Src\SrcSchemaTrait as SrcSchemaTrait;
use GearJson\App\AppServiceTrait as AppSchemaTrait;
use GearJson\Controller\ControllerSchemaTrait as ControllerSchemaTrait;
use GearJson\Action\ActionSchemaTrait as ActionSchemaTrait;
use GearJson\Db\DbSchema as DbSchema;
use GearJson\Src\SrcSchema as SrcSchema;
use GearJson\App\AppService as AppSchema;
use GearJson\Controller\ControllerSchema as ControllerSchema;
use GearJson\Action\ActionSchema as ActionSchema;
use GearJson\Src\Src;
use GearJson\Db\Db;
use GearJson\Action\Action;
use GearJson\Controller\Controller;
use GearJson\App\App;
use Gear\Constructor\Db\DbConstructorTrait;
use Gear\Constructor\App\AppServiceTrait;
use Gear\Constructor\Src\SrcConstructorTrait;
use Gear\Constructor\Controller\ControllerConstructorTrait;
use Gear\Constructor\Action\ActionConstructorTrait;
use Gear\Constructor\Db\DbConstructor;
use Gear\Constructor\App\AppService;
use Gear\Constructor\Src\SrcConstructor;
use Gear\Constructor\Controller\ControllerConstructor;
use Gear\Constructor\Action\ActionConstructor;
use Gear\Module\Exception\GearfileNotFoundException;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Module\ConstructStatusObject;
use GearJson\Src\SrcTypesInterface;

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

    use DbConstructorTrait;

    use AppServiceTrait;

    use SrcConstructorTrait;

    use ControllerConstructorTrait;

    use ActionConstructorTrait;

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

    const DB_VALIDATE = 'Db %s encontrou erros na formatação';

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
        DbConstructor $dbService,
        SrcConstructor $srcService,
        AppService $appService,
        ControllerConstructor $controllerService,
        ActionConstructor $actionService
    ) {

        $this->actionConstructor = $actionService;
        $this->dbConstructor = $dbService;
        $this->srcConstructor = $srcService;
        $this->controllerConstructor = $controllerService;
        $this->appConstructor = $appService;

        $this->actionSchema = $actionSchema;
        $this->dbSchema = $dbSchema;
        $this->srcSchema = $srcSchema;
        $this->controllerSchema = $controllerSchema;
        $this->appService = $appSchema;
    }

    public function isEmpty(array $data, $key)
    {
        return (
            !isset($data[$key***REMOVED***)
            || !is_array($data[$key***REMOVED***)
            || count($data[$key***REMOVED***) <= 0
        );
    }

    public function constructAllDb(array $data)
    {
        if ($this->isEmpty($data, 'db')) {
            return;
        }

        foreach ($data['db'***REMOVED*** as $db) {
            $this->constructDb($db);
        }
    }

    public function constructAllApp(array $data)
    {
        if ($this->isEmpty($data, 'app')) {
            return;
        }

        foreach ($data['app'***REMOVED*** as $app) {
            $this->constructApp($app);
        }
    }

    public function constructAllSrc(array $data)
    {
        if ($this->isEmpty($data, 'src')) {
            return;
        }

        $entity = [***REMOVED***;
        $addon = [***REMOVED***;

        foreach ($data['src'***REMOVED*** as $src) {
            if ($src['type'***REMOVED*** === SrcTypesInterface::ENTITY) {
                $entity[***REMOVED*** = $src;
                continue;
            }

            if (in_array($src['type'***REMOVED***, [SrcTypesInterface::FACTORY, SrcTypesInterface::TRAIT***REMOVED***)) {
                $addon[***REMOVED*** = $src;
                continue;
            }

            $this->constructSrc($src);
        }

        if (count($entity) > 0) {
            $this->constructSrcEntity($entity);
            //$this->getSrcConstructor()->createEntities($entity);
        }

        if (count($addon) > 0) {
            $this->constructSrcAdditional($addon);
        }
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

        $this->moduleName = $module;
        $this->constructStatus = new ConstructStatusObject();

        if (!empty($fileConfig) && empty($this->configLocation)) {
            $this->setConfigLocation($fileConfig);
        }

        $data = $this->getGearfileConfig();

        $this->constructAllSrc($data);

        $this->constructAllDb($data);
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

                        if (isset($controller['namespace'***REMOVED***)) {
                            $action['controllerNamespace'***REMOVED*** = $controller['namespace'***REMOVED***;
                        }

                        $this->constructAction($module, $action);
                    }
                }
            }
        }

        $this->constructAllApp($data);


        //return $constructList;

        return $this->constructStatus;
    }

    public function constructSrcEntity($entity)
    {
        $data = $this->getSrcConstructor()->createEntities($entity);

        $this->processConstructor($data);
    }

    public function processConstructor(array $data)
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
                $this->constructStatus->addValidated($src->getErrors());
            }
        }
    }

    public function constructSrcAdditional($addon)
    {
        $data = $this->getSrcConstructor()->createAdditional($addon);

        $this->processConstructor($data);
    }


    public function constructSrc(array $src)
    {
        $srcItem = $this->getSrcSchema()->factory($this->moduleName, $src, false);

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

        if ($this->getSrcSchema()->srcExist($this->moduleName, $srcItem)) {
            $this->constructStatus->addSkipped(sprintf(self::SRC_SKIP, $srcItem->getName(), $srcItem->getType()));
            return;
        }

        $created = $this->getSrcConstructor()->create($srcItem->export());

        if ($created) {
            $this->constructStatus->addCreated(sprintf(self::SRC_CREATED, $srcItem->getName(), $srcItem->getType()));
        }


    }

    public function constructApp(array $app)
    {

        $appItem = new App($app);

        if ($this->getAppService()->appExist($this->moduleName, $appItem)) {
            $this->constructStatus->addSkipped(sprintf(self::APP_SKIP, $appItem->getName(), $appItem->getType()));

            return;
        }

        $created = $this->getAppConstructor()->create($app);

        if ($created) {
            $this->constructStatus->addCreated(sprintf(self::APP_CREATED, $appItem->getName(), $appItem->getType()));
        }

        return null;
    }

    public function constructDb(array $db)
    {
        $canCreate = $this->dbSchema->canCreate($this->moduleName, $db);

        if ($canCreate === false) {
            $this->addSkipName($db, 'table', self::DB_SKIP);
            return;
        }

        if ($canCreate instanceof ConsoleValidationStatus) {
            $this->addValidateName($db, 'table', self::DB_VALIDATE);
            $this->constructStatus->addValidated($canCreate->getErrors());
            return;
        }

        $db = $this->getDbConstructor()->create($canCreate);
        $this->constructStatus->addCreated(sprintf(self::DB_CREATED, $db->getTable()));

        return;
    }


    public function addSkipName($db, $key, $message)
    {
        if (!isset($db[$key***REMOVED***) && empty($db[$key***REMOVED***)) {
            return;
        }

        $this->constructStatus->addSkipped(sprintf($message, $db[$key***REMOVED***));

    }

    public function addValidateName($db, $key, $message)
    {
        if (!isset($db[$key***REMOVED***) && empty($db[$key***REMOVED***)) {
            return;
        }

        $this->constructStatus->addValidated(sprintf($message, $db[$key***REMOVED***));

    }

    public function constructController($module, array $controller)
    {

        unset($controller['actions'***REMOVED***);
        $controllerItem = new Controller($controller);

        if ($this->getControllerSchema()->controllerExist($module, $controllerItem)) {
            $this->constructStatus->addSkipped(sprintf(self::CONTROLLER_SKIP, $controllerItem->getName()));

            return;
        }

        $created = $this->getControllerConstructor()->createController($controller);

        if ($created instanceof ConsoleValidationStatus) {
            $this->constructStatus->addValidated(sprintf(self::CONTROLLER_VALIDATE, $controllerItem->getName()));
            $this->constructStatus->addValidated($created->getErrors());
            return;
        }

        $this->constructStatus->addCreated(sprintf(self::CONTROLLER_CREATED, $controllerItem->getName()));

        return;
    }

    public function constructAction($module, array $action)
    {
        $actionItem = new Action($action);

        if ($this->getActionSchema()->actionExist($module, $actionItem)) {
            $this->constructStatus->addSkipped(sprintf(
                self::ACTION_SKIP,
                $actionItem->getName(),
                $actionItem->getController()->getName()//->getName()
            ));

            return;
        }

        $created = $this->getActionConstructor()->createControllerAction($action);

        if ($created instanceof ConsoleValidationStatus) {
            $this->constructStatus->addValidated(sprintf(self::ACTION_VALIDATE, $actionItem->getName(), $actionItem->getController()->getName()));
            $this->constructStatus->addValidated($created->getErrors());
            return;
        }

        $this->constructStatus->addCreated(sprintf(
            self::ACTION_CREATED,
            $actionItem->getName(),
            $actionItem->getController()->getName()//->getName()
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
