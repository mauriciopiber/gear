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
use Gear\Column\ServiceInterface;
use Gear\Column\ServiceAwareInterface;
use Gear\Mvc\Service\ServiceTestServiceTrait;
use GearJson\Schema\SchemaServiceTrait;

class ServiceService extends AbstractMvc
{
    use SchemaServiceTrait;
    use ServiceTestServiceTrait;

    static protected $defaultNamespace = 'Service';

    static protected $defaultFolder = null;

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

        $this->createSrc();
    }

    public function createSrc()
    {
        static::$defaultLocation = $this->getModule()->getServiceFolder();

        //cria testes
        $this->getServiceTestService()->create($this->src);

        $location = $this->getLocation($this->src);
        $this->createTrait($this->src, $location);

        //cria namespace
        $namespace = $this->getNamespace($this->src);



        $extends = $this->getExtends($this->src);


        $this->dependency = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());

        $use = $this->getUse($this->src);

        $attributes = $this->getUseAttribute($this->src);


        $template = 'template/module/mvc/service/src.phtml';
        $fileName = $this->className.'.php';
        $location = $location;
        $options = array(
            'namespace'  => $namespace,
            'abstract'   => $this->src->getAbstract(),
            'class'      => $this->className,
            'extends'    => $extends,
            'uses'       => $use,
            'attributes' => $attributes,
            'module'     => $this->getModule()->getModuleName()
        );


        $this->srcFile = $this->getServiceLocator()->get('fileCreator');
        $this->srcFile->createFile($template, $options, $fileName, $location);

        return;

    }

    public function createDb()
    {
        $this->dependency = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());

        $this->createTrait($this->src, $this->getModule()->getServiceFolder());

        if (!isset($this->file)) {
            $this->createFile();
        }

        $this->specialities = $this->db->getColumns();
        $this->use        = '';
        $this->attribute  = '';
        $this->create     = ['',''***REMOVED***;
        $this->update     = ['',''***REMOVED***;
        $this->delete     = [''***REMOVED***;
        $this->selectAll  = '';
        $this->functions  = '';
        $this->repository = str_replace($this->src->getType(), '', $this->src->getName()).'Repository';

        $this->getColumnsSpecifications();
        $this->getUserSpecifications();
        $this->getHasDependencyImagem();

        $this->use .= $this->dependency->getUseNamespace(false);
        $this->attribute .= $this->dependency->getUseAttribute(false);

        $this->file->setOptions(array(
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
        $this->file->setView('template/src/service/full.service.phtml');
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
        $this->dependency   = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());

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
        foreach ($this->getTableData() as $i => $columnData) {
            if ($columnData instanceof ServiceAwareInterface) {
                $this->create[0***REMOVED*** .= $columnData->getServiceInsertBody();
                $this->create[1***REMOVED*** .= $columnData->getServiceInsertSuccess();
                $this->update[0***REMOVED*** .= $columnData->getServiceUpdateBody();
                $this->update[1***REMOVED*** .= $columnData->getServiceUpdateSuccess();
                $this->delete[0***REMOVED*** .= $columnData->getServiceDeleteBody();

                if (method_exists($columnData, 'getUse') && !$this->isDuplicated($columnData, 'getUse')) {
                    $this->use .= $columnData->getUse();
                }

                if (method_exists($columnData, 'getAttribute') && !$this->isDuplicated($columnData, 'getAttribute')) {
                    $this->attribute .= $columnData->getAttribute();
                }

                if (method_exists($columnData, 'getServiceUse') && !$this->isDuplicated($columnData, 'getServiceUse')) {
                    $this->use .= $columnData->getServiceUse();
                }
                if (
                    method_exists($columnData, 'getServiceAttribute')
                    && !$this->isDuplicated($columnData, 'getServiceAttribute')
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

            $this->createFileFromTemplate(
                'template/src/service/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName
                ),
                'AbstractService.php',
                $this->getModule()->getServiceFolder()
            );

            $this->createFileFromTemplate(
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
