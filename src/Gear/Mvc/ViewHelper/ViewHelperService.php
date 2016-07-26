<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\ViewHelper\ViewHelperTestServiceTrait;
use Gear\Mvc\Config\ViewHelperManagerTrait;
use GearJson\Src\Src;

class ViewHelperService extends AbstractMvc
{
    use ViewHelperManagerTrait;
    use ViewHelperTestServiceTrait;

    public function create(Src $src)
    {
        $this->src = $src;

        $location = $this->getCode()->getLocation($src);

        $this->getViewHelperManager()->create($src);

        $this->getViewHelperTestService()->create($src);

        $this->getFileCreator()->createFile(
            'template/module/mvc/view-helper/src.phtml',
            //'template/module/mvc/controller/plugin/src.plugin.phtml',
            array(
                'namespace'  => $this->getCode()->getNamespace($this->src),
                'extends'    => $this->getCode()->getExtends($this->src),
                'uses'       => $this->getCode()->getUse($this->src),
                'attributes' => $this->getCode()->getUseAttribute($this->src),
                'class'   => $src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ),
            $src->getName().'.php',
            $location
        );


        if ($this->src->getService() == 'factories') {
            $this->getFactoryService()->createFactory($this->src, $location);
        }
    }
}
