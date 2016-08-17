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
        $this->dependency = $this->getSrcDependency()->setSrc($this->src);

        $location = $this->getCode()->getLocation($this->src);



        $template = 'template/module/mvc/service/src/src.phtml';
        $fileName = $this->className.'.php';
        $location = $location;
        $options = [
            'implements' => $this->getCode()->getImplements($this->src, [***REMOVED***),
            'classDocs'  => $this->getCode()->getClassDocs($this->src),
            'module'     => $this->getModule()->getModuleName(),
            'namespace'  => $this->getCode()->getNamespace($this->src),
            'abstract'   => $this->src->getAbstract(),
            'class'      => $this->className,
            'extends'    => $this->getCode()->getExtends($this->src),
            'uses'       => $this->getCode()->getUse($this->src),
            'attributes' => $this->getCode()->getUseAttribute($this->src),
        ***REMOVED***;

        $options['constructor'***REMOVED*** = ($this->src->getService() == 'factories')
          ? $this->getCode()->getConstructor($this->src)
          : '';


        $this->getServiceTestService()->create($this->src);

        if ($this->src->getAbstract() === false) {
            $this->getTraitService()->createTrait($this->src, $location);
        }

        if ($this->src->getService() == 'factories' && $this->src->getAbstract() == false) {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $this->srcFile = $this->getFileCreator();
        return $this->srcFile->createFile($template, $options, $fileName, $location);

    }

    public function createDb()
    {
        $this->dependency = $this->getSrcDependency()->setSrc($this->src);


        $this->getTraitService()->createTrait($this->src, $this->getModule()->getServiceFolder());

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

        $this->use = $this->getCode()->getUseConstructor($this->src);

        $this->attribute = $this->getCode()->getUseAttribute($this->src, null, [
            '\Zend\Cache\Storage\Adapter\Memcached',
            $this->repositoryFullname
        ***REMOVED***);

        $this->tableUploadImage = false;

        $this->getColumnsSpecifications();
        $this->getUserSpecifications();

        if (
            $this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
        ) {
            $this->tableUploadImage = true;
        }

        if (
            $this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
            || $this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')
        ) {
            $dep = $this->src->getDependency();
            $dep[***REMOVED*** = '\GearImage\Service\ImageService';
            $this->src->setDependency($dep);
        }

        $options = [
            'namespace' => $this->getCode()->getNamespace($this->src),
            'package' => $this->getCode()->getClassDocsPackage($this->src),
            'entity' => $this->entityName,
            'table' =>  $this->str('class', $this->name),
            'tableLabel' => $this->str('label', $this->name),
            'tableUploadImage' => $this->tableUploadImage,
            'var' => $this->str('var-lenght', $this->name),
            'functions'     => $this->functions,
            'update'        => $this->update,
            'create'        => $this->create,
            'delete'        => $this->delete,
            'selectAll'     => $this->selectAll,
            'nameVar'       => $this->str('var', $this->name),
            'imagemService' => $this->useImageService,
            'baseName'      => $this->name,
            //'entity'        => $this->name,
            'class'         => $this->className,
            'extends'       => 'AbstractService',
            'use'           => $this->use,
            'attribute'     => $this->attribute,
            'module'        => $this->getModule()->getModuleName(),
            'repository'    => $this->repository
        ***REMOVED***;


        $options['constructor'***REMOVED*** = ($this->src->getService() == 'factories')
          ? $this->getCode()->getConstructor($this->src)
          : '';


        $this->file->setOptions($options);
        $this->file->setFileName($this->className.'.php');
        $this->file->setLocation($this->getModule()->getServiceFolder());
        $this->file->setView('template/module/mvc/service/db/db.phtml');
        $this->getServiceTestService()->introspectFromTable($this->db);
        return $this->file->render();
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
        $this->dependency   = $this->getSrcDependency()->setSrc($this->src);

        return $this->createDb();
    }

    public function getUserSpecifications()
    {
        $name = $this->db->getUserClass();

        $user = '\Gear\UserType\\'.$this->str('class', $name);
        $userType = new $user();
        $this->selectAll .= $userType->getServiceSelectAll();
        $this->functions .= $userType->getServiceSelectById(
            $this->repository,
            $this->str('label', $this->db->getTable()),
            $this->entityName
        );

        if ($this->db->getUser() == 'low-strict') {
            $dbType = 'strict';
        } else {
            $dbType = $this->db->getUser();
        }

        //ADICIONA FUNCAO
        if ($this->db->getUser() == 'low-strict') {
            $this->file->addChildView(
                [
                    'template' => sprintf('template/module/mvc/service/db/selectviewbyid.phtml', $this->db->getUser()),
                    'placeholder' => 'selectviewbyid',
                    'config' => ['repository' => $this->repository***REMOVED***
                ***REMOVED***
            );
        }

        //ADICIONA FUNCAO
        if ($dbType == 'strict') {
            $this->file->addChildView(
                [
                    'template' => sprintf('template/module/mvc/service/db/authadapter.phtml', $this->db->getUser()),
                    'placeholder' => 'authadapter',
                    'config' => ['repository' => $this->repository***REMOVED***
                ***REMOVED***
            );
        }
        //$this->selectId  .= $userType->getServiceSelectById();
    }

    public function getColumnsSpecifications()
    {
        $onlyOnceUse = [***REMOVED***;
        $onlyOnceAttribute = [***REMOVED***;

        foreach ($this->getColumnService()->getColumns($this->db) as $columnData) {
            if ($columnData instanceof ServiceCreateBeforeInterface) {
                $this->create[0***REMOVED*** .= $columnData->getServiceCreateBefore();
            }

            if ($columnData instanceof ServiceCreateAfterInterface) {
                $this->create[1***REMOVED*** .= $columnData->getServiceCreateAfter();
            }

            if ($columnData instanceof ServiceUpdateBeforeInterface) {
                $this->update[0***REMOVED*** .= $columnData->getServiceUpdateBefore();
            }

            if ($columnData instanceof ServiceUpdateAfterInterface) {
                $this->update[1***REMOVED*** .= $columnData->getServiceUpdateAfter();
            }

            if ($columnData instanceof ServiceDeleteInterface) {
                $this->delete[0***REMOVED*** .= $columnData->getServiceDelete();
            }


            $className = get_class($columnData);

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
