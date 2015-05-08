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
namespace Gear\Service\Mvc;

use Gear\Service\AbstractFileCreator;
use Gear\Service\Column\ServiceInterface;
use Gear\Service\Column\ServiceAwareInterface;

class ServiceService extends AbstractFileCreator
{
    protected $repository;

    /* public function hasAbstract()
    {
        if (!is_file($this->getModule()->getServiceFolder().'/AbstractService.php')) {
            return true;
        } else {
            return false;
        }
    } */

    public function introspectFromTable($dbObject)
    {
        $this->db           = $dbObject;
        $this->tableName    = $this->db->getTable();
        $this->src          = $this->getGearSchema()->getSrcByDb($this->db, 'Service');
        $this->className    = $this->src->getName();
        $this->name         = $this->str('class', str_replace($this->src->getType(), '', $this->className));
        $this->dependency   = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());
        $this->specialities = $this->db->getColumns();


        $this->use       = '';
        $this->attribute = '';
        $this->create    = ['',''***REMOVED***;
        $this->update    = ['',''***REMOVED***;
        $this->delete    = [''***REMOVED***;
        $this->selectAll = '';
        $this->functions = '';

        $this->repository   = str_replace($this->src->getType(), '', $this->src->getName()).'Repository';

        $this->createTrait($this->src, $this->getModule()->getServiceFolder());

        if (!isset($this->file)) {
            $this->createFile();
        }

        $this->file->setFileName($this->className.'.php');
        $this->file->setLocation($this->getModule()->getServiceFolder());
        $this->file->setView('template/src/service/full.service.phtml');


        $this->getColumnsSpecifications();
        $this->getUserSpecifications();
        //$this->getTableSpecifications();


        //verifica associação com tabela imagem. -- Adiciona FUNÇÃO
        $this->getHasDependencyImagem();

        if ($dbObject->getUser() == 'low-strict') {
            $dbType = 'strict';
        } else {
            $dbType = $dbObject->getUser();
        }

        //ADICIONA FUNCAO
        if ($dbObject->getUser() == 'low-strict') {
            $this->file->addChildView(array(
                'template' => sprintf('template/src/service/selectviewbyid.phtml', $dbObject->getUser()),
                'placeholder' => 'selectviewbyid',
                'config' => array('repository' => $this->repository)
            ));
        }

        //ADICIONA FUNCAO
        if ($dbType == 'strict') {
            $this->file->addChildView(array(
                'template' => sprintf('template/src/service/authadapter.phtml', $dbObject->getUser()),
                'placeholder' => 'authadapter',
                'config' => array('repository' => $this->repository)
            ));
        }

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

        return $this->file->render();
    }

    public function getUserSpecifications()
    {


        $name = $this->db->getUserClass();


        $user = '\Gear\UserType\\'.$this->str('class', $name);
        $userType = new $user();

        $this->selectAll .= $userType->getServiceSelectAll();

        $this->functions .= $userType->getServiceSelectById($this->repository);
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
                if (method_exists($columnData, 'getServiceAttribute') && !$this->isDuplicated($columnData, 'getServiceAttribute')) {
                    $this->attribute .= $columnData->getServiceAttribute();
                }

                if (method_exists($columnData, 'getServiceFunctions')) {
                    $this->functions .= $columnData->getServiceFunctions().PHP_EOL;
                }
            }
        }

    }


    /**
     * @param \Gear\ValueObject\Src
     * @return boolean $status
     */
    public function create($src)
    {

        //verifica se a classe é abstrada ou não.

        //verifica se as classes dependency já existem
        $class = $src->getName();
        $this->className = $class;


        //verifica se a classe extends existe ou não tem extends.
        $extends = (null !== $src->getExtends()) ? $src->getExtends() : null;

        if ($extends == 'AbstractService') {
            $this->getAbstract();
        }

        $dependency = new \Gear\Constructor\Src\Dependency($src, $this->getModule());

        $this->createTrait($src, $this->getModule()->getServiceFolder());

        $this->createFileFromTemplate(
            'template/src/service/src.service.phtml',
            array(
                'abstract' => $src->getAbstract(),
                'class'   => $class,
                'extends' => $extends,
                'uses'           => $dependency->getUseNamespace(),
                'attributes'     => $dependency->getUseAttribute(),
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'.php',
            $this->getModule()->getServiceFolder()
        );

        $this->createFileFromTemplate(
            'template/test/unit/service/src.service.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule(),
                'injection' => $this->getClassService()->getTestInjections($src),
            ),
            $class.'Test.php',
            $this->getModule()->getTestServiceFolder()
        );
    }

    public function delete()
    {
        throw new \Exception('Not implemented yet');
    }

    public function getAbstract()
    {
        if (!is_file($this->getModule()->getServiceFolder().'/AbstractService.php')) {

            $this->createFileFromTemplate(
                'template/src/service/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractService.php',
                $this->getModule()->getServiceFolder()
            );

            $this->createFileFromTemplate(
                'template/test/unit/service/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractServiceTest.php',
                $this->getModule()->getTestServiceFolder()
            );

        }

    }


}
