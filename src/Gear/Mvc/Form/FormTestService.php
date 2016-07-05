<?php
namespace Gear\Mvc\Form;

use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Src\Src;

class FormTestService extends AbstractMvcTest
{
    use ServiceManagerTrait;

    public function introspectFromTable($table)
    {
        $src = $this->getSchemaService()->getSrcByDb($table, 'Form');

        $template = 'template/module/mvc/form/test-db.phtml';

        //$template = 'template/test/unit/form/full.form.phtml';

        $options = array(
            'serviceNameUline' => substr($this->str('var', $src->getName()), 0, 17),
            'callable' => $this->getServiceManager()->getServiceName($src),
            'service' => $this->getServiceManager()->getServiceName($src),
            'serviceNameClass'   => $src->getName(),
            'module'  => $this->getModule()->getModuleName()
        );

        $filename = $src->getName().'Test.php';
        $location = $this->getModule()->getTestFormFolder();


        $file = $this->getFileCreator();
        return $file->createFile($template, $options, $filename, $location);
    }

    public function createFromSrc(Src $src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null) {
            return $this->introspectFromTable($this->src->getDb());
        }

        $this->className = $this->src->getName();

        $this->dependency = $this->getSrcDependency()->setSrc($this->src);

        $this->functions  = $this->dependency->getTests();

        $location = $this->getCodeTest()->getLocation($this->src);


        $mock = $this->str('var-lenght', 'mock'.$this->src->getName());

        $this->getFileCreator()->createFile(
            'template/module/mvc/form/test-src.phtml',
            array(
                'callable' => $this->getServiceManager()->getServiceName($this->src),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'var' => $this->str('var-lenght', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'mock' => $mock
            ),
            $this->src->getName().'Test.php',
            $location
        );
    }
}
