<?php
namespace Gear\Column;

use GearJson\Column\ColumnManagerInterface;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Column
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ColumnManager implements ColumnManagerInterface
{
    private $columns;

    const EMPTY = '';

    /**
     * Constructor
     *
     * @return ColumnManager
     */
    public function __construct(array $columns)
    {
        $this->setColumns($columns);
        return $this;
    }

    public function generateSchema($schema)
    {
        $output = [***REMOVED***;

        foreach ($schema as $positionName => $subpositions) {

            $output[$positionName***REMOVED*** = [***REMOVED***;

            foreach ($subpositions as $subIndex => $options) {

                $output[$positionName***REMOVED***[$subIndex***REMOVED*** = self::EMPTY;

                foreach ($options as $methodName => $onlyOne) {

                    $output[$positionName***REMOVED***[$subIndex***REMOVED*** .= $this->generateCode($methodName, $onlyOne);
                }

            }
        }
        //1 - posição
        //2 - subposicao
        return $output;
    }

    public function isAssociatedWith($class)
    {
        $associated = false;

        foreach ($this->getColumns() as $column) {

            if (get_class($column) === $class) {
                $associated = true;
                break;
            }
        }

        return $associated;
    }

    public function getColumnNames($class)
    {
        $imagesArray = [***REMOVED***;

        foreach ($this->getColumns() as $columnData) {

            $className = get_class($columnData);

            if ($columnData instanceof $class) {
                $imagesArray[***REMOVED*** = $columnData->getColumn()->getName();
            }
        }

        return $imagesArray;
    }


    public function generateCode(string $method, $onlyOne)
    {
        $verifyOne = [***REMOVED***;

        if (is_array($onlyOne) && count($onlyOne) > 0) {
            foreach ($onlyOne as $columnClass) {
                $verifyOne[$columnClass***REMOVED*** = false;
            }
        }

        $template = self::EMPTY;

        foreach ($this->getColumns() as $columnData) {

            $className = get_class($columnData);

            if (false === method_exists($columnData, $method)) {
                continue;
            }

            if (isset($verifyOne[$className***REMOVED***) && $verifyOne[$className***REMOVED*** === true) {
                continue;
            }

            $template .= $columnData->{$method}();

            if (isset($verifyOne[$className***REMOVED***) && $verifyOne[$className***REMOVED*** === false) {
                $verifyOne[$className***REMOVED*** = true;
                continue;
            }

            if (!isset($verifyOne[$className***REMOVED***) && $onlyOne === true) {
                $verifyOne[$className***REMOVED*** = true;
                continue;
            }
        }

        return $template;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
    }

}
