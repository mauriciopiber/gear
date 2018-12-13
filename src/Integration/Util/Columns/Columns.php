<?php
namespace Gear\Integration\Util\Columns;

use Exception;
use Gear\Integration\Util\Names\NamesReplaceInterface;
use Gear\Util\String\StringService;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Util/Columns
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class Columns
{
    public function __construct()
    {
        $this->stringService = new StringService();
    }

    public function getForeignKeys($columnType)
    {
        $columns = $this->factoryColumns($columnType);

        $foreignKeys = [***REMOVED***;

        foreach ($columns as $name => $config) {
            if (isset($config['properties'***REMOVED***) && in_array('foreignKey', $config['properties'***REMOVED***)) {
                $foreignKeys[***REMOVED*** = $name;
            }
        }

        return empty($foreignKeys) ? null : $foreignKeys;
    }

    private function factoryColumns($columnType)
    {
        $columns = [***REMOVED***;
        switch ($columnType) {
            case 'Basic':
                $columns = BasicColumnsInterface::COLUMNS;
                break;
            case 'Complete':
                $columns = array_merge(
                    TextColumnsInterface::COLUMNS,
                    NumericColumnsInterface::COLUMNS,
                    DatesColumnsInterface::COLUMNS,
                    VarcharColumnsInterface::COLUMNS
                );
                break;
            case 'Varchar':
                $columns = VarcharColumnsInterface::COLUMNS;
                break;
            case 'Dates':
                $columns = DatesColumnsInterface::COLUMNS;
                break;
            case 'Text':
                $columns = TextColumnsInterface::COLUMNS;
                break;
            case 'Numeric':
                $columns = NumericColumnsInterface::COLUMNS;
                break;
            default:
                throw new Exception('Type not found: '.$columnType);
                break;
        }

        return $columns;
    }

    private function createColumnSuffix($suite, $columnSuffix)
    {
        $label = NamesReplaceInterface::NAMES;

        $text = [***REMOVED***;

        foreach ($columnSuffix as $option) {
            $text[***REMOVED*** = $this->stringService->str('uline', ($suite->isUsingLongName()) ? $option : $label[$option***REMOVED***);
        }

        return implode('_', $text);
    }

    private function addSuffixToColumns($suite, $columns, $columnSuffix)
    {
        if (empty($columnSuffix)) {
            return $columns;
        }

        $fixed = [***REMOVED***;

        $columnSuffix = $this->createColumnSuffix($suite, $columnSuffix);

        foreach ($columns as $name => $column) {
            $newName = $name.'_'.$columnSuffix;
            $fixed[$newName***REMOVED*** = $column;
        }

        return $fixed;
    }

    public function reduceMap($key)
    {
        if (!isset(NamesReplaceInterface::NAMES[$key***REMOVED***)) {
            throw new \Exception(sprintf('Missing reduce map:%s', $key));
        }
        return NamesReplaceInterface::NAMES[$key***REMOVED***;
    }

    public function reduceColumn($column)
    {
        $columnsPiece = explode('_', $column);

        $reduced = [***REMOVED***;

        foreach ($columnsPiece as $piece) {
            $reduced[***REMOVED*** = $this->reduceMap($piece);
        }


        return implode('_', $reduced);
    }

    public function reduce($columns)
    {
        $reduce = [***REMOVED***;
        foreach ($columns as $index => $column) {
            $indexReduced = $this->reduceColumn($index);
            $reduce[$indexReduced***REMOVED*** = $column;
        }

        return $reduce;
    }

    public function getColumns($suite, $columnSuffix)
    {
        $columnType = $suite->getColumnType();

        $columns = $this->factoryColumns($columnType);
        $columns = $this->addSuffixToColumns($suite, $columns, $columnSuffix);

        if ($suite->isUsingLongName() === false) {
            $columns = $this->reduce($columns);
        }
//var_dump($suite->isUsingLongName());
  //      var_dump($columns);
    //    die();

        return $columns;
    }
}
