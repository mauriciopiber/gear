<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\AbstractMvcTest;
use Gear\Constructor\Src\SrcConstructorInterface;
use GearJson\Src\Src;
use Gear\Mvc\Config\ServiceManagerTrait;

class ViewHelperTestService extends AbstractMvcTest implements SrcConstructorInterface
{
    use ServiceManagerTrait;

    public function create(Src $src)
    {
        $this->src = $src;


        $location = $this->getCodeTest()->getLocation($this->src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/view-helper/test-src.phtml',
            array(
                'serviceNameUline' => $this->str('var', str_replace('Controller', '', $src->getName())),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName(),
                'callable' => $this->getServiceManager()->getServiceName($this->src),
                'namespaceFile' => $this->getCodeTest()->getNamespace($this->src),
                'namespace' => $this->getCodeTest()->getTestNamespace($this->src),
            ),
            $src->getName().'Test.php',
            $location
        );

    }
}
