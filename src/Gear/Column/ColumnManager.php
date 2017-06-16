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

    }


    public function generateCode(string $columnPart, array $rulesMap)
    {

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
