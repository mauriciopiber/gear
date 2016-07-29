<?php
/**
 *
 * @author piber
 * Um serviço é o ítem mais importante do DDD.
 * Um serviço precisa ser testado com TDD.
 * Um serviço não possui interface então não precisa ser testado com codeception.
 * Um serviço pode extender outro serviço.
 * Um serviço precisa ser adicionado ao invokables do Module.php ao final do processo.
 *
 */
namespace Gear\Mvc\Repository;

use GearJson\Src\Src;
use GearJson\Db\Db;
use Gear\Mvc\AbstractMvc;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Repository\ColumnInterface\RepositoryInsertBeforeInterface;
use Gear\Mvc\Repository\ColumnInterface\RepositoryUpdateBeforeInterface;

class RepositoryService extends AbstractMvc
{
    use SchemaServiceTrait;
    use \Gear\Mvc\Repository\RepositoryTestServiceTrait;

    protected $src;

    protected $mappingService;

    protected $columns;

    protected $db;

    protected $template;

    protected $table;

    protected $className;

    protected $fileName;

    protected $customAbstract = false;


    public function introspectFromTable(Db $db)
    {
        $this->db = $db;
        $this->className = $this->db->getTable();
        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'Repository');

        return $this->createDb();
    }

    public function createDb()
    {
        $this->table   = $this->db->getTableObject();
        $this->specialites = $this->db->getColumns();

        $this->template = 'template/module/mvc/repository/db.repository.phtml';
        $this->calculateAliasesStack();
        $this->setUp();

        $this->getRepositoryTestService()->introspectFromTable($this->db);
        $this->getTraitService()->createTrait($this->src, $this->getModule()->getRepositoryFolder());

        $location = $this->getModule()->getRepositoryFolder();

        if ($this->src->getService() == static::$factories) {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $options = [
            'specialityFields' => $this->specialites,
            'baseClass' => $this->str('class', $this->db->getTable()),
            'baseClassCut' => $this->str('var-lenght', $this->db->getTable()),
            'class'   => $this->className,
            'module'  => $this->getModule()->getModuleName(),
            'aliase'  => $this->mainAliase,
            'map' => $this->getMap(),
            'updateBefore' => '',
            'insertBefore' => ''
        ***REMOVED***;

        foreach ($this->getColumnService()->getColumns($this->db) as $column) {

            if ($column instanceof RepositoryInsertBeforeInterface) {
                $options['insertBefore'***REMOVED*** .= $column->getRepositoryInsertBefore();
            }

            if ($column instanceof RepositoryUpdateBeforeInterface) {
                $options['updateBefore'***REMOVED*** .= $column->getRepositoryUpdateBefore();
            }

        }

        $template = $this->getFileCreator()->createFile(
            $this->template,
            $options,
            $this->fileName,
            $location
        );


        return $template;
    }

    public function create(Src $src)
    {
        $this->src = $src;
        $this->className = $this->src->getName();

        if ($this->src->getAbstract() === true) {
            return $this->getAbstractFromSrc();
        }

        if (null != $this->src->getDb() && $this->src->getDb() instanceof \GearJson\Db\Db) {
            $this->db = $this->src->getDb();

            if (is_string($this->db->getColumns())) {
                $this->db->setColumns(\Zend\Json\Json::decode($this->db->getColumns()));
            }

            $this->getEventManager()->trigger('createInstance', $this, array('instance' => $this->db));
            return $this->createDb();
        }
        return $this->createSrc();
    }

    public function createSrc()
    {
        $location = $this->getCode()->getLocation($this->src);

        //$this->getAbstract();
        $this->getRepositoryTestService()->createFromSrc($this->src);
        $this->getTraitService()->createTrait($this->src, $location);

        if ($this->src->getService() == 'factories') {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        return $this->getFileCreator()->createFile(
            'template/module/mvc/repository/src.repository.phtml',
            array(
                'namespace' => $this->getCode()->getNamespace($this->src),
                'class'   => $this->className,
                'extends'    => $this->getCode()->getExtends($this->src),
                'uses'       => $this->getCode()->getUse($this->src),
                'attributes' => $this->getCode()->getUseAttribute($this->src),
                'module'  => $this->getModule()->getModuleName(),
            ),
            $this->className.'.php',
            $location
        );
    }

    public function setUp()
    {

        if ($this->src == null) {
            $this->className = $this->str('class', $this->db->getTable()).'Repository';
            $this->fileName  = $this->str('class', $this->db->getTable()).'Repository.php';
        }

        if ($this->src instanceof \GearJson\Src\Src) {
            $this->className = $this->src->getName();
            $this->fileName = $this->src->getName().'.php';
        }
    }

    /*
     public function hasAbstract()
     {
    if (is_file($this->getModule()->getRepositoryFolder().'/'.$this->classNameAbstract.'.php')) {
    return true;
    } else {
    return false;
    }
    }

    public function getAbstract()
    {
    if (empty($this->src)) {
    $this->classNameAbstract = 'AbstractRepository';
    } else {
    $this->classNameAbstract = $this->src->getName();
    }

    if (!$this->hasAbstract()) {

    $this->getRepositoryTestService()->createAbstract($this->classNameAbstract);

    $this->getFileCreator()->createFile(
        'template/module/mvc/repository/abstract.phtml',
        array(
            'module' => $this->getModule()->getModuleName(),
            'className' => $this->classNameAbstract
        ),
        $this->classNameAbstract.'.php',
        $this->getModule()->getRepositoryFolder()
    );
    }
    }

    public function getAbstractFromSrc()
    {

    $this->getRepositoryTestService()->createAbstract($this->className);

    return $this->getFileCreator()->createFile(
        'template/module/mvc/repository/abstract.phtml',
        array(
            'module' => $this->getModule()->getModuleName(),
            'className' => $this->className
        ),
        $this->className.'.php',
        $this->getModule()->getRepositoryFolder()
    );
    }
    */


    public function calculateAliasesStack()
    {
        $this->aliasesStack = [***REMOVED***;

        $callable = function ($start, $end) {
            return $start. substr($end, 0, 1);
        };

        $this->mainAliase = strtolower(array_reduce(explode('_', $this->db->getTable()), $callable));

        if (!in_array($this->mainAliase, $this->aliasesStack)) {
            $this->aliasesStack[***REMOVED*** = strtolower($this->mainAliase);
        }
    }

    public function setMappingService($mappingService)
    {
        $this->mappingService = $mappingService;
        return $this;
    }

    public function getMappingService()
    {
        if (!isset($this->mappingService)) {
            $this->mappingService = $this->getServiceLocator()->get('RepositoryService\MappingService');
        }

        return $this->mappingService;
    }

    public function getMap()
    {
        $mappingService = $this->getMappingService();
        $mappingService->setAliaseStack($this->aliasesStack);
        return $mappingService->getRepositoryMapping($this->db)->toString();
    }
}
