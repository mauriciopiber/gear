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

use Gear\Service\AbstractJsonService;

class FactoryService extends AbstractJsonService
{
    public function getLocation()
    {
        return $this->getModule()->getSrcModuleFolder().'/Factory';
    }

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractFactory.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function createFormFactory()
    {
        $src = $this->getGearSchema()->getSrcByDb($this->table, 'Factory');

        $this->src = $src;


        $this->className = str_replace('Factory', '', $src->getName());

        $this->createTrait(
            $src,
            $this->getModule()->getFactoryFolder(),
            $src->getName()
        );
        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $fileCreator->setTemplate('template/src/factory/full.factory.phtml');
        $fileCreator->setOptions(
            array(
                'class'   => $src->getName(),
                'className' => $this->className,
                'module'  => $this->getConfig()->getModule()
            )
        );


        $fileCreator->setFileName($src->getName().'.php');
        $fileCreator->setLocation( $this->getModule()->getFactoryFolder());

        if ($this->hasUniqueConstraint()) {
            $fileCreator->addChildView(array(
                'template' => 'template/src/factory/full.factory.set.id.phtml',
                'config' => array(
                    'class'   => $this->className,
                    'module'  => $this->getConfig()->getModule()
                ),
                'placeholder' => 'setId'
            ));
        }


        return $fileCreator->render();
    }

    public function createSearchFormFactory()
    {
        $srcFormFactory = $this->getGearSchema()->getSrcByDb($this->table, 'SearchFactory');

        $serviceManager = new \Gear\Config\ServiceManager($this->getModule());
        $serviceManager->extractServiceManagerFromSrc($srcFormFactory);



        $this->createTrait(
            $srcFormFactory,
            $this->getModule()->getFactoryFolder(),
            $srcFormFactory->getName(),
            $this->getModule()->getTestFactoryFolder(),
            true,
            str_replace('SearchFactory', 'SearchForm', $srcFormFactory->getName())
        );

        return $this->createFileFromTemplate(
            'template/src/factory/full.search.phtml',
            array(
                'class'   => $srcFormFactory->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $srcFormFactory->getName().'.php',
            $this->getModule()->getFactoryFolder()
        );
    }

    public function introspectFromTable($table)
    {
        //$this->getAbstract();

        $this->table = $table;
        $this->tableObject = $table->getTableObject();

        $this->createFormFactory();
        $this->createSearchFormFactory();


        return true;
    }


    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->createFileFromTemplate(
                'template/src/factory/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractFactory.php',
                $this->getModule()->getFactoryFolder()
            );

            $this->createFileFromTemplate(
                'template/test/unit/factory/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractFactoryTest.php',
                $this->getModule()->getTestFactoryFolder()
            );
        }
    }

    public function create($src)
    {

        $this->getAbstract();

        $this->createFileFromTemplate(
            'template/test/unit/factory/src.factory.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestFactoryFolder()
        );

        $this->createFileFromTemplate(
            'template/src/factory/src.factory.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFactoryFolder()
        );
    }

}
