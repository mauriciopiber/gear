<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;

class UniqueId extends Varchar
{
    protected $uniqueId;

    public function getFixtureData($iterator)
    {
        $this->uniqueId = uniqid(true, true);

        return sprintf(
            '                \'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $this->uniqueId
        ).PHP_EOL;
    }

    public function getFilterFormElement()
    {
        $element = '';
        return $element;
    }

}
