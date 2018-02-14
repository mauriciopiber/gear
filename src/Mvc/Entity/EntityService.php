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
namespace Gear\Mvc\Entity;

use Gear\Mvc\AbstractMvc;
use Zend\Db\Metadata\Object\TableObject;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Schema\SchemaService;
use GearJson\Src\SrcSchemaTrait;
use GearJson\Src\SrcSchema;
use Gear\Exception\InvalidArgumentException;
use Gear\Script\ScriptServiceTrait;
use Gear\Script\ScriptService;
use Gear\Table\TableService\TableService;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Mvc\Entity\EntityTestServiceTrait;
use Gear\Mvc\Entity\EntityTestService;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Mvc\Config\ServiceManager;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use Gear\Module\BasicModuleStructure;
use GearBase\Util\Dir\DirService;
use GearBase\Util\Dir\DirServiceTrait;
use GearJson\Db\Db;
use Gear\Util\Glob\GlobServiceTrait;
use Gear\Util\Glob\GlobService;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerTrait;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer;
use Gear\Mvc\Entity\DoctrineServiceTrait;
use Gear\Table\UploadImage as UploadImageTable;
use GearJson\Src\SrcTypesInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use GearBase\Util\String\StringService;
use GearBase\Util\String\StringServiceTrait;

class EntityService extends AbstractMvc
{
    use ModuleAwareTrait;
    use SrcSchemaTrait;
    use SchemaServiceTrait;
    use ScriptServiceTrait;
    use EntityTestServiceTrait;
    use ServiceManagerTrait;
    use DirServiceTrait;
    use GlobServiceTrait;
    use EntityObjectFixerTrait;
    use DoctrineServiceTrait;
    use StringServiceTrait;

    protected $doctrineService;

    protected $tableName;

      /**
     * @var EventManagerInterface
     */
    protected $event = null;

    public function __construct(
        BasicModuleStructure $module,
        DoctrineService $doctrine,
        ScriptService $script,
        EntityTestService $entityTest,
        TableService $table,
        SrcSchema $srcService,
        ServiceManager $serviceManager,
        SchemaService $schema,
        DirService $dirService,
        GlobService $globService,
        EntityObjectFixer $entityObjectFixer,
        StringService $stringService
    ) {
        $this->stringService = $stringService;
        $this->module = $module;
        $this->doctrineService = $doctrine;
        $this->scriptService = $script;
        $this->entityTestService = $entityTest;
        $this->tableService = $table;
        $this->srcSchema = $srcService;
        $this->serviceManager = $serviceManager;
        $this->schemaService = $schema;
        $this->dirService = $dirService;
        $this->globService = $globService;
        $this->entityObjectFixer = $entityObjectFixer;
    }

    public function createEntities(array $srcs)
    {
        $this->runDoctrine();
        $this->runReduce();

        foreach ($srcs as $src) {
            $this->getEntityTestService()->createEntityTest($src);
        }

        return true;
    }

    /**
     * @critic
     *
     * @return boolean
     */
    public function fixEntities()
    {
        $entityFolder = $this->getModule()->getEntityFolder();

        $files = $this->getGlobService()->list($entityFolder.'/*');

        if (empty($files)) {
            return true;
        }

        $this->getEntityObjectFixer()->fixEntities($this->getModule()->getModuleName(), $files);
    }

    public function createEntity($data)
    {
        return parent::forceDb($data, SrcTypesInterface::ENTITY);
    }

    /*
    public function createEntity($src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null && $this->src->getDb()->getTableObject() instanceof TableObject) {
            $this->tableName = $src->getDb()->getTable();
            $this->setUpEntity(array('tables' => $this->tableName));
            $this->getEntityTestService()->create($this->src);
            $this->fixEntities();
            return true;
        }
    }
    */

    public function createEntityObject($src)
    {
        $this->getEntityTestService()->createEntityTest($this->db);

        if ($this->getTableService()->verifyTableAssociation(
            $this->str('class', $this->db->getTable()),
            UploadImageTable::NAME
        )
            && !is_file($this->getModule()->getEntityFolder().'/UploadImage.php')
        ) {
            //$uploadImage = $this->getTableService()->getTableObject(UploadImageTable::NAME);

            /*
           @TODO descomentar
            $src = $this->getSrcSchema()->create(
                $this->getModule()->getModuleName(),
                [
                    'name' => 'UploadImage',
                    'type' => 'Entity',
                    'db' => 'UploadImage',
                    'service' => 'invokables'
                ***REMOVED***
            );

            //$src->getDb()->setTable('UploadImage');
            //$src->getDb()->setTableObject($uploadImage);
            $this->createEntities([$src***REMOVED***);
            */
            //$this->getServiceManager()->create($src);
        }
    }

    public function runDoctrine()
    {
        $doctrineService = $this->getDoctrineService();
        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $this->moveEntity();
        $scriptService->run($doctrineService->getOrmGenerateEntities());
        $this->moveEntity();
    }

    /**
     * Limpa os namespaces restantes
     */
    public function excludeNamespaces()
    {
        $file = $this->getModule()->getMainFolder().'/config/application.config.php';

        if (!is_file($file)) {
            throw new \Exception(sprintf('Missing File Exception %s', $file));
        }

        $config = require $file;

        if (empty($config['modules'***REMOVED***)) {
            throw new \Exception('Missing loaded modules');
        }

        foreach($config['modules'***REMOVED*** as $moduleName) {
            if (
                is_dir($this->getModule()->getSrcFolder().'/'.$moduleName)
                && $moduleName !== $this->getModule()->getModuleName()
            ) {
                $this->getDirService()->rmDir($this->getModule()->getSrcFolder().'/'.$moduleName);
            }
        }

        return true;
    }

    /**
     * Limpa os mapping restantes
     */
    public function excludeMapping()
    {
        $names = $this->getNames();

        $entity = $this->getModule()->getSrcFolder();

        $fakeFolder = sprintf('%s/%s', $entity, $this->getModule()->getModuleName());

        $this->getDirService()->rmDir($fakeFolder);
    }

    /**
     * Move a entidade de PSR-0 para PSR-4
     */
    public function moveEntity()
    {
        $template = 'mv %s/%s/Entity/* %s/';
        $cmd = sprintf(
            $template,
            $this->getModule()->getSrcFolder(),
            $this->getResolveModule(),
            $this->getModule()->getEntityFolder()
        );


        $this->getScriptService()->run($cmd);
    }


    public function runReduce()
    {
        $this->excludeNamespaces();
        $this->excludeMapping();
        //$this->moveEntity();
        $this->fixEntities();
    }

    public function createDb()
    {
        $this->runDoctrine();
        $this->runReduce();

        $this->createEntityObject($this->src);

        return true;
    }

    public function getNames()
    {

        $dbs = $this->getSchemaService()->__extractObject('db');

        $names = [***REMOVED***;

        if (is_array($dbs) && count($dbs) > 0) {
            foreach ($dbs as $table) {
                $names[***REMOVED*** = $table->getTable();
            }
        }

        $srcs = $this->getSchemaService()->__extractObject('src');

        if (is_array($srcs) === false || count($srcs) <= 1) {
            return $names;
        }

        foreach ($srcs as $src) {
            if ($src->getType() == 'Entity') {
                $names[***REMOVED*** = $src->getName();
            }
        }

        return $names;
    }
}
