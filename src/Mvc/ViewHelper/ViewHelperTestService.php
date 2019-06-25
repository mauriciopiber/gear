<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\AbstractMvcTestInterface;
use Gear\Schema\Src\Src;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Schema\Src\SrcTypesInterface;

class ViewHelperTestService extends AbstractMvcTest implements AbstractMvcTestInterface
{
    use ServiceManagerTrait;

    public function createViewHelperTest($data)
    {
        if ($data instanceof Db || ($data instanceof Src && $data->getDb() !== null)) {
            throw new Exception('View Helper should be run without Db');
        }

        parent::createTest($data, SrcTypesInterface::VIEW_HELPER);
    }

    public function createSrcTest()
    {
        $location = $this->getCodeTest()->getLocation($this->src);

        if ($this->src->isFactory()) {
            $this->getFactoryTestService()->createFactoryTest($this->src);
        }

        return $this->getFileCreator()->createFile(
            'template/module/mvc/view-helper/test-src.phtml',
            array(
                'var' => $this->str('var', str_replace('Controller', '', $this->src->getName())),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
            ),
            $this->src->getName().'Test.php',
            $location
        );
    }
}
