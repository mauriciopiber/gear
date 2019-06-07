<?php
namespace Gear\Integration\Util\Columns;

use Gear\Integration\Util\Columns\Columns;

trait ColumnsTrait
{
    protected $columns;

    /**
     * Get Columns
     *
     * @return Gear\Integration\Util\Columns\Columns
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set Columns
     *
     * @param Columns $columns Columns
     *
     * @return \Gear\Integration\Util\Columns\Columns
     */
    public function setColumns(
        Columns $columns
    ) {
        $this->columns = $columns;
        return $this;
    }
}
