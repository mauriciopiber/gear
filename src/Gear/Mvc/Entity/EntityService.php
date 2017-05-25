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

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Object\TableObject;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Schema\SchemaService;
use GearJson\Src\SrcServiceTrait;
use GearJson\Src\SrcService;
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

class EntityService extends AbstractJsonService
{
    use ModuleAwareTrait;
    use SrcServiceTrait;
    use SchemaServiceTrait;
    use ScriptServiceTrait;
    use EntityTestServiceTrait;
    use ServiceManagerTrait;
    use DirServiceTrait;
    use GlobServiceTrait;
    use EntityObjectFixerTrait;
    use DoctrineServiceTrait;

    protected $doctrineService;

    protected $tableName;



    public function __construct(
        BasicModuleStructure $module,
        DoctrineService $doctrine,
        ScriptService $script,
        EntityTestService $entityTest,
        TableService $table,
        SrcService $srcService,
        ServiceManager $serviceManager,
        SchemaService $schema,
        DirService $dirService,
        GlobService $globService,
        EntityObjectFixer $entityObjectFixer
    ) {
        $this->module = $module;
        $this->doctrineService = $doctrine;
        $this->scriptService = $script;
        $this->entityTestService = $entityTest;
        $this->tableService = $table;
        $this->srcService = $srcService;
        $this->serviceManager = $serviceManager;
        $this->schemaService = $schema;
        $this->dirService = $dirService;
        $this->globService = $globService;
        $this->entityObjectFixer = $entityObjectFixer;
    }

    public function createEntities(array $srcs)
    {
        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();
        $this->excludeEntities();

        $this->fixEntities();

        foreach ($srcs as $src) {
            $this->getEntityTestService()->create($src);
        }

        return true;
    }

    public function fixEntities()
    {
        $entityFolder = $this->getModule()->getEntityFolder();

        $files = $this->getGlobService()->list($entityFolder.'/*');

        $this->getEntityObjectFixer()->fixEntities($this->getModule()->getModuleName(), $files);
    }

    public function create($src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null && $this->src->getDb()->getTableObject() instanceof TableObject) {
            $this->tableName = $src->getDb()->getTable();
            $this->setUpEntity(array('tables' => $this->tableName));
            $this->getEntityTestService()->create($this->src);
            $this->fixEntities();
            return true;
        }


        throw new InvalidArgumentException('Src for Entity need a valid --db=');
    }


    public function introspectFromTable(Db $dbTable)
    {
        $this->db           = $dbTable;

        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();
        $this->excludeEntities();

        $this->fixEntities();

        $this->getEntityTestService()->introspectFromTable($this->db);

        if ($this->getTableService()->verifyTableAssociation(
            $this->str('class', $this->db->getTable()),
            'upload_image'
        )
            && !is_file($this->getModule()->getEntityFolder().'/UploadImage.php')
        ) {
            $uploadImage = $this->getTableService()->getTableObject('upload_image');

            $src = $this->getSrcService()->create(
                $this->getModule()->getModuleName(),
                'UploadImage',
                'Entity',
                null,
                null,
                null,
                'invokables',
                null,
                'UploadImage'
            );

            $src->getDb()->setTable('UploadImage');
            $src->getDb()->setTableObject($uploadImage);
            $this->createEntities([$src***REMOVED***);
            $this->getServiceManager()->create($src);
        }

        return true;
    }

    public function getNames()
    {

        $dbs = $this->getSchemaService()->__extractObject('db');

        $names = [***REMOVED***;

        if (count($dbs) > 0) {
            foreach ($dbs as $table) {
                $names[***REMOVED*** = $table->getTable();
            }
        }

        $srcs = $this->getSchemaService()->__extractObject('src');

        foreach ($srcs as $src) {
            if ($src->getType() == 'Entity') {
                $names[***REMOVED*** = $src->getName();
            }
        }



        return $names;
    }

    /**
     * Exclude mapping created for others namespaces.
     */
    public function excludeMapping()
    {
        $ymlFiles = $this->getModule()->getSrcFolder();

        //echo $ymlFiles.'/*'."\n";die();
        $list = $this->getGlobService()->list($ymlFiles.'/*');

        foreach ($list as $v) {
            $entity = explode('/', $v);
            if (end($entity)!==$this->getModule()->getModuleName()) {
                 $this->getDirService()->rmDir($v);
            }
        }

        return true;
    }

    /**
     * Exclude entities creaded from Database but that isn't part of Gear.
     * @param array $names
     */
    public function excludeEntities($names = array())
    {
        $names = array_merge($this->getNames(), $names);

        $entitys = $this->getModule()->getEntityFolder();


        $list = $this->getGlobService()->list($entitys.'/*.php');

        foreach ($list as $entityFullPath) {
            $entity = explode('/', $entityFullPath);
            $name = explode('.', end($entity));

            if (!in_array($name[0***REMOVED***, $names)) {
                unlink($entityFullPath);
                if (is_file($entityFullPath.'~')) {
                    unlink($entityFullPath.'~');
                }
            } else {
                if (is_file($entityFullPath.'~')) {
                    unlink($entityFullPath.'~');
                }
            }
        }

        return true;
    }
}
