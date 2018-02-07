<?php
namespace Gear\Mvc\Form;

use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Src\Src;
use GearJson\Src\SrcTypesInterface;

class FormTestService extends AbstractMvcTest
{
    public function createFormTest($data)
    {
        return parent::createTest($data, SrcTypesInterface::FORM);
    }


    public function createDbTest()
    {
        $this->columnManager = $this->db->getColumnManager();

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

        if ($this->src->isFactory()) {
            $this->getFactoryTestService()->createFactoryTest($this->src);
        }

        $this->getTraitTestService()->createTraitTest($this->src);

        $options['columns'***REMOVED*** = $this->columnManager->generateCode('getAssertFormElement', [***REMOVED***, [\Gear\Column\Varchar\UniqueId::class***REMOVED***);

        $file = $this->getFileCreator();
        return $file->createFile($template, $options, $filename, $location);
    }

    public function createSrcTest()
    {
        $this->className = $this->src->getName();

        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->getAbstract() !== true) {
            $this->getTraitTestService()->createTraitTest($this->src);

            if ($this->src->isFactory()) {
                $this->getFactoryTestService()->createFactoryTest($this->src);
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
