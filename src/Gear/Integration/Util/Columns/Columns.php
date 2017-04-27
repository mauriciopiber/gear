<?php
namespace Gear\Integration\Util\Columns;

use Exception;

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
        switch  ($columnType) {
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

    private function createColumnSuffix($columnSuffix)
    {

        $label = [
            'nullable' => 'nul',
            'unique' => 'uni',
            'upload-image' => 'upl',
            'complete' => 'cmp',
            'basic' => 'bsc',
            'dates' => 'dts',
            'numeric' => 'nmr',
            'varchar' => 'vrc',
            'text' => 'txt',
            'low-strict' => 'lws',
            'strict' => 'str'
        ***REMOVED***;

        $text = [***REMOVED***;

        foreach ($columnSuffix as $option) {
            $text[***REMOVED*** = $label[$option***REMOVED***;
        }


        return implode('_', $text);
    }

    private function addSuffixToColumns($columns, $columnSuffix)
    {
        if (empty($columnSuffix)) {
            return $columns;
        }

        $fixed = [***REMOVED***;

        $columnSuffix = $this->createColumnSuffix($columnSuffix);

        foreach ($columns as $name => $column) {
            $newName = $name.'_'.$columnSuffix;
            $fixed[$newName***REMOVED*** = $column;
        }

        return $fixed;
    }

    public function getColumns($columnType, $columnSuffix)
    {
        $columns = $this->factoryColumns($columnType);
        $columns = $this->addSuffixToColumns($columns, $columnSuffix);
        return $columns;
    }
}
