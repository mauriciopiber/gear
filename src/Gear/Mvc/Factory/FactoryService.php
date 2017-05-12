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

class FactoryService extends AbstractMvc
{
    static protected $defaultFolder = null;

    use ServiceManagerTrait;

    use SchemaServiceTrait;

    use FactoryTestServiceTrait;

    public function create($src)
    {
        $this->createFactory($src);
        $this->getFactoryTestService()->createTest($src);
    }


    public function getOptionsTemplateSrc(Src $src)
    {
        $namespace = $this->getCode()->getNamespace($src);
        $use = $this->getCode()->getUseFactory($src);

        $options = [
            'className'                => $this->str('class', $src->getName()),
            'namespace'                => $namespace,
            'use'                      => $use,
            'classDocs'                => $this->getCode()->getClassDocs($src, 'Factory')
        ***REMOVED***;

        if (!empty($src->getDependency())) {
            $options['dependency'***REMOVED*** = $this->getCode()->getServiceLocatorFactory($src);
        }

        return $options;
    }

    public function getOptionsTemplateFormFilter(Src $src)
    {
        if ($src->getType() !== 'Form') {
            throw new WrongType('Must be "Form" Type, tried to use '.$src->getType());
        }

        $filter = $this->getSchemaService()->getSrcByDb($src->getDb(), 'Filter');
        $form =  $this->getSchemaService()->getSrcByDb($src->getDb(), 'Form');
        $entity =  $this->getSchemaService()->getSrcByDb($src->getDb(), 'Entity');

        $var = $this->str('var-lenght', 'Id'.$src->getDb()->getTable());

        return [
            'package'     => $this->getCode()->getClassDocsPackage($src),
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
        ***REMOVED***;
    }

    public function getOptionsTemplateSearchForm(Src $src)
    {
        if ($src->getType() !== 'SearchForm') {
            throw new WrongType('Must be "SearchForm" Type, tried to use '.$src->getType());
        }

        $var = $this->str('var-lenght', 'Id'.$src->getName());

        return [
            'package'     => $this->getCode()->getClassDocsPackage($src),
            'namespace'   => $this->getCode()->getNamespace($src),
            'class'       => $src->getName(),
            'form'        => $this->getServiceManager()->getServiceName($src),
            'var'         => $var,
            'setId'       => $this->getFileCreator()->renderPartial(
                'template/module/mvc/factory/form-filter-set-id.phtml',
                ['var' => $var***REMOVED***
            ),
        ***REMOVED***;
    }


    public function createFactory($data)
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

        $location = $this->getCode()->getLocation($controller);

        $template = 'template/module/mvc/factory/controller.phtml';

        $namespace = $this->getCode()->getNamespace($controller);

        $use = $this->getCode()->getUseFactory($controller);

        $options = [
            'className'                => $this->str('class', $controller->getName()),
            'namespace'                => $namespace,
            'use'                      => $use,
            'classDocs'                => $this->getCode()->getClassDocs($controller, 'Factory')
        ***REMOVED***;

        if (!empty($controller->getDependency())) {
            $options['dependency'***REMOVED*** = $this->getCode()->getServiceLocatorFactory($controller);
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
}
