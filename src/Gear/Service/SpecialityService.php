<?php
namespace Gear\Service;

class SpecialityService extends \Gear\Service\AbstractService
{
    public function getSpecialityByField($column)
    {
        $file = $this->readJson();
        $file = get_object_vars($file);

        if ($column->getTable() instanceof \Gear\ValueObject\Table) {
           $tableName = $column->getTable()->getName();
        } elseif (is_string($column->getTable())) {
           $tableName = $column->getTable();
        } else {
            throw new \Exception('Tabela não foi especificada corretamente');
        }

        if (isset($file[$tableName***REMOVED***)) {
            $filesColumns = get_object_vars($file[$tableName***REMOVED***);
            if (isset($filesColumns[$column->getName()***REMOVED***)) {
                return $filesColumns[$column->getName()***REMOVED***;
            }
        }

        return '';
    }

    public function getAllSpeciality()
    {
        $table = $this->getServiceLocator()->get('tableService');

        $file = $this->readJson();
        $file = get_object_vars($file);
        $specialityArray = [***REMOVED***;

        foreach ($file['tables'***REMOVED*** as $i => $v) {

            $columns = get_object_vars($v);

            foreach ($columns as $a => $b) {

                //var_dump($a); Nome do Campo
                //var_dump($b); Nome da Especialidade Ou Objecto de Especialidade + Alvo
                $speciality = new \Gear\ValueObject\Speciality();
                //$speciality->setTable($table->getTable($i));
                $speciality->setName($a);
                if (is_string($b)) {
                    $speciality->setColumn($b);
                } else {
                    $specialityTarget = get_object_vars($b);
                    foreach ($specialityTarget as $i => $v) {
                        $speciality->setColumn($i);
                        $speciality->setTarget($v);
                    }
                }
                $specialityArray[***REMOVED*** = $speciality;
            }
        }

        return $specialityArray;
    }

    public function readJson()
    {
        $file = realpath(__DIR__.'/../../../../../metadata/bigmarket-decuero/').'/special-fields.json';
        $file = file_get_contents($file);
        $file = \Zend\Json\Json::decode($file);

        return $file;
    }

    public function getSpecialitySchemaByArray()
    {
        echo \Zend\Json\Json::encode(array(
            'tables' => array(
                'tablesA' => array(
                    'fieldC' => 'speciality1',
                    'fieldE' => 'speciality5',
                ),
                'tablesE' => array(
                    'fieldX' => 'speciality6'
                )
            )
        ));
    }
}
