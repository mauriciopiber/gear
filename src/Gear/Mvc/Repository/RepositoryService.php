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
use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;

class RepositoryService extends AbstractJsonService
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

        $this->createDb();
    }

    public function createDb()
    {
        $this->table   = $this->db->getTableObject();
        $this->specialites = $this->db->getColumns();

        $this->useImageService();
        $this->calculateAliasesStack();
        $this->setUp();

        $this->getRepositoryTestService()->introspectFromTable($this->db);
        $this->createTrait($this->src, $this->getModule()->getRepositoryFolder());


        $template = $this->createFileFromTemplate(
            $this->template,
            array(
                'specialityFields' => $this->specialites,
                'baseClass' => $this->str('class', $this->table->getName()),
                'baseClassCut' => $this->cut($this->str('class', $this->table->getName())),
                'class'   => $this->className,
                'module'  => $this->getModule()->getModuleName(),
                'aliase'  => $this->mainAliase,
                'map' => $this->getMap()
            ),
            $this->fileName,
            $this->getModule()->getRepositoryFolder()
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
        $this->dependency = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());

        $this->uses = $this->dependency->getUseNamespace(false);
        $this->attributes = $this->dependency->getUseAttribute(false);
        //verifica se a classe extends existe ou não tem extends.
        $this->extends = null;

        if ($this->src->getExtends() !== null) {
            $extendsItem = explode('\\', $this->src->getExtends());
            $this->uses .= 'use '.implode('\\', $extendsItem).';'.PHP_EOL;
            $this->extends = end($extendsItem);
        }

        //$this->getAbstract();
        $this->getRepositoryTestService()->createFromSrc($this->src);
        $this->createTrait($this->src, $this->getModule()->getRepositoryFolder());

        return $this->createFileFromTemplate(
            'template/src/repository/src.repository.phtml',
            array(
                'class'   => $this->className,
                'extends' => $this->extends,
                'uses'    => $this->uses,
                'attributes' => $this->attributes,
                'module'  => $this->getModule()->getModuleName(),
            ),
            $this->className.'.php',
            $this->getModule()->getRepositoryFolder()
        );
    }

    public function setUp()
    {

        if ($this->src == null) {
            $this->className = $this->str('class', $this->table->getName()).'Repository';
            $this->fileName  = $this->str('class', $this->table->getName()).'Repository.php';
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

    $this->createFileFromTemplate(
        'template/src/repository/abstract.phtml',
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

    return $this->createFileFromTemplate(
        'template/src/repository/abstract.phtml',
        array(
            'module' => $this->getModule()->getModuleName(),
            'className' => $this->className
        ),
        $this->className.'.php',
        $this->getModule()->getRepositoryFolder()
    );
    }
    */

    public function useImageService()
    {
        $this->template = 'template/src/repository/db.repository.phtml';
    }

    public function calculateAliasesStack()
    {
        $this->aliasesStack = [***REMOVED***;

        $callable = function ($a, $b) {
            return $a. substr($b, 0, 1);
        };

        $this->mainAliase = array_reduce(explode('_', $this->table->getName()), $callable);

        if (!in_array($this->mainAliase, $this->aliasesStack)) {
            $this->aliasesStack[***REMOVED*** = $this->mainAliase;
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
        return $mappingService->getRepositoryMapping()->toString();
    }
}
