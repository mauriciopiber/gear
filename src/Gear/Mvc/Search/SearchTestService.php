<?php
namespace Gear\Mvc\Search;

use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;

class SearchTestService extends AbstractJsonService
{
    use SchemaServiceTrait;

    public function introspectFromTable($table)
    {
        $this->db = $table;

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'SearchForm');

        $callable = sprintf(
            '%s\%s\%s',
            $this->getModule()->getModuleName(),
            'Form\Search',
            $this->src->getName()
        );

        $factoryName = str_replace('Form', 'Factory', $this->src->getName());

        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->file->setTemplate('template/test/unit/form/search/full-form.phtml');
        $this->file->setFileName($this->src->getName().'Test.php');
        $this->file->setLocation($this->getModule()->getTestSearchFolder());
        $this->file->setOptions(array(
            'var' => $this->str('var-lenght', $this->src->getName()),
            'class'   => $this->src->getName(),
            'module'  => $this->getModule()->getModuleName(),
            'callable' => $callable
        ));

        return $this->file->render();

    }
}
