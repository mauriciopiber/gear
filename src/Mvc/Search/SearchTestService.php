<?php
namespace Gear\Mvc\Search;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Src\SrcTypesInterface;

class SearchTestService extends AbstractMvcTest
{
    public function createSearchFormTest($data)
    {
        if (($data instanceof Db) === false && ($data instanceof Src && $src->getDb() === null)) {
            throw new InvalidArgumentException('Src for Entity need a valid --db=');
        }

        return parent::createTest($data, SrcTypesInterface::SEARCH_FORM);
    }

    public function createDbTest()
    {
        $file = $this->getFileCreator();

        $template = 'template/module/mvc/search/test-db.phtml';

        $options = [
            'var' => $this->str('var-length', $this->src->getName()),
            'class'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName(),
            'namespace' => $this->getCodeTest()->getNamespace($this->src),
            'testNamespace' => $this->getCodeTest()->getTestNamespace($this->src),
            'callable' => $this->getServiceManager()->getServiceName($this->src),
            'service' => $this->getServiceManager()->getServiceName($this->src)
        ***REMOVED***;

        $filename = $this->src->getName().'Test.php';

        $location = $this->getCodeTest()->getLocation($this->src);

        $this->getTraitTestService()->createTraitTest($this->src);

        $this->getFactoryTestService()->createFactoryTest($this->src);


        return $file->createFile($template, $options, $filename, $location);
    }
}
