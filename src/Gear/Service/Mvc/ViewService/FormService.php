<?php
namespace Gear\Service\Mvc\ViewService;

use Gear\Service\AbstractJsonService;
use Gear\Common\SpecialityServiceTrait;


class FormService extends AbstractJsonService
{
    use SpecialityServiceTrait;

    public function getViewValues($action)
    {
        $db = $action->getDb()->getTableColumns();
        $primary = $action->getDb()->getPrimaryKeyColumnName();

        $names = [***REMOVED***;

        foreach ($db as $i => $v) {
            if ($v->getName() == $primary) {

                $names[***REMOVED*** = ['label' => 'ID', 'value' => $this->str('var', $v->getName())***REMOVED***;

            } elseif ($constraint = $action->getDb()->getForeignKeyConstraint($v)) {


                $schema = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
                $referencedTable = $constraint->getReferencedTableName();

                $columns = $schema->getColumns($referencedTable);

                foreach ($columns as $a => $b) {

                    if ($b->getDataType() == 'varchar') {
                        $get = $this->str('class', $b->getName());
                        break;
                    }

                }


                if (isset($get)) {
                    $get = $this->str('class', $b->getName());
                }



                //pegar primeiro item varchar da tabela.
                //caso não exista, mostrar primarykey mesmo.

                $names[***REMOVED*** = [
                    'label' => $this->str('label', $v->getName()),
                    'value' => sprintf(
                        '%s->get%s()',$this->str('var', $v->getName()), $get
                     )
                ***REMOVED***;


            } elseif ($v->getName() != $primary) {

                $names[***REMOVED*** = ['label' => $this->str('label', $v->getName()), 'value' => $this->str('var', $v->getName())***REMOVED***;

            }
        }

        return $names;
    }

    public function getFormElements($action)
    {
        $specialityService = $this->getSpecialityService();

        $db = $action->getDb()->getTableColumns();
        $primary = $action->getDb()->getPrimaryKeyColumnName();
        $names = [***REMOVED***;

        foreach ($db as $i => $v) {
            if ($v->getName() != $primary) {

                $specialityName = $this->getGearSchema()->getSpecialityByColumnName($v->getName(), $action->getDb()->getTable());

                if ($specialityName) {
                    $speciality = $specialityService->getSpecialityByName($specialityName);
                } else {
                    $speciality = array();
                }

                $idName = $this->str('var', $v->getName());
                if (strlen($idName) > 18) {
                    $var = substr($idName, 0, 15);
                } else {
                    $var = $idName;
                }

                $class = ['class' => 'form-control'***REMOVED***;

                if ($v->getDataType() == 'decimal') {
                    $class['class'***REMOVED*** = $class['class'***REMOVED***.' money';
                } elseif($v->getDataType() == 'date' ) {
                    $class['class'***REMOVED*** = $class['class'***REMOVED***.' date-pt-br';
                } elseif($v->getDataType() == 'datetime') {
                    $class['class'***REMOVED*** = $class['class'***REMOVED***.' datetime-pt-br';
                }

                $names[***REMOVED*** = array_merge(array('name' => $idName, 'var' => $var, 'speciality' => null), $speciality, $class);
            }
        }


        return $names;
    }

}
