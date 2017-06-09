<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\Service\ServiceTestServiceTrait;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Service\ColumnInterface\ServiceCreateBeforeInterface;
use Gear\Mvc\Service\ColumnInterface\ServiceUpdateBeforeInterface;
use Gear\Mvc\Service\ColumnInterface\ServiceCreateAfterInterface;
use Gear\Mvc\Service\ColumnInterface\ServiceUpdateAfterInterface;
use Gear\Mvc\Service\ColumnInterface\ServiceDeleteInterface;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Db\Db;
use Gear\Column\Varchar\UploadImage as UploadImageColumn;

class ServiceService extends AbstractMvc
{
    use SchemaServiceTrait;
    use ServiceTestServiceTrait;
    use ServiceManagerTrait;

    static protected $defaultNamespace = 'Service';

    static protected $defaultFolder = null;

    public $name;

    public function create($src)
    {
        $this->src = $src;
        $this->className = $this->src->getName();

        if ($this->src->getDb() !== null) {
            $this->db        = $this->src->getDb();
            $this->tableName = $this->db->getTable();
            $this->name      = $this->str('class', str_replace($this->src->getType(), '', $this->className));
            return $this->createDb();
        }

        return $this->createSrc();
    }

    public function createSrc()
    {
        $location = $this->getCode()->getLocation($this->src);

        $template = 'template/module/mvc/service/src/src.phtml';
        $fileName = $this->className.'.php';
        $location = $location;
        $options = [
            'implements' => $this->getCode()->getImplements($this->src),
            'classDocs'  => $this->getCode()->getClassDocs($this->src),
            'extends'    => $this->getCode()->getExtends($this->src),
            'uses'       => $this->getCode()->getUse($this->src),
            'attributes' => $this->getCode()->getUseAttribute($this->src),
            'namespace'  => $this->getCode()->getNamespace($this->src),
            'module'     => $this->getModule()->getModuleName(),
            'abstract'   => $this->src->getAbstract(),
            'class'      => $this->className,
        ***REMOVED***;

        $options['constructor'***REMOVED*** = ($this->src->getService() == 'factories')
          ? $this->getCode()->getConstructor($this->src)
          : '';


        $this->getServiceTestService()->create($this->src);
        if ($this->src->getAbstract() !== true) {
            $this->getTraitService()->createTrait($this->src, $location);
        }

        if ($this->src->getService() == 'factories' && $this->src->getAbstract() !== true) {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $this->srcFile = $this->getFileCreator();
        return $this->srcFile->createFile($template, $options, $fileName, $location);
    }


    public function createDb()
    {

        if ($this->src->getService() == 'factories' && !array_key_exists('memcached', $this->src->getDependency())) {
            $dependency = $this->src->getDependency();
            $dependency['memcached'***REMOVED*** = '\Zend\Cache\Storage\Adapter\Memcached';
            $this->src->setDependency($dependency);
        }

        if ($this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
            || $this->getColumnService()->verifyColumnAssociation($this->db, UploadImageColumn::class)
        ) {
            $dep = $this->src->getDependency();
            $dep[***REMOVED*** = '\GearImage\Service\ImageService';
            $this->src->setDependency($dep);
        }


        $location = $this->getCode()->getLocation($this->src);

        $this->getTraitService()->createTrait($this->src, $location);

        $this->file = $this->getFileCreator();

        $this->specialities = $this->db->getColumns();
        $this->use        = '';
        $this->attribute  = '';
        $this->create     = ['',''***REMOVED***;
        $this->update     = ['',''***REMOVED***;
        $this->delete     = [''***REMOVED***;
        $this->selectAll  = '';
        $this->functions  = '';
        $this->repository = str_replace($this->src->getType(), '', $this->src->getName()).'Repository';

        $this->repositoryFullname = $this->getServiceManager()
            ->getServiceName($this->getSchemaService()->getSrcByDb($this->db, 'Repository'));

        $this->entityName = sprintf(
            '%s\Entity\%s',
            $this->getModule()->getModuleName(),
            $this->str('class', $this->db->getTable())
        );

        $this->entityFile = $this->str('class', $this->db->getTable());


        $this->use .= $this->getCode()->getUseConstructor($this->src, ['\Zend\Cache\Storage\Adapter\Memcached'***REMOVED***);

        $this->attribute = $this->getCode()->getUseAttribute($this->src, null, [
            '\Zend\Cache\Storage\Adapter\Memcached',
            //$this->repositoryFullname
        ***REMOVED***);

        $this->getColumnsSpecifications();

        $userOptions = $this->getUserSpecifications($this->db);


        $this->tableUploadImage = false;
        if ($this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')) {
            $this->tableUploadImage = true;
        }

        $options = [
            'entityFile' => $this->entityFile,
            'namespace' => $this->getCode()->getNamespace($this->src),
            'package' => $this->getCode()->getClassDocsPackage($this->src),
            'entity' => $this->entityName,
            'context' => $this->str('url', $this->tableName),
            'table' =>  $this->str('class', $this->name),
            'tableLabel' => $this->str('label', $this->name),
            'tableUploadImage' => $this->tableUploadImage,
            'var' => $this->str('var-length', $this->name),
            'functions'     => $this->functions,
            'update'        => $this->update,
            'create'        => $this->create,
            'delete'        => $this->delete,
            'nameVar'       => $this->str('var', $this->name),
            'imagemService' => $this->useImageService,
            'baseName'      => $this->name,
            //'entity'        => $this->name,
            'class'         => $this->className,
            'extends'       => 'AbstractService',
            'use'           => $this->use,
            'attribute'     => $this->attribute,
            'module'        => $this->getModule()->getModuleName(),
            'repository'    => $this->repository,
            'imagesArray'   => $this->formatArrayImages($this->imagesArray)
        ***REMOVED***;

        $options = array_merge($options, $userOptions);


        $options['constructor'***REMOVED*** = ($this->src->getService() == 'factories')
          ? $this->getCode()->getConstructor($this->src)
          : '';

        if ($this->src->getService() == 'factories') {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $this->file->setOptions($options);
        $this->file->setFileName($this->className.'.php');
        $this->file->setLocation($location);
        $this->file->setView('template/module/mvc/service/db/db.phtml');
        $this->getServiceTestService()->introspectFromTable($this->db);
        return $this->file->render();
    }

    public function formatArrayImages($images)
    {
        if (empty($images)) {
            return '';
        }

        $columns = '';

        foreach ($images as $i => $column) {

            $columns .= <<<EOS
        '{$this->str('var', $column)}'
EOS;

            if (isset($images[$i+1***REMOVED***)) {
                $columns .= ','.PHP_EOL;
            }
        }

        $template = <<<EOS
    const IMAGES = [
$columns
    ***REMOVED***;


EOS;

        return $template;
    }

    /**
     * need:
     * db
     * tableName
     * src
     * className
     * name
     * dependency
     */
    public function introspectFromTable($dbObject)
    {
        $this->db           = $dbObject;
        $this->tableName    = $this->db->getTable();
        $this->src          = $this->getSchemaService()->getSrcByDb($this->db, 'Service');
        $this->className    = $this->src->getName();
        $this->name         = $this->str('class', str_replace($this->src->getType(), '', $this->className));

        return $this->createDb();
    }

    public function getUserType(Db $db)
    {
        $userType = $this->str('class', $db->getUser());
        $userClass = sprintf('\Gear\UserType\Service\%s', $userType);
        $user = new $userClass();
        return $user;
    }

    public function getUserSpecifications(Db $db)
    {
        $userType = $this->getUserType($db);

        $options = [***REMOVED***;

        $options['selectall'***REMOVED*** = $userType->getServiceSelectAll();
        $options['selectbyid'***REMOVED*** = $userType->getServiceSelectById(
            $this->repository,
            $this->str('label', $this->db->getTable()),
            $this->entityName
        );
        $options['selectviewbyid'***REMOVED*** = $userType->getServiceSelectViewById($this->repository);

        return $options;
    }

    /**
     * @TODO COLOCAR PRA FUNCIONAR NOS DUPLICADOS QUANDO PRECISA, COLOCAR DUAS VARIAVEIS E TAL;
     */
    public function getColumnsSpecifications()
    {
        $onlyOnceUse = [UploadImageColumn::class***REMOVED***;
        $onlyOnceAttribute = [UploadImageColumn::class***REMOVED***;
        $onlyOnceBeforeCreate = [***REMOVED***;
        $onlyOnceAfterCreate = [***REMOVED***;
        $onlyOnceBeforeUpdate = [***REMOVED***;
        $onlyOnceAfterUpdate = [***REMOVED***;
        $onlyOnceDelete = [***REMOVED***;

        $this->imagesArray = [***REMOVED***;

        //var_dump($onlyOnceUse, $onlyOnceAttribute);die();

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {

            if ($columnData instanceof UploadImageColumn) {
                $this->imagesArray[***REMOVED*** = $columnData->getColumn()->getName();
            }

            $className = get_class($columnData);

            if ($columnData instanceof ServiceCreateBeforeInterface && !in_array($className, $onlyOnceBeforeCreate)) {
                $onlyOnceBeforeCreate[***REMOVED*** = $className;
                $this->create[0***REMOVED*** .= $columnData->getServiceCreateBefore();
            }

            if ($columnData instanceof ServiceCreateAfterInterface && !in_array($className, $onlyOnceAfterCreate)) {
                $onlyOnceAfterCreate[***REMOVED*** = $className;
                $this->create[1***REMOVED*** .= $columnData->getServiceCreateAfter();
            }

            if ($columnData instanceof ServiceUpdateBeforeInterface && !in_array($className, $onlyOnceBeforeUpdate)) {
                $onlyOnceBeforeUpdate[***REMOVED*** = $className;
                $this->update[0***REMOVED*** .= $columnData->getServiceUpdateBefore();
            }

            if ($columnData instanceof ServiceUpdateAfterInterface && !in_array($className, $onlyOnceAfterUpdate)) {
                $onlyOnceAfterUpdate[***REMOVED*** = $className;
                $this->update[1***REMOVED*** .= $columnData->getServiceUpdateAfter();
            }

            if ($columnData instanceof ServiceDeleteInterface && !in_array($className, $onlyOnceDelete)) {
                $onlyOnceDelete[***REMOVED*** = $className;
                $this->delete[0***REMOVED*** .= $columnData->getServiceDelete();
            }


            if (method_exists($columnData, 'getServiceUse') && !in_array($className, $onlyOnceUse)) {
                $onlyOnceUse[***REMOVED*** = $className;
                $this->use .= $columnData->getServiceUse($this->src->getService());
            }

            if (method_exists($columnData, 'getServiceAttribute') && !in_array($className, $onlyOnceAttribute)) {
                $onlyOnceAttribute[***REMOVED*** = $className;
                $this->attribute .= $columnData->getServiceAttribute();
            }


            if (method_exists($columnData, 'getServiceFunctions')) {
                $this->functions .= $columnData->getServiceFunctions().PHP_EOL;
            }
        }
    }
}
