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

class ServiceService extends AbstractFileCreator
{

    protected $repository;

    public function getServiceManagerFile()
    {
        return $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext/servicemanager.config.php';
    }

    public function getLocation()
    {
        return $this->getModule()->getSrcModuleFolder().'/Service';
    }

    public function hasAbstract()
    {
        if (!is_file($this->getLocation().'/AbstractService.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function introspectFromTable($dbObject)
    {

        $this->getAbstract();

        $this->tableName = $dbObject->getTable();

        $src = $this->getGearSchema()->getSrcByDb($dbObject, 'Service');

        $this->className  = $src->getName();
        $this->name       = $this->str('class', str_replace('Service', '', $this->className));


        $this->repository = str_replace($src->getType(), '', $src->getName()).'Repository';

        $this->getHasDependencyImagem();

        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $fileCreator->setView('template/src/service/full.service.phtml');
        $fileCreator->setFileName($this->className.'.php');
        $fileCreator->setLocation($this->getModule()->getServiceFolder());


        if ($dbObject->getUser() == 'low-strict') {
            $dbType = 'strict';
        } else {
            $dbType = $dbObject->getUser();
        }



        $fileCreator->addChildView(array(
        	'template' => sprintf('template/src/service/selectbyid-%s.phtml', $dbType),
            'placeholder' => 'selectbyid',
            'config' => array('repository' => $this->repository)
        ));

        $fileCreator->addChildView(array(
            'template' => sprintf('template/src/service/selectall-%s.phtml', $dbObject->getUser()),
            'placeholder' => 'selectall',
            'config' => array('repository' => $this->repository)
        ));

        if ($dbObject->getUser() == 'low-strict') {
            $fileCreator->addChildView(array(
                'template' => sprintf('template/src/service/selectviewbyid.phtml', $dbObject->getUser()),
                'placeholder' => 'selectviewbyid',
                'config' => array('repository' => $this->repository)
            ));
        }

        if ($dbType == 'strict') {
            $fileCreator->addChildView(array(
                'template' => sprintf('template/src/service/authadapter.phtml', $dbObject->getUser()),
                'placeholder' => 'authadapter',
                'config' => array('repository' => $this->repository)
            ));
        }

        //verificar se na tabela há upload-image
        //caso haja upload na tabela, adicionar childview em inserir e update
        //o código adicionar é necessário pra salvar a entidade.
        //primeiro tem que salvar a entidade, depois salvar a imagem no disco.
        //deletar imagem temporária.

        $speciality = $this->getGearSchema()->getSpecialityArray($dbObject);
        if (in_array('upload-image', $speciality)) {

            $aggregate = [***REMOVED***;
            foreach ($speciality as $i => $name) {

                if ($name == 'upload-image') {
                    $aggregate[***REMOVED*** = $this->str('var', $i);
                }

            }
            $contexto = $this->str('url', $dbObject->getTable());
            $fileCreator->addChildView(array(
                'template' => 'template/src/service/upload-image/pre-create.phtml',
                'placeholder' => 'preImageCreate',
                'config' => array('keys' => $aggregate, 'contexto' => $contexto)
            ));
            $fileCreator->addChildView(array(
                'template' => 'template/src/service/upload-image/pre-update.phtml',
                'placeholder' => 'preImageUpdate',
                'config' => array('keys' => $aggregate, 'contexto' => $contexto)
            ));
            $fileCreator->addChildView(array(
                'template' => 'template/src/service/upload-image/create.phtml',
                'placeholder' => 'imageCreate',
                'config' => array('keys' => $aggregate, 'contexto' => $contexto)
            ));
            $fileCreator->addChildView(array(
                'template' => 'template/src/service/upload-image/update.phtml',
                'placeholder' => 'imageUpdate',
                'config' => array('keys' => $aggregate, 'contexto' => $contexto)
            ));
            $fileCreator->addChildView(array(
                'template' =>'template/src/service/upload-image/delete.phtml',
                'placeholder' => 'imageDelete',
                'config' => array('contexto' => $contexto)
            ));

            $fileCreator->addChildView(array(
                'template' =>'template/src/service/upload-image/overwrite.phtml',
                'placeholder' => 'overwrite',
                'config' => array('contexto' => $contexto)
            ));

            $this->useImageService = true;
        }


        $this->setInsertServiceFromColumns($fileCreator);
        $this->setUpdateServiceFromColumns($fileCreator);


        $fileCreator->setOptions(array(
            'imagemService' => $this->useImageService,
            'baseName'      => $this->name,
            'entity'        => $this->name,
            'class'         => $this->className,
            'extends'       => 'AbstractService',
            'use'           => $this->getClassService()->getUses($src),
            'attribute'     => $this->getClassService()->getAttributes($src),
            'injection'     => $this->getClassService()->getInjections($src),
            'module'        => $this->getConfig()->getModule(),
            'repository'    => $this->repository
        ));



        return $fileCreator->render();
    }

    public function setInsertServiceFromColumns(&$fileCreator)
    {
        $serviceCode = '';

        foreach ($this->getTableData() as $i => $columnData) {
            if ($columnData instanceof ServiceInterface) {
                $serviceCode .= $columnData->getService();
            }
        }

        if (!empty($serviceCode)) {
            $fileCreator->addChildView(array(
                'template' =>'template/src/service/extra-code.phtml',
                'placeholder' => 'insertColumns',
                'config' => array('code' => $serviceCode)
            ));
        }

    }

    public function setUpdateServiceFromColumns(&$fileCreator)
    {
        $serviceCode = '';
        foreach ($this->getTableData() as $i => $columnData) {

            if ($columnData instanceof ServiceInterface) {

                 $serviceCode .= $columnData->getService();
            }
        }

        if (!empty($serviceCode)) {

            $fileCreator->addChildView(array(
                'template' =>'template/src/service/extra-code.phtml',
                'placeholder' => 'updateColumns',
                'config' => array('code' => $serviceCode)
            ));

        }
    }



    /**
     * @param \Gear\ValueObject\Src
     * @return boolean $status
     */
    public function create($options)
    {
        $location = $this->getLocation();


        $this->getAbstract();


        $class = $options->getName();
        $extends = (null !== $options->getExtends()) ? $options->getExtends() : 'AbstractService';


        $this->createFileFromTemplate(
            'template/src/service/src.service.phtml',
            array(
                'class'   => $class,
                'extends' => $extends,
                'use' => $this->getClassService()->getUses($options),
                'attribute' => $this->getClassService()->getAttributes($options),
                'injection' => $this->getClassService()->getInjections($options),
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'.php',
            $location
        );

        $this->createFileFromTemplate(
            'template/test/unit/service/src.service.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule(),
                'injection' => $this->getClassService()->getTestInjections($options),
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
