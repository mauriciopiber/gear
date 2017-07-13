<?php
namespace Gear\Column;

use GearJson\Column\ColumnManagerInterface;
use Gear\Column\Integer\PrimaryKey;
use Gear\Column\Varchar\UniqueId;
use Gear\Column\Varchar\UploadImage;

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

    private $excludedColumns;

    const EMPTY = '';

    /**
     * Constructor
     *
     * @return ColumnManager
     */
    public function __construct(array $columns, array $excludedColumns = [***REMOVED***)
    {
        $this->setColumns($columns);
        $this->setExcludedColumns($excludedColumns);
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

    public function getColumnNamesNotNullable()
    {
        $names = [***REMOVED***;

        foreach ($this->getColumns() as $columnData) {

            if ($columnData->getColumn()->isNullable() == false) {
                continue;
            }

            if ($columnData instanceof UniqueId) {
                continue;
            }

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData instanceof UploadImage) {
                continue;
            }

            $names[***REMOVED*** = $columnData->getColumn()->getName();
        }

        return $names;


    }

    public function filter(array $types)
    {
        $imagesArray = [***REMOVED***;

        foreach ($this->getColumns() as $columnData) {
            if (in_array(get_class($columnData), $types)) {
                $imagesArray[***REMOVED*** = $columnData;
            }
        }

        return $imagesArray;
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

    public function isAllNullable()
    {
        $isAllNullable = true;

        foreach ($this->getColumns() as $columnData) {
            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData->getColumn()->isNullable() == false) {
                $isAllNullable = false;
            }
        }

        return $isAllNullable;
    }

    public function extractCodeAll()
    {

    }

    public function generateCodeAll()
    {

    }

    public function getAllColumns()
    {

    }

    public function extractCode(string $method, $onlyOne, $exclude = [***REMOVED***, $identify = null)
    {
        $verifyOne = [***REMOVED***;

        if (is_array($onlyOne) && count($onlyOne) > 0) {
            foreach ($onlyOne as $columnClass) {
                $verifyOne[$columnClass***REMOVED*** = false;
            }
        }

        $data = [***REMOVED***;

        foreach ($this->getColumns() as $columnData) {

            $className = get_class($columnData);

            if (in_array($className, $exclude)) {
                continue;
            }

            if (false === method_exists($columnData, $method)) {
                continue;
            }

            if (isset($verifyOne[$className***REMOVED***) && $verifyOne[$className***REMOVED*** === true) {
                continue;
            }

            $data[***REMOVED*** = ($identify === null)
            ? $columnData->{$method}()
            : $columnData->{$method}($identify);

            if (isset($verifyOne[$className***REMOVED***) && $verifyOne[$className***REMOVED*** === false) {
                $verifyOne[$className***REMOVED*** = true;
                continue;
            }

            if (!isset($verifyOne[$className***REMOVED***) && $onlyOne === true) {
                $verifyOne[$className***REMOVED*** = true;
                continue;
            }
        }

        return $data;
    }

    public function generateCode(string $method, $onlyOne, $exclude = [***REMOVED***, $identify = null)
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

            if (in_array($className, $exclude)) {
                continue;
            }

            if (false === method_exists($columnData, $method)) {
                continue;
            }

            if (isset($verifyOne[$className***REMOVED***) && $verifyOne[$className***REMOVED*** === true) {
                continue;
            }

            $template .= ($identify === null)
                ? $columnData->{$method}()
                : $columnData->{$method}($identify);

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

    public function setExcludedColumns(array $excludedColumns)
    {
        $this->excludedColumns = $excludedColumns;
        return $this;
    }

    public function getExcludedColumns()
    {
        return $this->excludedColumns;
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
