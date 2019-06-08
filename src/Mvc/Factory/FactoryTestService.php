<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\AbstractMvcTest;
use Gear\Schema\Src\Src;
use Gear\Schema\Db\Db;
use Gear\Schema\Controller\Controller;
use Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTestTrait;
use Gear\Mvc\AbstractMvcTestInterface;

class FactoryTestService extends AbstractMvcTest implements AbstractMvcTestInterface
{
    use FactoryCodeTestTrait;


    public function createConstructorSnippet($src)
    {
        $dependency = $this->getFactoryCodeTest()->getConstructorDependency($src);
        echo $dependency.PHP_EOL;

        $constructor = $this->getFactoryCodeTest()->getConstructor($src);
        echo $constructor.PHP_EOL;
    }

    public function createFactoryTest($src, $location = null)
    {
        if ($src instanceof Controller) {
            return $this->createControllerFactoryTest($src, $location);
        }

        $location = $this->getFactoryCodeTest()->getLocation($src);

        $template = (!empty($src->getTemplate())) ? $src->getTemplate().'-test' : 'src-test';

        $name = $src->getName();

        //var_dump($src);

        $options = [
            'use'       => $this->getFactoryCodeTest()->getUse($src),
            'classUrl' => $this->str('url', str_replace($src->getType(), '', $src->getName())),
            'module'    => $this->getModule()->getModuleName(),
            'moduleUrl'    => $this->str('url', $this->getModule()->getModuleName()),
            'namespace' => $this->getFactoryCodeTest()->getNamespace($src),
            'testNamespace' => $this->getFactoryCodeTest()->getTestNamespace($src),
            'fullclass' => $this->getFactoryCodeTest()->getFullClassName($src),
            'class' => $this->str('class', $name),
            'group' => $src->getType()
        ***REMOVED***;


        if ($src->getType() == 'Form' && $src->getDb() instanceof Db) {
            $form = $this->getSchemaService()->getSrcByDb($src->getDb(), 'Form');
            $filter = $this->getSchemaService()->getSrcByDb($src->getDb(), 'Filter');

            $options['filter'***REMOVED*** = $this->getServiceManager()->getServiceName($filter);
            $options['filterFile'***REMOVED*** = $this->getFactoryCodeTest()->resolveName($options['filter'***REMOVED***);
            $options['form'***REMOVED*** = $this->getServiceManager()->getServiceName($form);
        }

        $options['dependency'***REMOVED*** = $this->getFactoryCodeTest()->getServiceManagerDependencies($src);

        $trait = $this->getFileCreator();
        $trait->setTemplate(sprintf('template/module/mvc/factory-test/%s.phtml', $template));
        $trait->setFileName($src->getName().'FactoryTest.php');
        $trait->setLocation($location);
        $trait->setOptions($options);

        return $trait->render();
    }

    public function createControllerFactoryTest(Controller $src, $location = null)
    {
        $location = $this->getFactoryCodeTest()->getLocation($src);

        $name = $src->getName();


        $options = [
            'use'       => $this->getFactoryCodeTest()->getUse($src),
            'module'    => $this->getModule()->getModuleName(),
            'namespace' => $this->getFactoryCodeTest()->getNamespace($src),
            'fullclass' => $this->getFactoryCodeTest()->getFullClassName($src),
            'testNamespace' => $this->getFactoryCodeTest()->getTestNamespace($src),
            'class' => $this->str('class', $name),
            'group' => 'Controller'
        ***REMOVED***;

        $options['dependency'***REMOVED*** = $this->getFactoryCodeTest()->getServiceManagerDependencies($src);

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/factory-test/controller/controller-test.phtml');
        $trait->setFileName($src->getName().'FactoryTest.php');
        $trait->setLocation($location);
        $trait->setOptions($options);

        return $trait->render();
    }
}
