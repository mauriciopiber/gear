<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Service\Column\SearchFormInterface;

class SearchService extends AbstractJsonService
{
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
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractSearchForm.php',
                $this->getModule()->getSearchFolder()
            );
        }
    }


    public function introspectFromTable($dbObject)
    {

        //$this->getAbstract();


        $this->tableName = $dbObject->getTable();

        $dbColumns = $this->getTableData();

        $formElements = [***REMOVED***;

        foreach ($dbColumns as $i => $columnData) {

            if ($columnData instanceof SearchFormInterface) {
                $formElements[***REMOVED*** = $columnData->getSearchFormElement();
            }

        }


        $this->createFileFromTemplate(
            'template/src/form/search/full.search.phtml',
            array(
                'class'   => $dbObject->getTable(),
                'var'     => $this->str('var', $dbObject->getTable()),
                'module'  => $this->getConfig()->getModule(),
                'elements' => $formElements
            ),
            $dbObject->getTable().'SearchForm.php',
            $this->getModule()->getSearchFolder()
        );
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
                    'module' => $this->getConfig()->getModule(),
                    'entity' => $this->str('class', str_replace('id', '', $column->getName())),
                    'property' => (isset($property)) ? $property : '',
                    'entity' => (isset($entity)) ? $entity : ''
                ),
            );
        }


 */



    }

}
