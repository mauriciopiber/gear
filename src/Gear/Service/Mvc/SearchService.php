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
            } elseif($column->getDataType() == 'datetime') {
                $speciality = 'date';
            } elseif($dbObject->isForeignKey($column)) {
                $speciality = 'select';
            } else {
                continue;
            }

            $columnData[***REMOVED*** = array(
            	'speciality' => $speciality,
                'data' => array(
                    'data' => $this->str('var', $column->getName()),
                    'module' => $this->getConfig()->getModule(),
                    'entity' => $this->str('class', str_replace('id', '', $column->getName()))
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
