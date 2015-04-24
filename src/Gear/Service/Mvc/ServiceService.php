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

    public function hasAbstract()
    {
        if (!is_file($this->getModule()->getServiceFolder().'/AbstractService.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function introspectFromTable($dbObject)
    {
        $this->db = $dbObject;
        //$this->getAbstract();
        $this->tableName = $dbObject->getTable();

        $src = $this->getGearSchema()->getSrcByDb($dbObject, 'Service');

        $this->className  = $src->getName();
        $this->name       = $this->str('class', str_replace('Service', '', $this->className));


        $this->repository = str_replace($src->getType(), '', $src->getName()).'Repository';

        $this->createTrait($src, $this->getModule()->getServiceFolder());


        $this->getHasDependencyImagem();

        if (!isset($this->file)) {
            $this->createFile();
        }

        $this->file->setFileName($this->className.'.php');
        $this->file->setLocation($this->getModule()->getServiceFolder());
        $this->specialities = $this->db->getColumns();

        if ($dbObject->getUser() == 'low-strict') {
            $dbType = 'strict';
        } else {
            $dbType = $dbObject->getUser();
        }

        $this->file->addChildView(array(
        	'template' => sprintf('template/src/service/selectbyid-%s.phtml', $dbType),
            'placeholder' => 'selectbyid',
            'config' => array('repository' => $this->repository)
        ));

        $this->file->addChildView(array(
            'template' => sprintf('template/src/service/selectall-%s.phtml', $dbObject->getUser()),
            'placeholder' => 'selectall',
            'config' => array('repository' => $this->repository)
        ));

        if ($dbObject->getUser() == 'low-strict') {
            $this->file->addChildView(array(
                'template' => sprintf('template/src/service/selectviewbyid.phtml', $dbObject->getUser()),
                'placeholder' => 'selectviewbyid',
                'config' => array('repository' => $this->repository)
            ));
        }

        if ($dbType == 'strict') {
            $this->file->addChildView(array(
                'template' => sprintf('template/src/service/authadapter.phtml', $dbObject->getUser()),
                'placeholder' => 'authadapter',
                'config' => array('repository' => $this->repository)
            ));
        }





        $this->imageDependencyFromDb($this->file);

        //verificar se na tabela há upload-image
        //caso haja upload na tabela, adicionar childview em inserir e update
        //o código adicionar é necessário pra salvar a entidade.
        //primeiro tem que salvar a entidade, depois salvar a imagem no disco.
        //deletar imagem temporária.

        $this->setInsertServiceFromColumns($this->file);
        $this->setUpdateServiceFromColumns($this->file);

        $this->dependency = new \Gear\Constructor\Src\Dependency($src, $this->getModule());

        $this->setUse();
        $this->setAttribute();
        $options = array(
            'imagemService' => $this->useImageService,
            'baseName'      => $this->name,
            'entity'        => $this->name,
            'class'         => $this->className,
            'extends'       => 'AbstractService',
            'use'           => $this->use,
            'attribute'     => $this->attribute,
            'module'        => $this->getModule()->getModuleName(),
            'repository'    => $this->repository
        );



        $this->file->setOptions($options);
        $this->file->setView('template/src/service/full.service.phtml');
        return $this->file->render();
    }

    public function setUse()
    {

        $this->use = '';

        if (in_array('upload-image', $this->specialities)) {
            $this->use .= <<<EOS
use ImagemUpload\Service\ImagemServiceTrait;

EOS;
        }
        $this->use .= $this->dependency->getUseNamespace(false);


    }

    public function setAttribute()
    {

        $this->attribute = '';

        if (in_array('upload-image', $this->specialities)) {

        $this->attribute .= <<<EOS
    use ImagemServiceTrait;

EOS;
        }
        $this->attribute .= $this->dependency->getUseAttribute(false);


    }

    protected $use;

    protected $attribute;

    public function imageDependencyFromDb(&$fileCreator)
    {

        $speciality = $this->getGearSchema()->getSpecialityArray($this->db);
        if (in_array('upload-image', $speciality)) {

            $aggregate = [***REMOVED***;
            foreach ($speciality as $i => $name) {

                if ($name == 'upload-image') {
                    $aggregate[***REMOVED*** = $this->str('var', $i);
                }

            }
            $contexto = $this->str('url', $this->db->getTable());
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

            //$this->useImageDelete = true;
        }

        return true;
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
