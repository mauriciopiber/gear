<?php
namespace Gear\Mvc\Search;

use Gear\Mvc\AbstractMvc;
use GearJson\Src\SrcTypesInterface;
use GearJson\Schema\SchemaServiceTrait;

class SearchService extends AbstractMvc
{
    use SchemaServiceTrait;
    use \Gear\Mvc\Search\SearchTestServiceTrait;

    public function createSearchForm($data)
    {
        if (($data instanceof Db) === false && ($data instanceof Src && $src->getDb() === null)) {
            throw new InvalidArgumentException('Src for Entity need a valid --db=');
        }

        return parent::create($data, SrcTypesInterface::SEARCH_FORM);
    }

    public function createDb()
    {
        $this->columnManager = $this->db->getColumnManager();

        $this->tableName = $this->db->getTable();

        $formElements = [***REMOVED***;

        /*
        foreach ($dbColumns as $columnData) {
            if ($columnData instanceof SearchFormInterface) {
                //$formElements[***REMOVED*** = $columnData->getSearchFormElement();
            }
        }
        */

        $this->getSearchTestService()->createSearchFormTest($this->db);

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'SearchForm');
        $location = $this->getCode()->getLocation($this->src);

        $this->getFactoryService()->createFactory($this->src);
        $this->getTraitService()->createTrait($this->src);

        return $this->getFileCreator()->createFile(
            'template/module/mvc/form/search/full.search.phtml',
            array(
                'namespace' => $this->getCode()->getNamespace($this->src),
                'package' => $this->getCode()->getClassDocsPackage($this->src),
                'tableLabel' => $this->str('label', $this->db->getTable()),
                'class'   => $this->db->getTable(),
                'var'     => $this->str('var', $this->db->getTable()),
                'module'  => $this->getModule()->getModuleName(),
                'elements' => $formElements
            ),
            $this->db->getTable().'SearchForm.php',
            $location
        );
    }
}
