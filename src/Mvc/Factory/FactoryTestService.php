<?php
namespace Gear\Mvc\Factory;

use Gear\Mvc\AbstractMvcTest;
use Gear\Schema\Src\Src;
use Gear\Schema\Db\Db;
use Gear\Schema\Controller\Controller;
use Gear\Code\FactoryCode\FactoryCodeTestTrait;
use Gear\Code\FactoryCode\FactoryCodeTest;
use Gear\Mvc\AbstractMvcTestInterface;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Code\CodeTest;
use Gear\Util\String\StringService;
use Gear\Table\TableService\TableService;
use Gear\Creator\Injector\Injector;

class FactoryTestService extends AbstractMvcTest implements AbstractMvcTestInterface
{

    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $string,
        CodeTest $codeTest,
        TableService $tableService,
        Injector $injector,
        FactoryCodeTest $factoryCodeTest
    ) {
        $this->setTableService($tableService);
        $this->setCodeTest($codeTest);
        $this->setModule($module);
        $this->setFileCreator($fileCreator);
        $this->setStringService($string);
        $this->setInjector($injector);
        $this->setFactoryCodeTest($factoryCodeTest);
    }

    use FactoryCodeTestTrait;


    public function createConstructorSnippet($src)
    {
        // $dependency = $this->getFactoryCodeTest()->getConstructorDependency($src);
        // echo $dependency.PHP_EOL;

        // $constructor = $this->getFactoryCodeTest()->getConstructor($src);
        // echo $constructor.PHP_EOL;
    }

    public function createFactoryTest($src, $location = null)
    {
        if ($this->getCodeTest()->skipApi($src)) {
            return;
        }

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
            'module'    => $this->getModule()->getNamespace(),
            'moduleUrl'    => $this->str('url', $this->getModule()->getModuleName()),
            'namespace' => $this->getFactoryCodeTest()->getNamespace($src),
            'testNamespace' => $this->getFactoryCodeTest()->getTestNamespace($src),
            'fullclass' => $this->getCodeTest()->getServiceManagerName($src),
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
        if ($this->getCodeTest()->skipApi($src)) {
            return;
        }

        $location = $this->getFactoryCodeTest()->getLocation($src);

        $name = $src->getName();


        $options = [
            'use'       => $this->getFactoryCodeTest()->getUse($src),
            'module'    => $this->getModule()->getNamespace(),
            'namespace' => $this->getFactoryCodeTest()->getNamespace($src),
            'fullclass' => $this->getCodeTest()->getServiceManagerName($src),
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
