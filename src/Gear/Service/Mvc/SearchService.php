<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

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

        $this->getAbstract();

        $columns = $dbObject->getTableColumns();

        $columnData = array();

        foreach ($columns as $i => $column) {

            if ($column->getDataType() == 'decimal') {
                $speciality = 'money';
            } elseif($column->getDataType() == 'date') {
                $speciality = 'date';
            } elseif($column->getDataType() == 'time') {
                $speciality = 'time';
            } elseif($column->getDataType() == 'datetime') {
                $speciality = 'datetime';
            } elseif($dbObject->isForeignKey($column)) {
                $speciality = 'select';
                $dbObject->setServiceLocator($this->getServiceLocator());
                $property = $this->str('var', $dbObject->getFirstValidPropertyFromForeignKey($column));


            } else {
                continue;
            }

            $columnData[***REMOVED*** = array(
            	'speciality' => $speciality,
                'data' => array(
                    'data' => $this->str('var', $column->getName()),
                    'module' => $this->getConfig()->getModule(),
                    'entity' => $this->str('class', str_replace('id', '', $column->getName())),
                    'property' => (isset($property)) ? $property : ''
                ),
            );
        }






        $this->createFileFromTemplate(
            'template/src/form/search/full.search.phtml',
            array(
                'class'   => $dbObject->getTable(),
                'var'     => $this->str('var', $dbObject->getTable()),
                'module'  => $this->getConfig()->getModule(),
                'data' => $columnData
            ),
            $dbObject->getTable().'SearchForm.php',
            $this->getModule()->getSearchFolder()
        );
    }

}
