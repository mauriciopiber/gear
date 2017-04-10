<?php
namespace Gear\Module;

use Gear\Service\AbstractJsonService;
use Symfony\Component\Yaml\Parser;
use GearJson\Db\DbServiceTrait as DbSchema;
use GearJson\Src\SrcServiceTrait as SrcSchema;
use GearJson\App\AppServiceTrait as AppSchema;
use GearJson\Controller\ControllerServiceTrait as ControllerSchema;
use GearJson\Action\ActionServiceTrait as ActionSchema;
use GearJson\Src\Src;
use GearJson\Db\Db;
use GearJson\Action\Action;
use GearJson\Controller\Controller;
use GearJson\App\App;
use Gear\Constructor\Db\DbServiceTrait as DbService;
use Gear\Constructor\App\AppServiceTrait as AppService;
use Gear\Constructor\Src\SrcServiceTrait as SrcService;
use Gear\Constructor\Controller\ControllerServiceTrait as ControllerService;
use Gear\Constructor\Action\ActionServiceTrait as ActionService;
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
    use DbService;

    use AppService;

    use SrcService;

    use ControllerService;

    use ActionService;

    use DbSchema;

    use SrcSchema;

    use AppSchema;

    use ControllerSchema;

    use ActionSchema;

    static protected $controllerSkip = 'Controller "%s" já existe.';

    static protected $controllerCreate = 'Controller "%s" criado.';

    static protected $actionSkip = 'Action "%s" do Controller "%s" já existe.';

    static protected $actionCreate = 'Action "%s" do Controller "%s" criado.';

    static protected $srcSkip = 'Src nome "%s" do tipo "%s" já existe.';

    static protected $srcCreate = 'Src nome "%s" do tipo "%s" criado.';

    static protected $dbSkip = 'Db tabela "%s" já existe.';

    static protected $dbCreate = 'Db tabela "%s" criado.';

    static protected $appSkip = 'App nome "%s" do tipo "%s" já existe.';

    static protected $appCreate = 'App nome "%s" do tipo "%s" criado.';

    /** @var $configlocation Localizaçao para encontrar o arquivo de configuração */
    protected $configLocation;

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
            foreach ($data['src'***REMOVED*** as $src) {
                $constructList = array_merge_recursive($constructList, $this->constructSrc($module, $src));
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
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $srcItem = new Src($src);

        if ($this->getSrcService()->srcExist($module, $srcItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(static::$srcSkip, $srcItem->getName(), $srcItem->getType());

            return $constructList;
        }

        $created = $this->getSrcConstructor()->create($src);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(static::$srcSkip, $srcItem->getName(), $srcItem->getType());
            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }
            return $constructList;
        }

        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(static::$srcCreate, $srcItem->getName(), $srcItem->getType());
        return $constructList;
    }

    public function constructApp($module, array $app)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $appItem = new App($app);

        if ($this->getAppService()->appExist($module, $appItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(static::$appSkip, $appItem->getName(), $appItem->getType());

            return $constructList;
        }

        $created = $this->getAppConstructor()->create($app);

        if ($created) {
            $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(static::$appCreate, $appItem->getName(), $appItem->getType());
        }

        return $constructList;
    }

    public function constructDb($module, array $db)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $dbItem = new Db($db);

        if ($this->getDbService()->dbExist($module, $dbItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(static::$dbSkip, $dbItem->getTable());

            return $constructList;
        }

        $created = $this->getDbConstructor()->create($db);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(static::$dbCreate, $dbItem->getTable());

            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }

            return $constructList;
        }

        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(static::$dbCreate, $dbItem->getTable());
        return $constructList;
    }

    public function constructController($module, array $controller)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $controllerItem = new Controller($controller);

        if ($this->getControllerService()->controllerExist($module, $controllerItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(static::$controllerSkip, $controllerItem->getName());

            return $constructList;
        }

        $created = $this->getControllerConstructor()->createController($controller);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(static::$controllerSkip, $controllerItem->getName());

            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }

            return $constructList;
        }


        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(static::$controllerCreate, $controllerItem->getName());

        return $constructList;
    }

    public function constructAction($module, $controller, array $action)
    {
        $constructList = ['skipped-msg' => [***REMOVED***, 'created-msg' => [***REMOVED***,' invalid-msg' => [***REMOVED******REMOVED***;

        $actionItem = new Action($action);



        if ($this->getActionService()->actionExist($module, $actionItem)) {
            $constructList['skipped-msg'***REMOVED***[***REMOVED*** = sprintf(
                static::$actionSkip,
                $actionItem->getName(),
                $controller//->getName()
            );

            return $constructList;
        }


        $created = $this->getActionConstructor()->createControllerAction($action);

        if ($created instanceof ConsoleValidationStatus) {
            $constructList['invalid-msg'***REMOVED***[***REMOVED*** = sprintf(static::$actionSkip, $actionItem->getName(), $controller);

            foreach ($created->getErrors() as $errors) {
                $constructList['invalid-msg'***REMOVED***[***REMOVED*** = $errors;
            }

            return $constructList;
        }

        $constructList['created-msg'***REMOVED***[***REMOVED*** = sprintf(
            static::$actionCreate,
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


        if (!is_file($this->getConfigLocation())) {
            throw new \Gear\Module\Exception\GearfileNotFoundException($this->getConfigLocation());
        }

        $yaml = new Parser();

        $config = $yaml->parse(file_get_contents($this->getConfigLocation()));

        //var_dump($config);die();
        return $config;
    }
}
