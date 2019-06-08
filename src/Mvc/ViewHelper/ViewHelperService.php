<?php
namespace Gear\Mvc\ViewHelper;

use Gear\Mvc\AbstractMvc;
use Gear\Mvc\ViewHelper\ViewHelperTestServiceTrait;
use Gear\Mvc\Config\ViewHelperManagerTrait;
use Gear\Schema\Src\Src;
use Gear\Schema\Src\SrcTypesInterface;
use Gear\Schema\Db\Db;
use Gear\Mvc\AbstractMvcInterface;

class ViewHelperService extends AbstractMvc implements AbstractMvcInterface
{
    use ViewHelperManagerTrait;
    use ViewHelperTestServiceTrait;

    public function createViewHelper($data)
    {
        if ($data instanceof Db || ($data instanceof Src && $data->getDb() !== null)) {
            throw new Exception('View Helper should be run without Db');
        }

        parent::create($data, SrcTypesInterface::VIEW_HELPER);
    }

    public function createSrc()
    {
        if (empty($this->src->getExtends())) {
            $this->src->setExtends('\Zend\Mvc\Controller\Plugin\AbstractPlugin');
        }


        $location = $this->getCode()->getLocation($this->src);

        $this->getViewHelperManager()->create($this->src);

        $this->getViewHelperTestService()->createViewHelperTest($this->src);

        if ($this->src->isFactory()) {
            $this->getFactoryService()->createFactory($this->src, $location);
        }

        return $this->getFileCreator()->createFile(
            'template/module/mvc/view-helper/src.phtml',
            //'template/module/mvc/controller/plugin/src.plugin.phtml',
            [
                'classDocs'   => $this->getCode()->getClassDocs($this->src),
                'namespace'  => $this->getCode()->getNamespace($this->src),
                'extends'    => $this->getCode()->getExtends($this->src),
                'uses'       => $this->getCode()->getUse($this->src),
                'attributes' => $this->getCode()->getUseAttribute($this->src),
                'class'   => $this->src->getName(),
                'module'  => $this->getModule()->getModuleName()
            ***REMOVED***,
            $this->src->getName().'.php',
            $location
        );
    }
}
