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
                'var' => $this->str('var-lenght', 'id'.$this->str('class', $this->src->getName())),
                'module'  => $this->getModule()->getModuleName()
            )
        );


        $fileCreator->setFileName($src->getName().'.php');
        $fileCreator->setLocation( $this->getModule()->getFactoryFolder());

        if ($this->hasUniqueConstraint()) {
            $fileCreator->addChildView(array(
                'template' => 'template/src/factory/full.factory.set.id.phtml',
                'config' => array(
                    'var' => $this->str('var-lenght', 'id'.$this->str('class', $this->src->getName())),
                    'class'   => $this->className,
                    'module'  => $this->getModule()->getModuleName()
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
                'module'  => $this->getModule()->getModuleName()
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
                    'module' => $this->getModule()->getModuleName()
                ),
                'AbstractFactory.php',
                $this->getModule()->getFactoryFolder()
            );

            $this->createFileFromTemplate(
                'template/test/unit/factory/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName()
                ),
                'AbstractFactoryTest.php',
                $this->getModule()->getTestFactoryFolder()
            );
        }
    }

    public function create($src)
    {

        $this->src = $src;
        $this->className = $src->getName();

        $this->var = $this->str('var-lenght', $this->className);

        $this->getAbstract();

        $this->dependency = new \Gear\Constructor\Src\Dependency($this->src, $this->getModule());

        $this->uses = $this->dependency->getUseNamespace(false);
        $this->attributes = $this->dependency->getUseAttribute(false);

        $this->getName = true;

        $template = $this->getRequest()->getParam('template', null);

        if ($template == 'Form') {
            $templateHtml = <<<EOS
        \$this->setServiceLocator(\$serviceLocator);
        \$form = \$this->get{$this->dependency->getFormName()}();
        \$filter = \$this->get{$this->dependency->getFilterName()}();
        \$form->setInputFilter(\$filter->getInputFilter());
        return \$form;

EOS;

            $this->getName = false;

            $formName = str_replace('Factory', '', $this->className);

            $templateUnit = <<< EOS
    /**
     * @group {$this->getModule()->getModuleName()}
     * @group {$this->className}
    */
    public function testCallUsingServiceLocator()
    {
        \${$this->var} = \$this->get{$this->className}();
        \$this->assertInstanceOf('{$this->getModule()->getModuleName()}\Form\\{$formName}', \${$this->var});
    }

EOS;

        } else {

            $templateHtml = <<<EOS
        \$this->setServiceLocator(\$serviceLocator);
        return \$this;

EOS;
            $templateUnit = <<< EOS
    /**
     * @group {$this->getModule()->getModuleName()}
     * @group {$this->className}
    */
    public function testCallUsingServiceLocator()
    {
        \${$this->var} = \$this->get{$this->className}();
        \$this->assertInstanceOf('{$this->getModule()->getModuleName()}\Factory\\{$this->className}', \${$this->var});
    }

    /**
     * @group {$this->getModule()->getModuleName()}
     * @group {$this->className}
    */
    public function testCallClassName()
    {
        \${$this->var} = \$this->get{$this->className}();
        \$className = \${$this->var}->getClassName();
        \$this->assertEquals('{$this->className}', \$className);
    }

EOS;

        }

        $this->className = $this->src->getName();

        $this->createTrait($this->src, $this->getModule()->getFactoryFolder());
        $this->createInterface($this->getModule()->getFactoryFolder());

        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());


        $this->createFileFromTemplate(
            'template/test/unit/factory/src.factory.phtml',
            array(
                'serviceNameUline' => $this->str('var', $this->src->getName()),
                'serviceNameClass'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'template' => $templateUnit,
                'mock' => $mock
            ),
            $this->src->getName().'Test.php',
            $this->getModule()->getTestFactoryFolder()
        );

        $this->createFileFromTemplate(
            'template/src/factory/src.factory.phtml',
            array(
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'uses'  => $this->uses,
                'attributes' => $this->attributes,
                'template' => $templateHtml,
                'getName' => $this->getName
            ),
            $this->src->getName().'.php',
            $this->getModule()->getFactoryFolder()
        );
    }

}
