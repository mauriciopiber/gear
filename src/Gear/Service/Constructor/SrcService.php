<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Console\Prompt;

class SrcService extends AbstractJsonService
{

    protected $src;

    protected $namespace;

    protected $className;

    protected $classLocation;

    protected $classNamespace;

    protected $testClassNamespace;

    protected $testClassLocation;

    protected $testClassName;

    protected $namespaceTest;

    use \Gear\Common\RepositoryServiceTrait;
    use \Gear\Common\ServiceServiceTrait;

    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get('configService');
        }
        return $this->configService;
    }

    public function isValid($data)
    {
        return true;
    }

    public function createSrc()
    {
        //params
        $data = array(
            'name' => $this->getRequest()->getParam('name'),
            'type' => $this->getRequest()->getParam('type'),
            'dependency' => $this->getRequest()->getParam('dependency'),
            'db' => $this->getRequest()->getParam('db'),
            'columns' => $this->getRequest()->getParam('columns'),
            'abstract' => $this->getRequest()->getParam('abstract'),
            'extends' => $this->getRequest()->getParam('extends')
        );

        if (!$this->isValid($data)) {
            return false;
        }

        $this->src = new \Gear\ValueObject\Src($data);
        return $this;
    }

    public function create()
    {

        $this->createSrc();

        $jsonStatus = $this->getGearSchema()->insertSrc($this->src->export());

        if (!$jsonStatus) {
            return false;
        }

        if ($this->src->getType() == null) {
            $this->namespace = $this->getRequest()->getParam('namespace');

            return $this->createSrcWithoutType();
        }


        $this->getEventManager()->trigger('createInstance', $this, array('instance' => $this->src));
        $configService = $this->getConfigService();
        $configService->mergeServiceManagerConfig();
        return $this->factory();
    }

    public function verifyDirExists()
    {
        $moduleFolder = $this->getModule()->getSrcModuleFolder();
        $this->classLocation = $moduleFolder.'/'.$this->namespace;


        $this->classNamespace = $this->getModule()->getModuleName();
        if ($this->namespace) {
            $this->classNamespace .= '\\'.str_replace('/', '\\', $this->namespace);
        }
        $this->yes = $this->getRequest()->getParam('yes') || $this->getRequest()->getParam('y');

        if (!is_dir(realpath($this->classLocation))) {

            if (!$this->yes) {
                $confirm = new Prompt\Confirm(sprintf('You want to create %s?', $this->classLocation));
                $result = $confirm->show();
                if (!$result) {
                    return false;
                }
            }
            $this->createFolder();
        }

        $this->createTest();

        return true;
    }

    public function createTest()
    {

        $this->testClassName = '';
        $this->testClassLocation = '';
        $this->testClassNamespace = '';

        $this->testClassName = $this->src->getName().'Test.php';

        $namespaces = explode('/', $this->namespace);
        $hasNamespace = false;

        foreach ($namespaces as $i => $namespace) {

            if (empty($namespace)) {
                unset($namespaces[$i***REMOVED***);
                continue;
            }

            $hasNamespace = true;
        }

        $this->testClassNamespace = $this->getModule()->getModuleName().'Test';
        $this->testClassLocation = $this->getModule()->getTestUnitModuleFolder().'/';

        if ($hasNamespace) {
            $this->testClassNamespace .= '\\';
        }

        foreach ($namespaces as $i => $namespace) {

            if (empty($namespace)) {
                continue;
            }

            $this->testClassNamespace .= $namespace.'Test';
            $this->testClassLocation .= $namespace.'Test';

            if (count($namespaces)>$i+1) {
                $this->testClassNamespace .= '\\';
                $this->testClassLocation .= '/';
            }
        }

        if (!is_dir(realpath($this->testClassLocation))) {

            if (!$this->yes) {
                $confirm = new Prompt\Confirm(sprintf('You want to create %s?', $this->testClassLocation));
                $result = $confirm->show();
                if (!$result) {
                    return false;
                }
            }
            $this->createTestFolder();
        }

    }

    public function createFolder()
    {
        mkdir($this->classLocation, 0777, true);
    }

    public function createTestFolder()
    {
        mkdir($this->testClassLocation, 0777, true);
    }

    public function getFactoryFile()
    {
        if (!isset($this->factory)) {
            $this->factory = $this->getServiceLocator()->get('fileCreator');
        }
        return $this->factory;
    }

    public function setFactoryFile($factoryFile)
    {
        $this->factory = $factoryFile;
        return $this;
    }

    public function getTestFile()
    {
        if (!isset($this->test)) {
            $this->test = $this->getServiceLocator()->get('fileCreator');
        }
        return $this->test;
    }

    public function setTestFile($testFile)
    {
        $this->test = $testFile;
        return $this;
    }


    public function getClassFile()
    {
        if (!isset($this->class)) {
            $this->class = $this->getServiceLocator()->get('fileCreator');
        }
        return $this->class;
    }

    public function setClassFile($classFile)
    {
        $this->class = $classFile;
        return $this;
    }

    public function getTraitFile()
    {
        if (!isset($this->trait)) {
            $this->trait = $this->getServiceLocator()->get('fileCreator');
        }
        return $this->trait;
    }

    public function setTraitFile($traitFile)
    {
        $this->trait = $traitFile;
        return $this;
    }

    public function createSrcWithoutType()
    {
        $this->verifyDirExists();
        $this->use = '';
        $this->attribute = '';
        $this->className = $this->src->getName();
        $this->gearTrait();
        $this->gearClass();
        $this->gearTest();
        $this->gearFactory();
    }

    public function gearTrait()
    {
        $this->trait = $this->getTraitFile();
        $this->trait->setTemplate('template/src/free/trait.phtml');
        $this->trait->setOptions(
            array(
                'namespace' => $this->classNamespace,
                'var'       => $this->str('var-lenght', $this->className),
                'class'     => $this->str('class', $this->className),
                'use'       => $this->use,
                'attribute' => $this->attribute
            )
        );
        $this->trait->setLocation($this->classLocation);
        $this->trait->setFileName($this->className.'Trait.php');

        $this->trait->render();
    }

    public function gearTest()
    {
        $this->test = $this->getTestFile();
        $this->test->setTemplate('template/src/free/test.phtml');
        $this->test->setOptions(
            array(
                'namespaceTest' => $this->testClassNamespace,
                'namespace' => $this->classNamespace,
                'class'     => $this->className,
                'use'       => $this->use,
                'attribute' => $this->attribute
            )
        );
        $this->test->setLocation($this->testClassLocation);
        $this->test->setFileName($this->className.'Test.php');

        $this->test->render();
    }

    public function gearClass()
    {
        $this->use = '';

        $extendsFullName = [***REMOVED***;
        if ($this->src->getExtends() != null) {
            $extendsFullName = explode('\\',$this->src->getExtends());
            $this->use .= 'use '.implode('\\', $extendsFullName).';'.PHP_EOL.PHP_EOL;
        } else {
            //$this->use .= PHP_EOL;
        }

        $this->class = $this->getClassFile();
        $this->class->setTemplate('template/src/free/src.phtml');
        $this->class->setOptions(
            array(
                //'classLine' => $this->classLine,
                'use'       => $this->use,
                'namespace' => $this->classNamespace,
                'class'     => $this->className,
                'attribute' => $this->attribute,
                'extends'   => end($extendsFullName),
            )
        );
        $this->class->setLocation($this->classLocation);
        $this->class->setFileName($this->className.'.php');

        $this->class->render();
    }

    public function gearFactory()
    {
        $this->use = 'use '.$this->classNamespace.'\\'.$this->className.';'.PHP_EOL;

        $this->factory = $this->getFactoryFile();
        $this->factory->setTemplate('template/src/free/factory.phtml');
        $this->factory->setOptions(
            array(
                'namespace' => $this->classNamespace,
                'var'       => $this->str('var-lenght', $this->className),
                'class'     => $this->str('class', $this->className),
                'use'       => $this->use,
                'attribute' => $this->attribute
            )
        );
        $this->factory->setLocation($this->classLocation);
        $this->factory->setFileName($this->className.'Factory.php');

        $this->factory->render();
    }

    public static function avaliable()
    {
        return array(
            'SearchFactory',
            'Service',
            'Entity',
            'Repository',
            'Form',
            'Filter',
            'Factory',
            'ValueObject',
            'Controller',
            'Controller\Plugin'
        );

    }

    public function factory($src)
    {
        if ($this->src->getType() == null) {
            return 'Type not allowed'."\n";
        }

        try {
            switch ($this->src->getType()) {
                case 'Service':
                    $service = $this->getServiceService();
                    $status = $service->create($this->src);
                    break;
                case 'Entity':
                    $entity = $this->getServiceLocator()->get('entityService');
                    $status = $entity->create($this->src);
                    break;
                case 'Repository':
                    $repository = $this->getRepositoryService();
                    $status = $repository->create($this->src);
                    break;
                case 'Form':
                    $form = $this->getServiceLocator()->get('formService');
                    $status = $form->create($this->src);
                    break;
                case 'Filter':
                    $filter = $this->getServiceLocator()->get('filterService');
                    $status = $filter->create($this->src);
                    break;
                case 'Factory':
                    $factory = $this->getServiceLocator()->get('factoryService');
                    $status = $factory->create($this->src);
                    break;
                case 'ValueObject':
                    $valueObject = $this->getServiceLocator()->get('valueObjectService');
                    $status = $valueObject->create($this->src);
                    break;
                case 'Controller':
                    $controller = $this->getServiceLocator()->get('controllerService');
                    $status = $controller->create($this->src);
                    break;
                case 'Controller\Plugin':
                    $controllerPlugin = $this->getServiceLocator()->get('controllerPluginService');
                    $status = $controllerPlugin->create($this->src);
                    break;
                case 'Fixture':
                    $fixture = $this->getServiceLocator()->get('Gear\Service\Mvc\FixtureService');
                    $status = $fixture->create($this->src);
                    break;
                default:
                    throw new \Gear\Exception\SrcTypeNotFoundException();
                    break;
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return $status;

    }

    public function getSrc()
    {
        return $this->src;
    }

    public function setSrc($src)
    {
        $this->src = $src;
        return $this;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setNamespace($dir)
    {
        $this->namespace = $dir;
        return $this;
    }

    public function getClassLocation()
    {
        return $this->classLocation;
    }

    public function setClassLocation($classLocation)
    {
        $this->classLocation = $classLocation;
        return $this;
    }

    public function getClassNamespace()
    {
        return $this->classNamespace;
    }

    public function setClassNamespace($classNamespace)
    {
        $this->classNamespace = $classNamespace;
        return $this;
    }

    public function getNamespaceTest()
    {
        return $this->namespaceTest;
    }

    public function setNamespaceTest($namespaceTest)
    {
        $this->namespaceTest = $namespaceTest;
        return $this;
    }

    public function getTestClassNamespace() {
        return $this->testClassNamespace;
    }

    public function setTestClassNamespace($testClassNamespace)
    {
        $this->testClassNamespace = $testClassNamespace;
        return $this;
    }

    public function getTestClassLocation() {
        return $this->testClassLocation;
    }

    public function setTestClassLocation($testClassLocation) {
        $this->testClassLocation = $testClassLocation;
        return $this;
    }

    public function getTestClassName() {
        return $this->testClassName;
    }

    public function setTestClassName($testClassName) {
        $this->testClassName = $testClassName;
        return $this;
    }

    public function getClassName() {
        return $this->className;
    }

    public function setClassName($className) {
        $this->className = $className;
        return $this;
    }


}
