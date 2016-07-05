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
namespace Gear\Mvc\Service;

use Gear\Mvc\AbstractMvc;
use Gear\Column\Mvc\ServiceInterface;
use Gear\Column\Mvc\ServiceAwareInterface;
use Gear\Mvc\Service\ServiceTestServiceTrait;
use GearJson\Schema\SchemaServiceTrait;

class ServiceService extends AbstractMvc
{
    use SchemaServiceTrait;
    use ServiceTestServiceTrait;

    static protected $defaultNamespace = 'Service';

    static protected $defaultFolder = null;

    public $name;

    /**
     * need:
     * src
     * className
     * dependency
     */

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



        $template = 'template/module/mvc/service/src.phtml';
        $fileName = $this->className.'.php';
        $location = $location;
        $options = array(
            'module'     => $this->getModule()->getModuleName(),
            'namespace'  => $this->getCode()->getNamespace($this->src),
            'abstract'   => $this->src->getAbstract(),
            'class'      => $this->className,
            'extends'    => $this->getCode()->getExtends($this->src),
            'uses'       => $this->getCode()->getUse($this->src),
            'attributes' => $this->getCode()->getUseAttribute($this->src),
        );

        $this->getServiceTestService()->create($this->src);
        $this->getTraitService()->createTrait($this->src, $location);

        if ($this->src->getService() == 'factories') {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        $this->srcFile = $this->getFileCreator();
        $this->srcFile->createFile($template, $options, $fileName, $location);

        return true;

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

        $this->use       = $this->getCode()->getUse($this->src);
        $this->attribute = $this->getCode()->getUseAttribute($this->src);

        $this->getColumnsSpecifications();
        $this->getUserSpecifications();

        if ($this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
            || $this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\\Column\\Varchar\\UploadImage')
        ) {
            $this->useImageService = true;
        } else {
            $this->useImageService = false;
        }

        if ($this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image')
        ) {
            $this->tableUploadImage = true;
        } else {
            $this->tableUploadImage = false;
        }

        $this->file->setOptions(array(
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
            'entity'        => $this->name,
            'class'         => $this->className,
            'extends'       => 'AbstractService',
            'use'           => $this->use,
            'attribute'     => $this->attribute,
            'module'        => $this->getModule()->getModuleName(),
            'repository'    => $this->repository
        ));
        $this->file->setFileName($this->className.'.php');
        $this->file->setLocation($this->getModule()->getServiceFolder());
        $this->file->setView('template/module/mvc/service/db.phtml');
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

        $this->createDb();
    }

    public function getUserSpecifications()
    {
        $name = $this->db->getUserClass();

        $user = '\Gear\UserType\\'.$this->str('class', $name);
        $userType = new $user();
        $this->selectAll .= $userType->getServiceSelectAll();
        $this->functions .= $userType->getServiceSelectById($this->repository);

        if ($this->db->getUser() == 'low-strict') {
            $dbType = 'strict';
        } else {
            $dbType = $this->db->getUser();
        }

        //ADICIONA FUNCAO
        if ($this->db->getUser() == 'low-strict') {
            $this->file->addChildView(array(
                'template' => sprintf('template/src/service/selectviewbyid.phtml', $this->db->getUser()),
                'placeholder' => 'selectviewbyid',
                'config' => array('repository' => $this->repository)
            ));
        }

        //ADICIONA FUNCAO
        if ($dbType == 'strict') {
            $this->file->addChildView(array(
                'template' => sprintf('template/src/service/authadapter.phtml', $this->db->getUser()),
                'placeholder' => 'authadapter',
                'config' => array('repository' => $this->repository)
            ));
        }
        //$this->selectId  .= $userType->getServiceSelectById();
    }

    public function getColumnsSpecifications()
    {
        foreach ($this->getTableData() as $columnData) {
            if ($columnData instanceof ServiceAwareInterface) {
                $this->create[0***REMOVED*** .= $columnData->getServiceInsertBody();
                $this->create[1***REMOVED*** .= $columnData->getServiceInsertSuccess();
                $this->update[0***REMOVED*** .= $columnData->getServiceUpdateBody();
                $this->update[1***REMOVED*** .= $columnData->getServiceUpdateSuccess();
                $this->delete[0***REMOVED*** .= $columnData->getServiceDeleteBody();

                if (method_exists($columnData, 'getUse')
                    && !$this->getColumnService()->isDuplicated($columnData, 'getUse')
                ) {
                    $this->use .= $columnData->getUse();
                }

                if (method_exists($columnData, 'getAttribute')
                    && !$this->getColumnService()->isDuplicated($columnData, 'getAttribute')
                ) {
                    $this->attribute .= $columnData->getAttribute();
                }

                if (method_exists($columnData, 'getServiceUse')
                    && !$this->getColumnService()->isDuplicated($columnData, 'getServiceUse')
                ) {
                    $this->use .= $columnData->getServiceUse();
                }
                if (method_exists($columnData, 'getServiceAttribute')
                    && !$this->getColumnService()->isDuplicated($columnData, 'getServiceAttribute')
                ) {
                    $this->attribute .= $columnData->getServiceAttribute();
                }

                if (method_exists($columnData, 'getServiceFunctions')) {
                    $this->functions .= $columnData->getServiceFunctions().PHP_EOL;
                }
            }
        }
    }


    public function delete()
    {
        throw new \Exception('Not implemented yet');
    }
    /*
    public function getAbstract()
    {
        if (!is_file($this->getModule()->getServiceFolder().'/AbstractService.php')) {

            $this->getFileCreator()->createFile(
                'template/src/service/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName
                ),
                'AbstractService.php',
                $this->getModule()->getServiceFolder()
            );

            $this->getFileCreator()->createFile(
                'template/test/unit/service/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName
                ),
                'AbstractServiceTest.php',
                $this->getModule()->getTestServiceFolder()
            );

        }
    }

    public function hasAbstract()
     {
    if (!is_file($this->getModule()->getServiceFolder().'/AbstractService.php')) {
    return true;
    } else {
    return false;
    }
    } */
}
