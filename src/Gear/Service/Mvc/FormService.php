<?php
/**
 *
 * @author piber
 * Um serviço é o ítem mais importante do DDD.
 * Um serviço precisa ser testado com TDD.
 * Um serviço não possui interface então não precisa ser testado com codeception.
 * Um serviço pode extender outro serviço.
 * Um serviço precisa ser adicionado ao invokables do Module.php ao final do processo.
 *
 */
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class FormService extends AbstractJsonService
{
    protected $specialityService;

    public function getLocation()
    {
        return $this->getModule()->getSrcModuleFolder().'/Form';
    }

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractForm.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function getSpecialityService()
    {
        if (!isset($this->specialityService)) {
            $this->specialityService = $this->getServiceLocator()->get('specialityService');
        }
        return $this->specialityService;
    }

    public function getFormInputValues($table)
    {
        $columns = $table->getTableColumns();

        $specialityService = $this->getSpecialityService();


        $inputs = [***REMOVED***;
        $columns = $table->getTableColumns();
        foreach ($columns as $i => $column) {


            $extra = $this->getColumnType($column, $table);

            $var = $this->getColumnVar($column);

            $specialityName = $this->getGearSchema()->getSpecialityByColumnName($column->getName(), $table->getTable());

            if ($specialityName) {
                $speciality = $specialityService->getSpecialityByName($specialityName);
            } else {
                $speciality = array();
            }


            $inputs[***REMOVED*** = array_merge(array(
                'speciality' => null,
                'var' => $var,
            	'name' => $this->str('var', $column->getName()),
                'id' => $this->str('var', $column->getName()),
                'label' => $this->str('label', $column->getName()),
            ), $extra, $speciality);
        }

        return $inputs;
    }

    public function getColumnType($column, $table)
    {
        $primaryKey = $table->getPrimaryKeyColumnName();

        $extra = array();
        switch ($column->getDataType()) {
        	case 'text':
        	    $extra['type'***REMOVED*** = 'textarea';
        	    break;
        	case 'varchar':
        	    $extra['type'***REMOVED*** = 'text';
        	    break;
        	case 'int':
        	    if ($primaryKey == $column->getName()) {
        	        $extra['type'***REMOVED*** = 'hidden';
        	    } elseif($table->isForeignKey($column)) {
        	        $extra['type'***REMOVED*** = 'select';
        	        $extra['module'***REMOVED*** = $this->str('class', $this->getConfig()->getModule());
        	        $extra['entity'***REMOVED*** = $this->str('class', $table->getForeignKeyReferencedTable($column));
        	        $table->setServiceLocator($this->getServiceLocator());
        	        $extra['property'***REMOVED*** = $this->str('var', $table->getFirstValidPropertyFromForeignKey($column));
        	    } else {
        	        $extra['type'***REMOVED*** = 'int';
        	    }
        	    break;
        	case 'decimal':
        	    $extra['type'***REMOVED*** = 'int';
        	    break;
        	case 'datetime':
        	    $extra['type'***REMOVED*** = 'datetime';
        	    break;
    	    case 'date':
    	        $extra['type'***REMOVED*** = 'date';
    	        break;
        	case 'time':
        	    $extra['type'***REMOVED*** = 'time';
        	    break;
        	default:

        	    break;
        }

        if (!isset($extra['type'***REMOVED***) || empty($extra['type'***REMOVED***)) {
            throw new \Exception(sprintf('Column type not found for %s %s', $column->getName(), $column->getDataType()));
        }

        return $extra;
    }

    public function getColumnVar($column)
    {
        if (strlen($column->getName()) > 18) {
            $var = $this->str('var', substr($column->getName(), 0, 15));
        } else {
            $var = $this->str('var', $column->getName());
        }
        return $var;
    }


    public function introspectFromTable($table)
    {

        $columns = $table->getTableColumns();

        $this->getAbstract();

        $src = $this->getGearSchema()->getSrcByDb($table, 'Form');

        $inputValues = $this->getFormInputValues($table);


        $this->createFileFromTemplate(
            'template/src/form/full.form.phtml',
            array(
                'var' => $this->str('var', $src->getName()),
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule(),
                'elements' => $inputValues
            ),
            $src->getName().'.php',
            $this->getModule()->getFormFolder()
        );
    }

    public function getAbstract()
    {
        if (!$this->hasAbstract()) {
            $this->createFileFromTemplate(
                'template/src/form/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule()
                ),
                'AbstractForm.php',
                $this->getModule()->getFormFolder()
            );
        }
    }

    public function create($src)
    {
        $this->getAbstract();

        $this->createFileFromTemplate(
            'template/test/unit/form/src.form.phtml',
            array(
                'serviceNameUline' => $this->str('var', $src->getName()),
                'serviceNameClass'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'Test.php',
            $this->getModule()->getTestFormFolder()
        );

        $this->createFileFromTemplate(
            'template/src/form/src.form.phtml',
            array(
                'class'   => $src->getName(),
                'module'  => $this->getConfig()->getModule()
            ),
            $src->getName().'.php',
            $this->getModule()->getFormFolder()
        );
    }
}
