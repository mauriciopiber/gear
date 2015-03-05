<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;
use Gear\Service\Column\ServiceInterface;

class UniqueId extends Varchar implements ServiceInterface
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

    public function getService()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        \$data['$elementName'***REMOVED*** = uniqid(true, true);

EOS;

        return $element;
    }
}
