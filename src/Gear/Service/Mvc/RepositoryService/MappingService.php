<?php
namespace Gear\Service\Mvc\RepositoryService;

use Gear\Service\AbstractJsonService;
use Gear\Common\SpecialityServiceTrait;


class MappingService extends AbstractJsonService
{
    use SpecialityServiceTrait;

    protected $aliaseStack;

    public function getAliaseStack()
    {
        return $this->aliaseStack;
    }

    public function setAliaseStack(array $aliaseStack)
    {
        $this->aliaseStack = $aliaseStack;
        return $this;
    }

    public function getMainAliase()
    {
        return $this->aliaseStack[0***REMOVED***;
    }

    public function concatenateAliase($tableAliase)
    {
        if (in_array($tableAliase,  $this->getAliaseStack())) {
            do {
                $tableAliase .= 'x';
            } while (in_array($tableAliase, $this->getAliaseStack()));
        }
        return $tableAliase;
    }

    public function getRepositoryMapping()
    {
        $this->getEventManager()->trigger('getInstance', $this);
        $db = $this->getInstance();

        $callable = function($a, $b) {
            return $a. substr($b, 0, 1);
        };

        $line = '';


        $columns = $db->getTableColumns();

        $map = array();

        foreach ($columns as $i => $column) {


            $columnName = $column->getName();

            if ($columnName == 'created' || $columnName == 'updated') {
                continue;
            }

            $tableAliase = '';
            $label = '';
            $ref = '';
            $name = '';
            $type = '';
            $dataType = $column->getDataType();
            if ($db->isForeignKey($column)) {
                $tableReference = $db->getForeignKeyReferencedTable($column);

                $tableAliase = array_reduce(explode('_', $tableReference), $callable);

                $tableAliase = $this->concatenateAliase($tableAliase);

                var_dump($tableAliase);

                $stacks = $this->getAliaseStack();

                if ($stacks == null) {
                    $this->setAliaseStack(array($tableAliase));
                } elseif(is_array($stacks)) {
                    $this->setAliaseStack(array_merge($this->getAliaseStack(),array($tableAliase)));
                }



                $schema = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));

                $columns = $schema->getColumns($tableReference);

                foreach ($columns as $i => $columnItem) {
                    if ($columnItem->getDataType() == 'varchar') {
                        $use = $columnItem->getName();
                        break;
                    }
                }
                if (!isset($use)) {
                    $use = 'id_'.$tableReference;
                }

                $ref = sprintf('%s.%s', $tableAliase, $this->str('var', $use));
                //ref
                $type = 'join';

                $table = true;

            } else {
                $tableAliase = $this->getMainAliase();
                if ($db->isPrimaryKey($column)) {
                    $type = 'primary';

                } else {

                    switch ($dataType) {
                    	case 'decimal':

                    	    $type = 'money';

                    	    break;

                    	case 'date':
                    	case 'datetime':
                    	case 'time':
                    	    $type = 'date';
                    	    break;
                    	case 'text':
                    	case 'varchar':

                    	    $type = 'text';
                    	    break;
                    	case 'int':
                    	    $type = 'int';
                    	    break;
                    	default:
                    	    throw new \Exception(sprintf('Type %s can\'t be found', $dataType));
                    	    break;
                    }
                }
                $ref = sprintf('%s.%s', $tableAliase, $this->str('var', $columnName));
            }

            //pegar specialidade na honra!

            $specialityService = $this->getSpecialityService();

            $specialityName = $this->getGearSchema()->getSpecialityByColumnName($column->getName(), $db->getTable());

            if (isset($table) && $table) {
                $tableString = 'true';
            } else {
                $specialityName = $this->getGearSchema()->getSpecialityByColumnName($column->getName(), $db->getTable());

                if ($dataType == 'text') {
                    $tableString = 'false';
                } elseif ($specialityName !== null) {
                    $tableString = 'false';
                } else {
                    $tableString = 'true';
                }
            }

            $label = $this->str('label', $columnName);
            $name  = $this->str('var', $columnName);


            $line .= sprintf(
                '            \'%s\' => array('.PHP_EOL.
                '                \'label\' => \'%s\','.PHP_EOL.
                '                \'ref\' => \'%s\','.PHP_EOL.
                '                \'type\' => \'%s\','.PHP_EOL.
                '                \'aliase\' => \'%s\','.PHP_EOL.
                '                \'table\' => %s'.PHP_EOL.
                '            ),',
                $name,
                $label,
                $ref,
                $type,
                $tableAliase,
                $tableString
            ).PHP_EOL;


        }

        return $line;
    }
}
