<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\Service\ServiceTestServiceTrait;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Db\Db;
use Gear\Column\Varchar\UploadImage as UploadImageColumn;
use Gear\Mvc\Service\ServiceColumnInterface;
use Gear\Mvc\Service\ServiceCodeInterface;
use Gear\Creator\Code;
use GearJson\Src\Type\ServiceInterface;
use GearJson\Src\Type\RepositoryInterface;

class ServiceService extends AbstractMvc
{
    use SchemaServiceTrait;

    use ServiceTestServiceTrait;

    use ServiceManagerTrait;

    const COLUMN_SCHEMA = [
        'create' => [
            0 => [ServiceColumnInterface::CREATE_BEFORE => [UploadImageColumn::class***REMOVED******REMOVED***,
            1 => [ServiceColumnInterface::CREATE_AFTER => [UploadImageColumn::class***REMOVED******REMOVED***,
        ***REMOVED***,
        'update' => [
            0 => [ServiceColumnInterface::UPDATE_BEFORE => [UploadImageColumn::class***REMOVED******REMOVED***,
            1 => [ServiceColumnInterface::UPDATE_AFTER => [UploadImageColumn::class***REMOVED******REMOVED***
        ***REMOVED***,
        'delete' => [
            0 => [ServiceColumnInterface::DELETE => [UploadImageColumn::class***REMOVED******REMOVED***
        ***REMOVED***,
    ***REMOVED***;

    const TEMPLATE_SCHEMA = [
        'src' => 'template/module/mvc/service/src/src.phtml',
        'db' => 'template/module/mvc/service/db/db.phtml'
    ***REMOVED***;

    public $name;

    public function create($src)
    {
        $this->src = $src;
        $this->className = $this->src->getName();

        if ($this->src->getDb() !== null) {
            $this->db        = $this->src->getDb();
            $this->tableName = $this->db->getTable();
            $this->name      = $this->str('class', $this->src->getNameOff());
            return $this->createDb();
        }

        return $this->createSrc();
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
        $this->src          = $this->getSchemaService()->getSrcByDb($this->db, ServiceInterface::NAME);
        $this->className    = $this->src->getName();
        $this->name      = $this->str('class', $this->src->getNameOff());

        return $this->createDb();
    }

    public function createSrc()
    {
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

        $options['constructor'***REMOVED*** = ($this->src->isFactory())
          ? $this->getCode()->getConstructor($this->src)
          : '';

        $this->getServiceTestService()->create($this->src);

        if ($this->src->isAbstract() === false) {
            $this->getTraitService()->createTrait($this->src);
        }

        if ($this->src->isFactory() && $this->src->isAbstract() === false) {
            $this->getFactoryService()->createFactory($this->src);
        }

        $this->srcFile = $this->getFileCreator();

        return $this->srcFile->createFile(
            self::TEMPLATE_SCHEMA['src'***REMOVED***,
            $options,
            sprintf('%s.php', $this->className),
            $this->getCode()->getLocation($this->src)
        );
    }


    public function createDb()
    {
        $this->columnManager = $this->db->getColumnManager();

        $this->src->addDependency(['memcached' => '\Zend\Cache\Storage\Adapter\Memcached'***REMOVED***);

        if (
            $this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
            || $this->columnManager->isAssociatedWith(UploadImageColumn::class)
        ) {
            $this->src->addDependency('\GearImage\Service\ImageService');
        }

        $location = $this->getCode()->getLocation($this->src);

        $this->file = $this->getFileCreator();

        $this->repository = sprintf('%s%s', $this->src->getNameOff(), RepositoryInterface::NAME);

        $this->repositoryFullname = $this->getServiceManager()
        ->getServiceName($this->getSchemaService()->getSrcByDb($this->db, RepositoryInterface::NAME));

        $this->entityName = sprintf(
            '%s\Entity\%s',
            $this->getModule()->getModuleName(),
            $this->str('class', $this->db->getTable())
        );

        $this->entityFile = $this->str('class', $this->db->getTable());

        $userOptions = $this->getUserSpecifications($this->db);

        $this->tableUploadImage = $this->getTableService()->verifyTableAssociation(
            $this->db->getTable(),
            'upload_image'
        );

        $optionsColumn = $this->columnManager->generateSchema(self::COLUMN_SCHEMA);

        $options = [
            'entityFile'       => $this->entityFile, //className
            'entity'           => $this->entityName, //fullName
            'namespace'        => $this->getCode()->getNamespace($this->src),
            'package'          => $this->getCode()->getClassDocsPackage($this->src),
            'context'          => $this->str('url', $this->tableName),
            'table'            => $this->str('class', $this->name),
            'tableLabel'       => $this->str('label', $this->name),
            'var'              => $this->str('var-length', $this->name),
            'nameVar'          => $this->str('var', $this->name),
            'tableUploadImage' => $this->tableUploadImage,
            'imagemService'    => $this->useImageService,
            'baseName'         => $this->name,
            'class'            => $this->className,
            'extends'          => 'AbstractService',
            'module'           => $this->getModule()->getModuleName(),
            'repository'       => $this->repository,
            'imagesArray'      => $this->formatArrayImages($this->columnManager->getColumnNames(UploadImageColumn::class))
        ***REMOVED***;

        $options['constructor'***REMOVED*** = $this->getCode()->getConstructor($this->src);

        if($this->columnManager->isAssociatedWith('Gear\Column\Varchar\PasswordVerify')) {
            $this->src->addDependency('\GearBase\Service\PasswordVerify');
        }

        $options['use'***REMOVED*** = $this->getCode()->getUseConstructor($this->src, [
            '\Zend\Cache\Storage\Adapter\Memcached',
        ***REMOVED***, [
            '\GearBase\Service\PasswordVerify'
        ***REMOVED***);

        $options['attribute'***REMOVED*** = $this->getCode()->getUseAttribute($this->src, null, [
            '\Zend\Cache\Storage\Adapter\Memcached',
            //$this->repositoryFullname
        ***REMOVED***);

        $options = array_merge($options, $optionsColumn);
        $options = array_merge($options, $userOptions);

        $this->getTraitService()->createTrait($this->src);
        $this->getFactoryService()->createFactory($this->src);

        $this->file->setOptions($options);
        $this->file->setFileName(sprintf('%s.php', $this->className));
        $this->file->setLocation($location);
        $this->file->setView(self::TEMPLATE_SCHEMA['db'***REMOVED***);
        $this->getServiceTestService()->introspectFromTable($this->db);

        return $this->file->render();
    }

    public function getUserType(Db $db)
    {
        $userType = $this->str('class', $db->getUser());
        $userClass = sprintf('\Gear\UserType\Service\%s', $userType);
        $user = new $userClass();
        return $user;
    }


    public function formatArrayImages($images)
    {
        if (empty($images)) {
            return '';
        }

        $columns = Code::EMPTY;

        foreach ($images as $i => $column) {

            $columns .= sprintf(ServiceCodeInterface::IMAGE, $this->str('var', $column));

            if (isset($images[$i+1***REMOVED***)) {
                $columns .= Code::ARRAY_SEPARATOR.PHP_EOL;
            }
        }

        $template = sprintf(ServiceCodeInterface::IMAGES, $columns);

        return $template;
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
}
