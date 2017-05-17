<?php
namespace Gear\Mvc\Form;

use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Src\Src;

class FormTestService extends AbstractMvcTest
{
    //use ServiceManagerTrait;

    public function introspectFromTable($table)
    {
        $this->db = $table;
        $this->src = $this->getSchemaService()->getSrcByDb($table, 'Form');

        $template = 'template/module/mvc/form/test-db.phtml';

        $options = array(
            'namespace' => $this->getCodeTest()->getNamespace($this->src),
            'testNamespace' => $this->getCodeTest()->getTestNamespace($this->src),
            'serviceNameUline' => substr($this->str('var', $this->src->getName()), 0, 17),
            'callable' => $this->getServiceManager()->getServiceName($this->src),
            'service' => $this->getServiceManager()->getServiceName($this->src),
            'serviceNameClass'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName()
        );

        $filename = $this->src->getName().'Test.php';
        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->getService() === 'factories') {
            $this->getFactoryTestService()->createFactoryTest($this->src, $location);
        }

        $this->getTraitTestService()->createTraitTest($this->src, $location);

        $inputs = '';
        $data = $this->getColumnService()->getColumns($this->db);

        foreach ($data as $columnData) {
            if ($columnData instanceof \Gear\Column\Varchar\UniqueId) {
                continue;
            }

            $inputs .= $columnData->getAssertFormElement();
        }

        $options['columns'***REMOVED*** = $inputs;

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

        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->getAbstract() !== true) {
            $this->getTraitTestService()->createTraitTest($this->src, $location);

            if ($this->src->getService() == 'factories') {
                $this->getFactoryTestService()->createFactoryTest($this->src, $location);
            }
        }

        return $this->getFileCreator()->createFile(
            'template/module/mvc/form-test/src/test-src.phtml',
            array(
                'callable' => $this->getServiceManager()->getServiceName($this->src),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
                'var' => $this->str('var-length', $this->src->getName()),
                'className'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
            ),
            $this->src->getName().'Test.php',
            $location
        );
    }
}
