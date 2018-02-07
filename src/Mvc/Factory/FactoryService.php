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
use Gear\Mvc\Factory\Exception\WrongType;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Creator\Codes\Code\FactoryCode\FactoryCodeTrait;

class FactoryService extends AbstractMvc
{
    static protected $defaultFolder = null;

    use FactoryCodeTrait;

    use ServiceManagerTrait;

    use SchemaServiceTrait;

    use FactoryTestServiceTrait;

    public function createFactory($src)
    {
        $file = $this->createFactoryFactory($src);
        $this->getFactoryTestService()->createFactoryTest($src);
        return $file;
    }

    public function createConstructorSnippet($src)
    {
        $use = $this->getCode()->checkUseForConstructor($src);
        echo $use.PHP_EOL;

        $constructor = $this->getCode()->getConstructor($src);
        echo $constructor.PHP_EOL;
    }



    public function getOptionsTemplateSrc(Src $src)
    {
        $namespace = $this->getFactoryCode()->getNamespace($src);
        $use = $this->getFactoryCode()->getUse($src);

        $options = [
            'className'                => $this->str('class', $src->getName()),
            'namespace'                => $namespace,
            'use'                      => $use,
            'classDocs'                => $this->getFactoryCode()->getClassDocs($src, 'Factory')
        ***REMOVED***;

        if (!empty($src->getDependency())) {
            $options['dependency'***REMOVED*** = $this->getFactoryCode()->getServiceLocatorFactory($src);
        }

        return $options;
    }

    public function getOptionsTemplateFormFilter(Src $src)
    {
        if ($src->getType() !== 'Form') {
            throw new WrongType('Must be "Form" Type, tried to use '.$src->getType());
        }

        $filterSrc = $this->getSchemaService()->getSrcByDb($src->getDb(), 'Filter');
        $filter = $this->getServiceManager()->getServiceName($filterSrc);
        $filterName = $this->getFactoryCode()->resolveName($filter);

        $formSrc =  $this->getSchemaService()->getSrcByDb($src->getDb(), 'Form');
        $form = $this->getServiceManager()->getServiceName($formSrc);

        $entitySrc =  $this->getSchemaService()->getSrcByDb($src->getDb(), 'Entity');
        $entity = $this->getServiceManager()->getServiceName($entitySrc);
        $entityName = $this->getFactoryCode()->resolveName($entity);

        $var = $this->str('var-length', 'Id'.$src->getDb()->getTable());

        return [
            'package'     => $this->getFactoryCode()->getClassDocsPackage($src),
            'namespace'   => $this->getFactoryCode()->getNamespace($src),
            'class'       => $src->getName(),
            'filterName'  => $filterName,
            'entityName'  => $entityName,
            'form'        => $form,
            'filter'      => $filter,
            'entity'      => $entity,
            'var'         => $var,
            'setId'       => $this->getFileCreator()->renderPartial(
                'template/module/mvc/factory/form-filter-set-id.phtml',
                ['var' => $var***REMOVED***
            ),
        ***REMOVED***;
    }

    public function getOptionsTemplateSearchForm(Src $src)
    {
        if ($src->getType() !== 'SearchForm') {
            throw new WrongType('Must be "SearchForm" Type, tried to use '.$src->getType());
        }

        $var = $this->str('var-length', 'Id'.$src->getName());

        return [
            'package'     => $this->getFactoryCode()->getClassDocsPackage($src),
            'namespace'   => $this->getFactoryCode()->getNamespace($src),
            'class'       => $src->getName(),
            'form'        => $this->getServiceManager()->getServiceName($src),
            'var'         => $var,
            'setId'       => $this->getFileCreator()->renderPartial(
                'template/module/mvc/factory/form-filter-set-id.phtml',
                ['var' => $var***REMOVED***
            ),
        ***REMOVED***;
    }


    public function createFactoryFactory($data)
    {
        if ($data instanceof Controller) {
            return $this->createFactoryController($data);
        }

        if ($data instanceof Src) {
            return $this->createFactorySrc($data);
        }
    }

    /**
     * Cria Factory para classes Controller
     *
     * @param Controller $controller
     * @param string $location
     *
     * @return string
     */
    public function createFactoryController(Controller $controller)
    {
        $file = $this->getFileCreator();

        $location = $this->getFactoryCode()->getLocation($controller);

        $template = 'template/module/mvc/factory/controller.phtml';

        $namespace = $this->getFactoryCode()->getNamespace($controller);

        $use = $this->getFactoryCode()->getUse($controller);

        $options = [
            'className'                => $this->str('class', $controller->getName()),
            'namespace'                => $namespace,
            'use'                      => $use,
            'classDocs'                => $this->getFactoryCode()->getClassDocs($controller, 'Factory')
        ***REMOVED***;

        if (!empty($controller->getDependency())) {
            $options['dependency'***REMOVED*** = $this->getFactoryCode()->getServiceLocatorFactory($controller);
        }


        $filename = $controller->getName().'Factory.php';




        return $file->createFile($template, $options, $filename, $location);
    }

    /**
     * Cria Factory para classes SRC
     *
     * @param Src $src
     * @param string $location
     *
     * @return string
     */
    public function createFactorySrc(Src $src)
    {
        $file = $this->getFileCreator();

        $location = $this->getFactoryCode()->getLocation($src);

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
}
