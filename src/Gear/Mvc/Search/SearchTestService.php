<?php
namespace Gear\Mvc\Search;

use Gear\Mvc\AbstractMvcTest;

class SearchTestService extends AbstractMvcTest
{
    public function introspectFromTable($table)
    {
        $this->db = $table;

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'SearchForm');

        $file = $this->getFileCreator();

        $template = 'template/module/mvc/search/test-db.phtml';

        $options = array(
            'var' => $this->str('var-lenght', $this->src->getName()),
            'class'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName(),
            'namespace' => $this->getCodeTest()->getNamespace($this->src),
            'testNamespace' => $this->getCodeTest()->getTestNamespace($this->src),
            'callable' => $this->getServiceManager()->getServiceName($this->src),
            'service' => $this->getServiceManager()->getServiceName($this->src)
        );

        $filename = $this->src->getName().'Test.php';

        $location = $this->getCodeTest()->getLocation($this->src);

        $this->getTraitTestService()->createTraitTest($this->src, $location);

        $this->getFactoryTestService()->createFactoryTest($this->src, $location);


        return $file->createFile($template, $options, $filename, $location);
    }
}
