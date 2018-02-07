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
use GearJson\Src\SrcTypesInterface;
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

    public function createRepository($data)
    {
        return parent::create($data, SrcTypesInterface::REPOSITORY);
    }

    public function createDb()
    {
        $this->table   = $this->db->getTableObject();
        $this->columnManager = $this->db->getColumnManager();

        $this->template = 'template/module/mvc/repository/db/repository.phtml';
        $this->calculateAliasesStack();
        $this->setUp();

        $this->entityName = sprintf(
            '%s\Entity\%s',
            $this->getModule()->getModuleName(),
            $this->str('class', $this->db->getTable())
        );

        $location = $this->getCode()->getLocation($this->src);

        $this->getRepositoryTestService()->createRepositoryTest($this->db);

        $this->getTraitService()->createTrait($this->src);
        $this->getFactoryService()->createFactory($this->src);

        $options = [
            'use' => ($this->src->isFactory()) ? $this->getCode()->getUseConstructor($this->src) : '',
            'package' => $this->getCode()->getClassDocsPackage($this->src),
            'namespace' => $this->getCode()->getNamespace($this->src),
            'baseClass' => $this->str('class', $this->db->getTable()),
            'tableIdVar' => $this->str('var-length', 'id_'.$this->db->getTable()),
            'tableId' => $this->str('var', 'id_'.$this->db->getTable()),
            'class'   => $this->className,
            'module'  => $this->getModule()->getModuleName(),
            'aliase'  => $this->mainAliase,
            'map' => $this->getMap(),
            'updateBefore' => '',
            'insertBefore' => '',
            'package' => $this->getCode()->getClassDocsPackage($this->src),
            'entity' => $this->entityName,
            'tableLabel' => $this->str('label', $this->db->getTable()),
        ***REMOVED***;

        $options['insertBefore'***REMOVED*** = $this->columnManager->generateCode('getRepositoryInsertBefore', [***REMOVED***);
        $options['updateBefore'***REMOVED*** = $this->columnManager->generateCode('getRepositoryUpdateBefore', [***REMOVED***);
        $options['constructor'***REMOVED*** = $this->getCode()->getConstructor($this->src);

        $template = $this->getFileCreator()->createFile(
            $this->template,
            $options,
            $this->fileName,
            $location
        );


        return $template;
    }

    public function createSrc()
    {
        $location = $this->getCode()->getLocation($this->src);

        //$this->getAbstract();
        $this->getRepositoryTestService()->createRepositoryTest($this->src);

        if ($this->src->getAbstract() == false) {
            $this->getTraitService()->createTrait($this->src);
        }

        if ($this->src->isFactory() && $this->src->getAbstract() == false) {
            $this->getFactoryService()->createFactory($this->src);
        }

        $options = [
            'class'      => $this->src->getName(),
            'implements' => $this->getCode()->getImplements($this->src),
            'module'     => $this->getModule()->getModuleName(),
            'namespace'  => $this->getCode()->getNamespace($this->src),
            'extends'    => $this->getCode()->getExtends($this->src),
            'uses'       => $this->getCode()->getUse($this->src),
            'attributes' => $this->getCode()->getUseAttribute($this->src),
            'classDocs'  => $this->getCode()->getClassDocs($this->src)
        ***REMOVED***;

        $options['constructor'***REMOVED*** = ($this->src->isFactory())
          ? $this->getCode()->getConstructor($this->src)
          : '';

        $template = ($this->src->getAbstract() == true) ? 'abstract.phtml' : 'repository.phtml';


        $file = $this->getFileCreator()->createFile(
            'template/module/mvc/repository/src/'.$template,
            $options,
            $this->src->getName().'.php',
            $location
        );

        return $file;
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
            $this->mappingService = $this->getServiceLocator()->get('Gear\Mvc\Repository\MappingService');
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