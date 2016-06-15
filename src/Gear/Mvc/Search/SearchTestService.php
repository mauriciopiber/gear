<?php
namespace Gear\Mvc\Search;

use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Mvc\Config\ServiceManagerTrait;

class SearchTestService extends AbstractJsonService
{
    use ServiceManagerTrait;
    use SchemaServiceTrait;

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
            'callable' => $this->getServiceManager()->getServiceName($this->src),
            'service' => $this->getServiceManager()->getServiceName($this->src)
        );

        $filename = $this->src->getName().'Test.php';

        $location = $this->getModule()->getTestSearchFolder();

        return $file->createFile($template, $options, $filename, $location);
    }
}
