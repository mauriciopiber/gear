<?php
namespace Gear\Mvc\Search;

use Gear\Mvc\AbstractMvc;
use Gear\Column\Mvc\SearchFormInterface;
use GearJson\Schema\SchemaServiceTrait;

class SearchService extends AbstractMvc
{
    use SchemaServiceTrait;
    use \Gear\Mvc\Search\SearchTestServiceTrait;

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractSearchForm.php')) {
            return true;
        } else {
            return false;
        }
    }


    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->getFileCreator()->createFile(
                'template/module/mvc/form/search/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName
                ),
                'AbstractSearchForm.php',
                $this->getModule()->getSearchFolder()
            );
        }
    }


    public function create($src)
    {
        if ($src->getDb() instanceof \GearJson\Db\Db) {
            return $this->introspectFromTable($src->getDb());
        }
    }

    public function introspectFromTable($dbObject)
    {

        //$this->getAbstract();
        $this->db = $dbObject;


        $this->tableName = $dbObject->getTable();

        $dbColumns = $this->getColumnService()->getColumns($this->db);

        $formElements = [***REMOVED***;

        foreach ($dbColumns as $columnData) {
            if ($columnData instanceof SearchFormInterface) {
                //$formElements[***REMOVED*** = $columnData->getSearchFormElement();
            }
        }

        $this->getSearchTestService()->introspectFromTable($this->db);

        $this->src = $this->getSchemaService()->getSrcByDb($this->db, 'SearchForm');

        $this->getFactoryService()->createFactory($this->src, $this->getModule()->getSearchFolder());
        $this->getTraitService()->createTrait($this->src, $this->getModule()->getSearchFolder());

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
            $this->getModule()->getSearchFolder()
        );
    }
}
