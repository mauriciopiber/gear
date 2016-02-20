<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\ViewHelper\ViewHelperTestServiceTrait;
use Gear\Mvc\Config\ViewHelperManagerTrait;
use GearJson\Src\Src;

class ViewHelperService extends AbstractJsonService
{
    use ViewHelperManagerTrait;
    use ViewHelperTestServiceTrait;

    public function create(Src $src)
    {
        $this->getViewHelperManager()->create($src);

        $this->getViewHelperTestService()->create($src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/view-helper/src.phtml',
            //'template/src/controller/plugin/src.plugin.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'.php',
            $this->getModule()->getViewHelperFolder()
        );

    }
}
