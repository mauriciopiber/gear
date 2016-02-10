<?php
namespace Gear\Mvc;

class FreeService
{

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

    public function verifyDirExists()
    {
        $moduleFolder = $this->getModule()->getSrcModuleFolder();
        $this->classLocation = $moduleFolder.'/'.$this->src->getNamespace();


        $this->classNamespace = $this->getModule()->getModuleName();
        if ($this->src->getNamespace()) {
            $this->classNamespace .= '\\'.str_replace('/', '\\', $this->src->getNamespace());
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

        $namespaces = explode('/', $this->src->getNamespace());
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

        $this->functions = '';
        if ($this->src->getDependency()) {

            foreach ($this->src->getDependency() as $i => $dependency) {

                $names = explode('\\', $dependency);

                $class = $this->str('class', end($names));

                $this->functions .= <<<EOS

    public function testGet{$class}()
    {
        \$this->assertInstanceOf(
            '{$dependency}',
            \$this->get{$this->className}()->get{$class}()
        );
    }

    public function testSet{$class}()
    {
        \$mock{$this->className} = \$this->getMockSingleClass('{$dependency}');
        \$this->get{$this->className}()->set{$class}(\$mock{$this->className});
        \$this->assertEquals(\$mock{$this->className}, \$this->get{$this->className}()->get{$class}());
    }

EOS;
            }
        }

        $this->test->setOptions(
            array(
                'functions' => $this->functions,
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

            $nameExtends = implode('\\', $extendsFullName);

            $this->use .= <<<EOS
use $nameExtends;

EOS;

            //$this->use .= 'use '.implode('\\', $extendsFullName).';'.PHP_EOL;
        } else {
            //$this->use .= PHP_EOL;
        }

        $this->construct = '';
        $this->constructorArgs = '';
        $this->constructorMethod = '';

        if ($this->src->getDependency()) {

            foreach ($this->src->getDependency() as $i => $dependency) {
                $this->use .= <<<EOS
use $dependency;

EOS;
                $this->use .= <<<EOS
use {$dependency}Trait;

EOS;


                $explode = explode('\\', $dependency);

                $this->attribute .= '    use '.end($explode).'Trait;'.PHP_EOL;


                $var = $this->str('var', end($explode));
                $varLenght = $this->str('var-lenght', end($explode));
                $class = $this->str('class', end($explode));

                $this->constructorArgs .= sprintf('%s $%s', $class, $varLenght);
                $this->constructorMethod .= <<<EOS
        \$this->{$var} = \${$varLenght};

EOS;
                //$this->constructorMethod .= PHP_EOL;

                if ($i < count($this->src->getDependency())-1) {
                    $this->constructorArgs .= ', ';
                }

            }

            $this->constructorMethod = rtrim($this->constructorMethod);


            $this->construct = <<<EOS
    public function __construct({$this->constructorArgs})
    {
{$this->constructorMethod}
    }

EOS;

        }

        if (!empty($this->use)) {
            $this->use .= PHP_EOL;
        }


        $this->class = $this->getClassFile();
        $this->class->setTemplate('template/src/free/src.phtml');
        $this->class->setOptions(
            array(
                //'classLine' => $this->classLine,
                'construct' => $this->construct,
                'attribute' => $this->attribute,
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

        $this->instantiate = '';

        if ($this->src->getDependency()) {

            $this->instantiateItem = '';
            foreach ($this->src->getDependency() as $i => $dependency) {

                $this->instantiateItem .= <<<EOS
            \$serviceManager->get('{$dependency}')
EOS;

                if ($i < count($this->src->getDependency())-1) {
                    $this->instantiateItem .= ','.PHP_EOL;
                }
            }


            $this->instantiate .= <<<EOS
        \$serviceManager = \$serviceLocator->get('serviceManager');
        \${$this->str('var-lenght', $this->className)} = new {$this->str('class', $this->className)}(
{$this->instantiateItem}
        );

EOS;

        } else {
            $this->instantiate .= <<<EOS
        \${$this->str('var-lenght', $this->className)} = new {$this->str('class', $this->className)}();

EOS;
        }

        $this->factory = $this->getFactoryFile();
        $this->factory->setTemplate('template/src/free/factory.phtml');
        $this->factory->setOptions(
            array(
                'instantiate' => $this->instantiate,
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
}
