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

        $src = $this->getGearSchema()->getSrcByDb($dbObject, 'Service');

        $this->className  = $src->getName();
        $this->name       = $this->str('class', str_replace('Service', '', $this->className));


        $this->repository = str_replace($src->getType(), '', $src->getName()).'Repository';

        $this->getHasDependencyImagem();

        $this->setView('template/src/service/full.service.phtml');
        $this->setFileName($this->className.'.php');
        $this->setLocation($this->getModule()->getServiceFolder());


        if ($dbObject->getUser() == 'low-strict') {
            $dbType = 'strict';
        } else {
            $dbType = $dbObject->getUser();
        }



        $this->addChildView(array(
        	'template' => sprintf('template/src/service/selectbyid-%s.phtml', $dbType),
            'placeholder' => 'selectbyid',
            'config' => array('repository' => $this->repository)
        ));

        $this->addChildView(array(
            'template' => sprintf('template/src/service/selectall-%s.phtml', $dbObject->getUser()),
            'placeholder' => 'selectall',
            'config' => array('repository' => $this->repository)
        ));

        if ($dbObject->getUser() == 'low-strict') {
            $this->addChildView(array(
                'template' => sprintf('template/src/service/selectviewbyid.phtml', $dbObject->getUser()),
                'placeholder' => 'selectviewbyid',
                'config' => array('repository' => $this->repository)
            ));
        }

        if ($dbType == 'strict') {
            $this->addChildView(array(
                'template' => sprintf('template/src/service/authadapter.phtml', $dbObject->getUser()),
                'placeholder' => 'authadapter',
                'config' => array('repository' => $this->repository)
            ));
        }

        $this->setConfigVars(array(
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



        return $this->render();



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
