<?php
namespace Gear\Mvc\Spec\Page;

use Gear\Mvc\AbstractMvcTest;
use Gear\Mvc\AbstractMvcTestInterface;

class Page extends AbstractMvcTest implements AbstractMvcTestInterface
{
    public function createIndexPage()
    {
        return $this->getFileCreator()->createFile(
            'template/module/mvc/spec/page/index.page.phtml',
            array(
                //'module' => $this->getModule()->getModuleName(),
                'module' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'index.page.js',
            $this->getModule()->getPublicJsSpecEndFolder().'/index'
        );
    }
}
