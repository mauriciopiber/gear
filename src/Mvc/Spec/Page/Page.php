<?php
namespace Gear\Mvc\Spec\Page;

use Gear\Mvc\AbstractMvcTest;

class Page extends AbstractMvcTest
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
