<?php
namespace Gear\Service\Mvc\ViewService;

use Gear\Service\AbstractJsonService;
use Gear\Common\SpecialityServiceTrait;

class SearchService extends AbstractJsonService
{
    use SpecialityServiceTrait;

    public function getSearchData()
    {
        $this->getEventManager()->trigger('getInstance', $this);

        $db = $this->getInstance();

        $columns = $db->getTableColumns();

        $fieldsData = [***REMOVED***;
        foreach ($columns as $i => $columnItem) {

            if ($columnItem->getDataType() == 'decimal') {
                $class = 'form-control money';
                $speciality = 'money';
            } elseif ($columnItem->getDataType() == 'datetime') {

                $class = 'form-control date-pt-br';
                $speciality = 'date';
            } elseif ($db->isForeignKey($columnItem)) {

                $class = 'form-control';
                $speciality = 'select';
            } else {
                continue;
            }

            $fieldsData[***REMOVED*** = array(
                'speciality' => $speciality,
                'name' => $this->str('class', $columnItem->getName()),
                'var' => $this->str('var', $columnItem->getName()),
                'class' => $class
            );

        }

        return $fieldsData;

    }
}
