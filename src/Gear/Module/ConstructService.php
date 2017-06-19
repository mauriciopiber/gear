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
    public function construct($module, $basepath, $fileConfig = null)
    {
        unset($basepath);

        $constructList = ['module' => $module, 'skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***, 'invalid-msg' => [***REMOVED******REMOVED***;

        if (!empty($fileConfig) && empty($this->configLocation)) {
            $this->setConfigLocation($fileConfig);
        }

        $data = $this->getGearfileConfig();

        if (isset($data['src'***REMOVED***)) {
            $entity = [***REMOVED***;

            foreach ($data['src'***REMOVED*** as $i => $src) {
                if ($src['type'***REMOVED*** == 'Entity') {
                    $entity[***REMOVED*** = $src;
                    continue;
                }

                $constructList = array_merge_recursive($constructList, $this->constructSrc($module, $src));
            }

            if (count($entity) > 0) {
                $this->getSrcConstructor()->createEntities($entity);
            }
        }

        if (isset($data['db'***REMOVED***)) {
            foreach ($data['db'***REMOVED*** as $db) {
                $constructList = array_merge_recursive($constructList, $this->constructDb($module, $db));
            }
        }

        if (isset($data['controller'***REMOVED***)) {
            foreach ($data['controller'***REMOVED*** as $controller) {
                $constructList = array_merge_recursive(
                    $constructList,
                    $this->constructController($module, $controller)
                );

                if (isset($controller['actions'***REMOVED***)) {
                    foreach ($controller['actions'***REMOVED*** as $action) {
                        $action['controller'***REMOVED*** = $controller['name'***REMOVED***;
                        if (isset($controller['db'***REMOVED***)) {
                            $action['db'***REMOVED*** = $controller['db'***REMOVED***;
                        }
                        if (isset($controller['columns'***REMOVED***)) {
                            $action['columns'***REMOVED*** = $controller['columns'***REMOVED***;
                        }

                        $constructList = array_merge_recursive(
                            $constructList,
                            $this->constructAction($module, $controller['name'***REMOVED***, $action)
                        );
                    }
                }
            }
        }

        if (isset($data['app'***REMOVED***)) {
            foreach ($data['app'***REMOVED*** as $app) {
                $constructList = array_merge_recursive($constructList, $this->constructApp($module, $app));
            }
        }

        return $constructList;
    }

    public function constructSrc($module, array $src)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***, 'invalid-msg' => [***REMOVED******REMOVED***;

        $srcItem = new Src($src);

        if ($this->getSrcService()->srcExist($module, $srcItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(self::SRC_SKIP, $srcItem->getName(), $srcItem->getType());

            return $constructList;
        }

        $created = $this->getSrcConstructor()->create($src);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(self::SRC_VALIDATE, $srcItem->getName(), $srcItem->getType());
            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }
            return $constructList;
        }

        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(self::SRC_CREATED, $srcItem->getName(), $srcItem->getType());
        return $constructList;
    }

    public function constructApp($module, array $app)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $appItem = new App($app);

        if ($this->getAppService()->appExist($module, $appItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(self::APP_SKIP, $appItem->getName(), $appItem->getType());

            return $constructList;
        }

        $created = $this->getAppConstructor()->create($app);

        if ($created) {
            $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(self::APP_CREATED, $appItem->getName(), $appItem->getType());
        }

        return $constructList;
    }

    public function constructDb($module, array $db)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $dbItem = new Db($db);

        if ($this->getDbService()->dbExist($module, $dbItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(self::DB_SKIP, $dbItem->getTable());

            return $constructList;
        }

        $created = $this->getDbConstructor()->create($db);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(self::DB_VALIDATE, $dbItem->getTable());

            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }

            return $constructList;
        }

        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(self::DB_CREATED, $dbItem->getTable());
        return $constructList;
    }

    public function constructController($module, array $controller)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $controllerItem = new Controller($controller);

        if ($this->getControllerService()->controllerExist($module, $controllerItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(self::CONTROLLER_SKIP, $controllerItem->getName());

            return $constructList;
        }

        $created = $this->getControllerConstructor()->createController($controller);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(self::CONTROLLER_VALIDATE, $controllerItem->getName());

            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }

            return $constructList;
        }

        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(self::CONTROLLER_CREATED, $controllerItem->getName());

        return $constructList;
    }

    public function constructAction($module, $controller, array $action)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $actionItem = new Action($action);



        if ($this->getActionService()->actionExist($module, $actionItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(
                self::ACTION_SKIP,
                $actionItem->getName(),
                $controller//->getName()
            );

            return $constructList;
        }


        $created = $this->getActionConstructor()->createControllerAction($action);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(self::ACTION_VALIDATE, $actionItem->getName(), $controller);

            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }

            return $constructList;
        }

        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(
            self::ACTION_CREATED,
            $actionItem->getName(),
            $controller//->getName()
        );

        return $constructList;
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
