<?php
/**
 * Gear.
 *
 * Gear Is The Edge Project From PiberNetwork.
 *
 * PHP VERSION 5.6
 *
 *  @category   Schema
 *  @package    Gear
 *  @subpackage Gear
 *  @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 *  @copyright  2014-2016 Mauricio Piber Fão
 *  @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 *  @link       https://bitbucket.org/mauriciopiber/gear
 */

namespace Gear;

use Gear\ValueObject\BasicModuleStructure;
use Zend\Db\Metadata\Metadata;
use Zend\ServiceManager\ServiceLocatorInterface;
use GearJson\Service\JsonLoaderServiceTrait;

/**
 * This is a summary.
 *
 * This is a description.
 *
 * @category   Schema
 * @package    Gear
 * @subpackage Gear
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */

class Schema
{
    use JsonLoaderServiceTrait;
    use \Gear\Common\FileServiceTrait;

    protected $module;

    protected $name = 'schema/module.json';

    protected $serviceLocator;

    /**
     * Construtor da Classe
     *
     * @param BasicModuleStructure    $module         Estrutura Modular iniciada pelo Gear quando passa "modulo" como parametro.
     * @param ServiceLocatorInterface $serviceLocator ServiceManager.
     */
    public function __construct(BasicModuleStructure $module, ServiceLocatorInterface $serviceLocator)
    {
        $this->module = $module;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Função responsável por iniciar um novo schema
     */
    public function init()
    {
        return array($this->getModule()->getModuleName() => array('db' => array(), 'src' => array(), 'controller' => array()));
    }

    public function getSpecialityArray($db, $arrayToValidate = null)
    {
        $specialityName = [***REMOVED***;
        if (isset($db)) {
            foreach ($db->getColumns() as $column => $speciality) {
                if ($arrayToValidate == null || in_array($speciality, $arrayToValidate)) {
                    $specialityName[$column***REMOVED*** = $speciality;
                }

            }
        }

        return $specialityName;
    }

    public function getSpecialityByColumnName($columnName, $tableName)
    {
        $dbs = $this->__extractObject('db');
        foreach ($dbs as $db) {
            if ($db->getTable() ==  $tableName) {
                break;
            }
            unset($db);
        }
        $specialityName = null;
        if (isset($db)) {

            if($db->getColumns()) {
                foreach ($db->getColumns() as $column => $speciality) {
                    if ($column == $columnName) {
                        $specialityName = $speciality;
                        break;
                    }
                }
            }


        }
        return $specialityName;
    }


    /**
     * Retorna o objeto DB do schema a partir do nome.
     *
     * @param string $name Nome do DB a ser pesquisado
     *
     * @return NULL|\Gear\ValueObject\Db $db Objeto DB do schema
     */
    public function getDbByName($name)
    {
        $dbSchema         = $this->__extractObject('db');

        foreach ($dbSchema as $db) {
            if ($db->getTable() == $name) {
                return $db;
            }
        }

        return null;
    }

    public function checkSchemaAlreadySet($db, $srcSet, $controllers)
    {
        $dbSchema         = $this->__extractObject('db');
        $controllerSchema = $this->__extractObject('controller');
        $srcSchema        = $this->__extractObject('src');

        foreach ($dbSchema as $dbRow) {
            $name = $dbRow->getTable();
            if ($name == $db->getTable()) {
                throw new \Exception(sprintf('DB %s já está cadastrado no schema do módulo %s', $name, $this->getModule()->getModuleName()));
            }
        }

        foreach ($controllerSchema as $controllerRow) {
            $name = $controllerRow->getName();
            if ($name == $controllers->getName()) {
                throw new \Exception(sprintf('Controller %s já está cadastrado no schema do módulo %s', $name, $this->getModule()->getModuleName()));
            }
        }

        foreach ($srcSchema as $srcRow) {
            $name = $srcRow->getName();

            foreach ($srcSet as $src) {
                if ($name == $src->getName()) {
                    throw new \Exception(sprintf('Src %s já está cadastrado no schema do módulo %s', $name, $this->getModule()->getModuleName()));
                }
            }
        }


        return true;
    }

    /**
     * Procura no schema, utilizando o nome, de determinado SRC já cadastrado no json.
     *
     * @param string $name Nome do SRC.
     *
     * @return NULL|integer Localização numérica do SRC no Schema.
     */
    public function findIntoSrc($name)
    {
        $objects = $this->__extract('src');
        $replaceLocation = null;
        foreach ($objects as $i => $v) {
            if ($v['name'***REMOVED*** == $name) {

                $replaceLocation = $i;
                break;
            }
        }

        return $replaceLocation;
    }

    /**
     * Procura no schema, utilizando o nome, de determinado Controller já cadastrado no json.
     *
     * @param string $name Nome do Controller.
     *
     * @return NULL|integer Localização numérica do Controller no Schema.
     */
    public function findIntoController($name)
    {
        $objects = $this->__extract('controller');
        $replaceLocation = null;
        foreach ($objects as $i => $v) {
            if ($v['name'***REMOVED*** == $name) {

                $replaceLocation = $i;
                break;
            }
        }

        return $replaceLocation;
    }

    /**
     * Procura no schema, utilizando o nome, de determinado DB já cadastrado no json.
     *
     * @param string $name Nome do DB.
     *
     * @return NULL|integer Localização numérica do DB no Schema.
     */
    public function findIntoDb($name)
    {
        $objects = $this->__extract('db');
        $replaceLocation = null;
        foreach ($objects as $i => $v) {
            if ($v['table'***REMOVED*** == $name) {

                $replaceLocation = $i;
                break;
            }
        }

        return $replaceLocation;
    }

    /**
     * Procura pela localização exata de um componente no schema para substituição.
     *
     * @param string $type O Tipo [src/controller/db***REMOVED*** a ser procurado.
     * @param string $name O Nome do componente a ser procurado
     *
     * @return $replaceLocation A localização exata do componente a ser procurado
     */
    public function getReplaceLocation($type, $name)
    {
        $replaceLocation = null;
        switch($type) {
            case 'src':
                $replaceLocation = $this->findIntoSrc($name);
                break;
            case 'controller':
                $replaceLocation = $this->findIntoController($name);
                break;
            case 'db':
                 $replaceLocation = $this->findIntoDb($name);
                break;
        }
        return $replaceLocation;
    }

    public function replaceIntoLocation($type, $location, $object)
    {
        $schema = $this->decode($this->getJsonFromFile());
        $schema[$this->getModule()->getModuleName()***REMOVED***[$type***REMOVED***[$location***REMOVED*** = $object->export();
        return $this->persistSchema($schema);
    }


    public function updateDb($db)
    {

        $location = $this->getReplaceLocation('db', $db->getTable());
        $this->replaceIntoLocation('db', $location, $db);
        //verifica o registro de db, se for diferente tp tiver mais colunas, atualizar.

        //verifica o registro de controller
        //verifica o registro de action
        //verifica o registro de src

        return true;
    }

    public function toCamelcase($word)
    {
        $filter = new \Zend\Filter\Word\UnderscoreToCamelCase();
        return $filter->filter($word);
    }

    public function hasImageDependency($dbToInsert)
    {

        $imagemTable = $this->getImageTable();

        if (!$imagemTable) {
            return false;
        }

        $constrains = $imagemTable->getConstraints();

        $imagemConstraint = false;

        if (count($constrains)>0) {
            foreach ($constrains as $constraint) {

                if ($constraint->getType() == 'FOREIGN KEY') {

                    $tableName = $constraint->getReferencedTableName();
                    if ($dbToInsert->getTable() == $this->toCamelcase($tableName)) {

                        $imagemConstraint = true;

                    }
                }
            }
        }

        return $imagemConstraint;
    }

    /**
     * Retorna o padrão de dependencia que é esperado ao gerar um novo controller db.
     *
     * @return string $dependency String com os nomes dos componentes SRC que serão utilizados para gerar o controller.
     */
    public function getControllerDbDependency()
    {
        $dependency = "Factory\\{$this->entityName},Service\\{$this->entityName},SearchFactory\\{$this->entityName}";
        return $dependency;
    }

    /**
     * Cria a lista de ações padrões para utilizar nos controllers mvc.
     *
     * @return array $actions Conjunto de ações padrões para os controllers do mvc.
     */
    public function getControllerDbAction()
    {
        $role = 'admin';

        $dependency = $this->getControllerDbDependency();

        $actions = array(
            array('role' => $role, 'controller' => $this->controllerName, 'name' => 'create', 'db' => $this->db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $this->controllerName, 'name' => 'edit', 'db' => $this->db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $this->controllerName, 'name' => 'list', 'db' => $this->db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $this->controllerName, 'name' => 'delete', 'db' => $this->db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $this->controllerName, 'name' => 'view', 'db' => $this->db, 'dependency' => $dependency),
        );

        if ($this->hasImageDependency($this->db)) {
            $actions[***REMOVED*** = array('role' => $role, 'controller' => $this->controllerName, 'name' => 'upload-image', 'db' => $this->db, 'dependency' => $dependency);
        }

        return $actions;
    }

    /**
     * Cria a lista de ações determinadas por um Controller e adiciona a ele.
     *
     * @param Gear\ValueObject\Controller $controller Controller onde será adicionado as ações
     *
     * @return Gear\ValueObject\Controller $contorller Controller com as ações setadas.
     */
    public function generateControllerActionsForDb(Gear\ValueObject\Controller $controller)
    {

        $this->entityName = $controller->getDb()->getTable();
        $this->controllerName = $controller->getName();
        $this->db = $controller->getDb();

        $actions = $this->getControllerDbAction();

        foreach ($actions as $action) {
            $action = new \Gear\ValueObject\Action($action);
            $controller->addAction($action);
        }

        return $controller;
    }

    /**
     * Cria a lista de ações determinadas à um Controller pertencente ao DB e adiciona a ele.
     *
     * @param Gear\ValueObject\Db $db onde será criado o Controller e adicionado as ações
     *
     * @return Gear\ValueObject\Controller $contorller Controller criado a partir do com as ações setadas.
     */
    public function makeController($db)
    {
        $this->db = $db;
        $this->entityName = $db->getTable();

        $controllerName = sprintf('%sController', $this->entityName);


        $controllerService = '%s'.sprintf('\\Controller\\%s', $this->entityName);

        $controller = new \Gear\ValueObject\Controller(array(
            'name' => $controllerName,
            'object' => $controllerService
        ));

        $this->controllerName = $controller->getName();

        $actions = $this->getControllerDbAction();

        foreach ($actions as $action) {
            $action = new \Gear\ValueObject\Action($action);
            $controller->addAction($action);
        }

        return $controller;

    }

    public function makeSrc($db)
    {
        $srcToAdd = [***REMOVED***;


        $name = $db->getTable();

        $services = array(
            array('type' => 'Entity'),
            array('type' => 'Repository'),
            array('type' => 'Service', 'dependency' => 'Repository\\'.$name),
            array('type' => 'Form'),
            array('type' => 'Filter'),
            array('type' => 'Fixture'),
            array('type' => 'Factory', 'dependency' => 'Filter\\'.$name.',Form\\'.$name),
        );

        foreach ($services as $i => $v) {

            if ($v['type'***REMOVED*** == 'Entity') {
                $nameFinal = $name;
            } else {
                $nameFinal = sprintf('%s%s', $name, $v['type'***REMOVED***);
            }

            $toInsert = array_merge($v, array('name' => $nameFinal, 'db' => $db->getTable()));
            $srcTemp = new \Gear\ValueObject\Src($toInsert);
            $srcToAdd[***REMOVED*** = $srcTemp;
        }


        $searchFactory = array(
            'type' => 'SearchFactory',
            'db' => $db->getTable(),
            'name' => sprintf('%s%s', $name, 'SearchFactory')
        );

        $srcToAdd[***REMOVED*** = new \Gear\ValueObject\Src($searchFactory);

        $searchForm = array(
            'type' => 'SearchForm',
            'db' => $db->getTable(),
            'name' => sprintf('%s%s', $name, 'SearchForm')
        );
        $srcToAdd[***REMOVED*** = new \Gear\ValueObject\Src($searchForm);

        //adicionar factory de search.
        //adicionar form de search.

        return $srcToAdd;
    }

    public function appendDb(\Gear\ValueObject\Db $dbToInsert)
    {
        $imagemConstraint = $this->hasImageDependency($dbToInsert);

        $controllerToInsert = $this->makeController($dbToInsert);

        $srcToInsert = $this->makeSrc($dbToInsert);

        if ($this->checkSchemaAlreadySet($dbToInsert, $srcToInsert, $controllerToInsert)) {

            $db = $this->__extract('db');
            $db[***REMOVED*** = $dbToInsert->export();

            $controller = $this->__extract('controller');
            $controller[***REMOVED*** = $controllerToInsert->export();

            $src = $this->__extract('src');

            foreach ($srcToInsert as $srcToInsertRow) {
                $src[***REMOVED*** = $srcToInsertRow->export();
            }

            $schema = $this->decode($this->getJsonFromFile());
            $schema[$this->getModule()->getModuleName()***REMOVED***['db'***REMOVED*** = $db;
            $schema[$this->getModule()->getModuleName()***REMOVED***['controller'***REMOVED*** = $controller;
            $schema[$this->getModule()->getModuleName()***REMOVED***['src'***REMOVED*** = $src;

            return $this->persistSchema($schema);
        } else {
            return false;
        }
    }

    /**
     * Pesquisa na Metadata por tabela específica de upload de Imagem, lança Excepction se a tabela não existe.
     *
     * @param string $tableName Nome da Tabela de Imagem a ser pesquisa.
     *
     * @return Zend\Db\Metadata\Object\TableObject $imagem Objeto Metadata referente à tabela.
     */

    public function getImageTable($tableName = 'upload_image')
    {
        $metadata = $this->serviceLocator->get('Gear\Factory\Metadata');
        $imagem = null;
        try {
            $imagem = $metadata->getTable($tableName);

        } catch (\Exception $e) {

            throw new $e;
            //echo $e;
        }

        return $imagem;
    }

    public function getControllerByDb(\Gear\ValueObject\Db $db)
    {

        $controllers = $this->__extractObject('controller');

        foreach ($controllers as $controller) {
            if ($controller->getName() == $db->getTable().'Controller') {
                return $controller;
            }
            if ($controller->getName() == $db->getTable()) {
                return $controller;
            }
        }

        throw new \Exception(sprintf('Controller/action não encontrado para tabela %s', $db->getTable()));
    }

    public function getAllSrcByDb(\Gear\ValueObject\Db $db)
    {
        $srcs = $this->__extractObject('src');

        $stack = [***REMOVED***;

        foreach ($srcs as $src) {

            if ((null !== $src->getDb()) && $src->getDb()->getTable() == $db->getTable()) {
                $stack[***REMOVED*** = $src;
            }
        }
        return $stack;
    }

    public function getSrcByDb(\Gear\ValueObject\Db $db, $type)
    {

        $srcs = $this->__extractObject('src');

        foreach ($srcs as $src) {

            if ($src->getType() == $type && (null !== $src->getDb()) && $src->getDb()->getTable() == $db->getTable()) {
                return $src;
            }
        }
        throw new \Exception(sprintf('Src não encontrado para tabela %s', $db->getTable()));

    }

    /**
     *
     * @param unknown $schema
     */
    public function persistSchema($schema)
    {
        return file_put_contents($this->getJson(), $this->encode($schema));
    }



    public function insertDb(\Gear\ValueObject\Db $dbToInsert)
    {
        $dbs = $this->__extractObject('db');

        if (count($dbs) > 0) {
            foreach ($dbs as $i => $db) {
                $test = $db;
                if ($test->getTable() != $dbToInsert->getTable()) {
                    unset($test);
                } else {
                    break;
                }
            }
        }

        if (isset($test)) {
            $this->updateDb($dbToInsert);
        } else {
            $this->appendDb($dbToInsert);
        }

        return true;
    }

    /**
     * Extrair do Schema um array com objetos Gear de todos ítens de respectivo $type
     *
     * @param string $type Tipo [Src/Controller/DB***REMOVED*** que quer consultar no schema
     *
     * @return array $data Elementos [Src/Controller/Db***REMOVED*** que constam naquela chave do schema.
     */
    public function __extractObject($type)
    {
        $jsonArray = $this->__extract($type);

        $objects = [***REMOVED***;
        $class = sprintf('\Gear\ValueObject\%s', ucfirst($type));

        if (count($jsonArray) > 0) {
            foreach ($jsonArray as $i => $v) {
                $objects[***REMOVED*** = new $class($v);
            }
        }
        return $objects;
    }

    /**
     * Extrair do Schema um array com todos ítens de respectivo $type
     *
     * @param string $type Tipo [Src/Controller/DB***REMOVED*** que quer consultar no schema
     *
     * @return array $data Elementos que constam naquela chave do schema.
     */
    public function __extract($type)
    {
        $json = $this->getJsonFromFile();
        $json = $this->decode($json);
        $data = $json[$this->getModule()->getModuleName()***REMOVED***[$type***REMOVED***;
        return $data;
    }

    public function overwrite($toOverwrite)
    {

        if ($toOverwrite instanceof \Gear\ValueObject\Controller) {
            $this->replaceController($toOverwrite);
            return true;
        }

    }

    public function replaceWithOverwrite($serviceName, $object, $place)
    {
        $decode = $this->decode($this->getJsonFromFile());
        $decode[$this->getModule()->getModuleName()***REMOVED***[$serviceName***REMOVED***[$place***REMOVED*** = $object->export();
        $this->setFileFromJson($this->encode($decode));
    }

    public function replaceController(\Gear\ValueObject\Controller $controller)
    {
        $controllers = $this->__extract('controller');
        foreach ($controllers as $i => $controllerArray) {
            $controllerToReplace = new \Gear\ValueObject\Controller($controllerArray);
            if ($controllerToReplace->getName() == $controller->getName()) {

                $this->replaceWithOverwrite('controller', $controller, $i);

                break;
            }
        }
    }


    public function getControllerByName($controllerName)
    {
        $controllers = $this->__extract('controller');

        foreach ($controllers as $controllerArray) {
            $controller = new \Gear\ValueObject\Controller($controllerArray);
            if ($controller->getName() == $controllerName) {
                break;
            } else {
                unset($controller);
            }
        }
        return (isset($controller)) ? $controller : null;
    }

    /**
     * Lê do disco o arquivo e transforma em texto.
     *
     * @return string $json
     */
    public function getJsonFromFile()
    {
        $json = file_get_contents($this->getJson());
        return $json;
    }

    /**
     * Salva o texto no arquivo.
     *
     * @param string $json Schema bem formado.
     * @return number $data Resultado
     */
    public function setFileFromJson($json)
    {
        $data = file_put_contents($this->getJson(), $json);
        return $data;
    }

    public function insertSrc($singleJson)
    {
        return $this->insertController($this->decode($this->getJsonFromFile()), $singleJson, 'src');
    }

    public function addController($controller)
    {
        $json = \Zend\Json\Json::decode($this->getJsonFromFile(), 1);
        return $this->insertController($json, $controller, 'controller');
    }

    public function insertController($json, $singleJson, $context = 'controller')
    {

        $module = $this->getModule()->getModuleName();

        $controllers = $json[$this->getModule()->getModuleName()***REMOVED***[$context***REMOVED***;

        if (!is_array($controllers)) {
            throw new \Gear\Exception\JsonMalformedException();
        }

        $update = false;

        if (count($controllers) > 0) {
            foreach ($controllers as $i => $v) {
                if ($v['name'***REMOVED*** == $singleJson['name'***REMOVED***) {

                    if (isset($singleJson['type'***REMOVED***)) {
                        if ($v['type'***REMOVED*** == $singleJson['type'***REMOVED***) {
                            $update = $i;
                            break;
                        } else {
                            continue;
                        }
                    } else {
                        $update = $i;
                        break;
                    }
                }
            }
        }


        if (!$update) {
            $newController = array_merge($controllers, array($singleJson));
            $json[$this->getModule()->getModuleName()***REMOVED***[$context***REMOVED*** = $newController;
        } else {
            //do update stuff
        }


        $this->setFileFromJson($this->encode($json));

        return $json;
    }

    /**
     * Mostra o local onde o Json está armazenado respeitando a Estrutura do Módulo e o Nome do Schema.
     *
     * @return string $path Localização do arquivo schema.json no sistema de arquivos.
     */
    public function getJson()
    {
        $path = $this->getModule()->getMainFolder() . '/'.$this->getName();
        return $path;
    }

    /**
     * Recebe um Array PHP e Transforma em JSON com PrettyPrint
     *
     * @param array $json Array PHP que será transformado em JSON
     *
     * @return string $encode JSON resultante do Array PHP com PrettyPrint.
     */
    public function encode($json)
    {
        $encode = \Zend\Json\Json::prettyPrint(\Zend\Json\Json::encode($json, 1));
        return $encode;
    }

    /**
     * Recebe uma String no formato JSON e transforma em PHP Array.
     *
     * @param string $json JSON que será transformado em array
     *
     * @return array $decode Array resultado do JSON.
     */
    public function decode($json)
    {
        $decode = \Zend\Json\Json::decode($json, 1);
        return $decode;
    }

    /**
     * Função que cria o arquivo json com as informações iniciais e salva no disco.
     *
     * @return boolean Verdadeiro se conseguiu criar, falso se teve problemas.
     */
    public function registerJson()
    {
        $arrayToJson = $this->createNewModuleJson();

        $json = \Zend\Json\Json::encode($arrayToJson);

        $json = \Zend\Json\Json::prettyPrint($json);

        $file = $this->writeJson($json);

        if ($file) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Cria a estrutura zero para novos módulos
     *
     * @return $json Estrutra zero para novos módulos
     */
    public function createNewModuleJson()
    {
        $index = $this->getControllerZero(array($this->getActionZero()));

        $json = array(
            $this->getModule()->getModuleName() => array(
                'src' => array(),
                'controller' => array(
                    $index
                ),
                'db' => array()
            )
        );

        return $json;
    }

    /**
     * Recebe Json e grava em disco
     *
     * @param string $json Json formatado que será inserido no arquivo
     *
     * @return bool $mkJson Resultado da criação
     */
    public function writeJson($json)
    {
        $mkJson = $this->getFileService()->mkJson(
            $this->getModule()->getSchemaFolder(),
            'module',
            $json
        );
        return $mkJson;
    }

    /**
     * Imprime na tela o schema do módulo atual
     *
     * @param string $type Tipo de output esperado.
     *
     * @return mixed|string Schema formatado para exibir.
     */
    public function dump($type = 'array')
    {
        $file = $this->getJson();

        if ($type == 'array') {
            return print_r(\Zend\Json\Json::decode(file_get_contents($file)), true);
        } elseif ($type == 'json') {
            $json = file_get_contents($file);
            return \Zend\Json\Json::prettyPrint($json, array("indent" => "    "));
        } else {
            return '0';
        }
    }

    /**
     * Retorna a ação Index para novos controlleres.
     *
     * @return array $action Ação Index
     */
    public function getActionZero()
    {
        $action = array(
            'name' => 'index',
            'route' => 'index',
            'role' => 'guest'
        );
        return $action;
    }

    /**
     * Cria ação IndexController para novos schemas.
     *
     * @param array $actions Ações que serão adicionadas ao IndexController
     *
     * @return array $controller IndexController que será inserido no novo schema.
     */
    public function getControllerZero($actions = array())
    {
        $controller = array(
            'name' => 'IndexController',
            'object' => '%s\Controller\Index',
            'actions' => $actions
        );
        return $controller;
    }



    public function getAdapter()
    {
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }
    /**
     * Retorna o nome do Schema.
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Seta a estrutura do módulo que será utilizada.
     *
     * @param \Gear\ValueObject\BasicModuleStructure $module Estrutura Modular que será utilizada.
     *
     * @return \Gear\Schema
     */
    public function setModule(\Gear\ValueObject\BasicModuleStructure $module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     * Retorna o nome do Schema.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Seta o nome para buscar o schema.
     *
     * @param string $name Local onde está localizado o schema do módulo.
     *
     * @return \Gear\Schema
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Retorna ServiceManager.
     *
     * @return Zend\ServiceManager\ServiceManager
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Adiciona ServiceManager.
     *
     * @param Zend\ServiceManager\ServiceManager $serviceLocator ServiceManager.
     *
     * @return \Gear\Schema
     */
    public function setServiceLocator(Zend\ServiceManager\ServiceManager $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
}
