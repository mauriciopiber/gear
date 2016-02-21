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
namespace Gear\Mvc\Factory;

use Gear\Mvc\AbstractMvc;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Src\Src;
use GearJson\Controller\Controller;

class FactoryService extends AbstractMvc
{
    static protected $defaultFolder = null;

    use ServiceManagerTrait;

    use SchemaServiceTrait;

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractFactory.php')) {
            return true;
        } else {
            return false;
        }
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
            $this->getFileCreator()->createFile(
                'template/src/factory/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName()
                ),
                'AbstractFactory.php',
                $this->getModule()->getFactoryFolder()
            );

            $this->getFileCreator()->createFile(
                'template/test/unit/factory/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName()
                ),
                'AbstractFactoryTest.php',
                $this->getModule()->getTestFactoryFolder()
            );
        }
    }

    public function getOptionsTemplateSrc(Src $src)
    {
        $namespace = $this->getCode()->getNamespace($src);
        $use = $this->getCode()->classNameToNamespace($src);

        $dependencyServiceLocator = [***REMOVED***;
        $dependencyVar            = [***REMOVED***;

        return [
            'className'                => $this->str('class', $src->getName()),
            'namespace'                => $namespace,
            'use'                      => $use,
            'dependencyServiceLocator' => $dependencyServiceLocator,
            'dependencyVar'            => $dependencyVar,

            /*
            'class'   => $src->getName(),
            'module'  => $this->getModule()->getModuleName(),
            'uses'  => $this->uses,
            */
        ***REMOVED***;
    }

    public function getOptionsTemplateFormFilter(Src $src)
    {

        if ($src->getType() !== 'Form') {
            throw new WrongType('Must be "Form" Type, tried to use '.$src->getType());
        }

        $filter = $this->getSchemaService()->getSrcByDb($src->getDb(), 'Filter');
        $form =  $this->getSchemaService()->getSrcByDb($src->getDb(), 'Form');
        $entity =  $this->getSchemaService()->getSrcByDb($src->getDb(), 'Entity');

        $var = $this->str('var-lenght', 'Id'.$src->getName());


        $dependencyServiceLocator = [***REMOVED***;
        $dependencyVar            = [***REMOVED***;

        return array(
            'namespace'   => $this->getCode()->getNamespace($src),
            'class'       => $src->getName(),
            'form'        => $this->getServiceManager()->getServiceName($form),
            'filter'      => $this->getServiceManager()->getServiceName($filter),
            'entity'      => $this->getServiceManager()->getServiceName($entity),
            'var'         => $var,
            'setId'       => $this->getFileCreator()->renderPartial(
                'template/module/mvc/factory/form-filter-set-id.phtml',
                ['var' => $var***REMOVED***
            ),
        );
    }

    public function getOptionsTemplateSearchForm(Src $src)
    {
        if ($src->getType() !== 'SearchForm') {
            throw new WrongType('Must be "SearchForm" Type, tried to use '.$src->getType());
        }

        $var = $this->str('var-lenght', 'Id'.$src->getName());

        $dependencyServiceLocator = [***REMOVED***;
        $dependencyVar            = [***REMOVED***;

        return array(
            'namespace'   => $this->getCode()->getNamespace($src),
            'class'       => $src->getName(),
            'form'        => $this->getServiceManager()->getServiceName($src),
            'var'         => $var,
            'setId'       => $this->getFileCreator()->renderPartial(
                'template/module/mvc/factory/form-filter-set-id.phtml',
                ['var' => $var***REMOVED***
            ),
        );
    }


    public function createFactory($data, $location)
    {
        if ($data instanceof Controller) {
            $this->createFactoryController($data, $location);
            return;
        }

        if ($data instanceof Src) {
            $this->createFactorySrc($data, $location);
        }
    }

    public function createFactoryController(Controller $controller, $location = null)
    {
        $file = $this->getFileCreator();

        $location = $this->getCode()->getLocation($controller);

        $template = 'template/module/mvc/factory/controller.phtml';

        $namespace = $this->getCode()->getNamespace($controller);
        $use = $this->getCode()->classNameToNamespace($controller);

        $dependencyServiceLocator = [***REMOVED***;
        $dependencyVar            = [***REMOVED***;

        $options = [
            'className'                => $this->str('class', $controller->getName()),
            'namespace'                => $namespace,
            'use'                      => $use,
            'dependencyServiceLocator' => $dependencyServiceLocator,
            'dependencyVar'            => $dependencyVar,
        ***REMOVED***;


        $filename = $controller->getName().'Factory.php';




        return $file->createFile($template, $options, $filename, $location);
    }

    public function createFactorySrc(Src $src, $location = null)
    {
        $file = $this->getFileCreator();

        $location = $this->getCode()->getLocation($src);

        $template = sprintf(
            'template/module/mvc/factory/%s.phtml',
            (!empty($src->getTemplate())) ? $src->getTemplate() : 'src'
        );

        switch ($src->getTemplate()) {

            case 'form-filter':
                $options = $this->getOptionsTemplateFormFilter($src);
                break;

            case 'search-form':
                $options = $this->getOptionsTemplateSearchForm($src);
                break;

            default:
                $options = $this->getOptionsTemplateSrc($src);
                break;
        }

        $filename = $src->getName().'Factory.php';

        return $file->createFile($template, $options, $filename, $location);
    }

    public function create($src)
    {

        $this->src = $src;
        $this->className = $src->getName();

        $this->var = $this->str('var-lenght', $this->className);

        $this->getAbstract();

        $this->dependency = new \Gear\Creator\Src\Dependency($this->src, $this->getModule());

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
            $templateUnit = <<<EOS
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

        $this->getTraitService()->createTrait($this->src, $this->getModule()->getFactoryFolder());
        $this->getInterfaceService()->createInterface($this->getModule()->getFactoryFolder());

        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());


        $this->getFileCreator()->createFile(
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

        $this->getFileCreator()->createFile(
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

    public function createFormFactory()
    {
        $src = $this->getSchemaService()->getSrcByDb($this->table, 'Factory');

        $this->src = $src;


        $this->className = str_replace('Factory', '', $src->getName());

        $this->getTraitService()->createTrait(
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
        $fileCreator->setLocation($this->getModule()->getFactoryFolder());

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
        $srcFormFactory = $this->getSchemaService()->getSrcByDb($this->table, 'SearchFactory');


        $this->getTraitService()->createTrait(
            $srcFormFactory,
            $this->getModule()->getFactoryFolder(),
            $srcFormFactory->getName(),
            $this->getModule()->getTestFactoryFolder(),
            true,
            str_replace('SearchFactory', 'SearchForm', $srcFormFactory->getName())
        );

        return $this->getFileCreator()->createFile(
            'template/src/factory/full.search.phtml',
            array(
                'class'   => $srcFormFactory->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $srcFormFactory->getName().'.php',
            $this->getModule()->getFactoryFolder()
        );
    }
}
