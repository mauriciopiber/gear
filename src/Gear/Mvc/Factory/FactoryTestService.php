<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\Src;
use GearJson\Db\Db;
use GearJson\Controller\Controller;

class FactoryTestService extends AbstractMvcTest
{
    public function createTest($src)
    {
        //$this->createFactoryTest($src);
    }

    public function createFactoryTest($src, $location)
    {
        if ($src instanceof Controller) {
            return $this->createControllerFactoryTest($src, $location);
        }

        $template = (!empty($src->getTemplate())) ? $src->getTemplate().'-test' : 'src-test';

        $name = $src->getName();

        //var_dump($src);

        $options = [
            'basename' => str_replace($src->getType(), '', $src->getName()),
            'basenameUrl' => $this->str('url', str_replace($src->getType(), '', $src->getName())),
            'module'    => $this->getModule()->getModuleName(),
            'moduleUrl'    => $this->str('url', $this->getModule()->getModuleName()),
            'namespace' => $this->getCodeTest()->getNamespace($src),
            'testNamespace' => $this->getCodeTest()->getTestNamespace($src),
            'fullclass' => $this->getCodeTest()->getFullClassName($src),
            'class' => $this->str('class', $name),
            'group' => $src->getType()
        ***REMOVED***;


        if ($src->getType() == 'Form' && $src->getDb() instanceof Db) {
            $form = $this->getSchemaService()->getSrcByDb($src->getDb(), 'Form');
            $filter = $this->getSchemaService()->getSrcByDb($src->getDb(), 'Filter');

            $options['filter'***REMOVED*** = $this->getServiceManager()->getServiceName($filter);
            $options['form'***REMOVED*** = $this->getServiceManager()->getServiceName($form);
        }

        $options['dependency'***REMOVED*** = $this->getCodeTest()->getServiceManagerDependencies($src);

        $trait = $this->getFileCreator();
        $trait->setTemplate(sprintf('template/module/mvc/factory-test/%s.phtml', $template));
        $trait->setFileName($src->getName().'FactoryTest.php');
        $trait->setLocation($location);
        $trait->setOptions($options);

        return $trait->render();
    }

    public function createControllerFactoryTest(Controller $src, $location)
    {
        $name = $src->getName();


        $options = [
            'module'    => $this->getModule()->getModuleName(),
            'namespace' => $this->getCodeTest()->getNamespace($src),
            'fullclass' => $this->getCodeTest()->getFullClassName($src),
            'testNamespace' => $this->getCodeTest()->getTestNamespace($src),
            'class' => $this->str('class', $name),
            'group' => 'Controller'
        ***REMOVED***;

        $options['dependency'***REMOVED*** = $this->getCodeTest()->getServiceManagerDependencies($src);

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/factory-test/controller/controller-test.phtml');
        $trait->setFileName($src->getName().'FactoryTest.php');
        $trait->setLocation($location);
        $trait->setOptions($options);

        return $trait->render();
    }
}
