<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Column\SearchFormInterface;

class SearchService extends AbstractJsonService
{
    use \Gear\Common\SearchTestServiceTrait;

    public function getLocation()
    {
        return $this->getModule()->getSearchFolder();
    }

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
            $this->createFileFromTemplate(
                'template/src/form/search/abstract.phtml',
                array(
                    'module' => $this->getModule()->getModuleName
                ),
                'AbstractSearchForm.php',
                $this->getModule()->getSearchFolder()
            );
        }
    }


    public function introspectFromTable($dbObject)
    {

        //$this->getAbstract();
        $this->db = $dbObject;


        $this->tableName = $dbObject->getTable();

        $dbColumns = $this->getTableData();

        $formElements = [***REMOVED***;

        foreach ($dbColumns as $i => $columnData) {

            if ($columnData instanceof SearchFormInterface) {
                //$formElements[***REMOVED*** = $columnData->getSearchFormElement();
            }

        }

        $this->createFileFromTemplate(
            'template/src/form/search/full.search.phtml',
            array(
                'class'   => $this->db->getTable(),
                'var'     => $this->str('var', $this->db->getTable()),
                'module'  => $this->getModule()->getModuleName(),
                'elements' => $formElements
            ),
            $this->db->getTable().'SearchForm.php',
            $this->getModule()->getSearchFolder()
        );

        $this->getSearchTestService()->introspectFromTable($this->db);
/*
        $columns = $dbObject->getTableColumns();

        $columnData = array();

        foreach ($columns as $i => $column) {
            if ($dbObject->isForeignKey($column)) {
                $speciality = 'select';
                $dbObject->setServiceLocator($this->getServiceLocator());
                $property = $this->str('var', $dbObject->getFirstValidPropertyFromForeignKey($column));

                $entity = $this->str('class', $dbObject->getForeignKeyReferencedTable($column));


            } elseif ($column->getDataType() == 'decimal') {
                $speciality = 'money';
            } elseif($column->getDataType() == 'date') {
                $speciality = 'date';
            } elseif($column->getDataType() == 'time') {
                $speciality = 'time';
            } elseif($column->getDataType() == 'datetime') {
                $speciality = 'datetime';
            } else {
                continue;
            }

            $columnData[***REMOVED*** = array(
                'speciality' => $speciality,
                'data' => array(
                    'data' => $this->str('var', $column->getName()),
                    'module' => $this->getModule()->getModuleName(),
                    'entity' => $this->str('class', str_replace('id', '', $column->getName())),
                    'property' => (isset($property)) ? $property : '',
                    'entity' => (isset($entity)) ? $entity : ''
                ),
            );
        }


 */



    }

}
