<?php
namespace Gear\Service\Column\Varchar;

use Gear\Service\Column\Varchar;
use Gear\Service\Column\ServiceAwareInterface;

class UniqueId extends Varchar implements ServiceAwareInterface
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

    public function getServiceInsertBody()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        \$data['$elementName'***REMOVED*** = uniqid(true, true);

EOS;

        return $element;
    }

    public function getServiceUpdateBody()
    {
        return $this->getServiceInsertBody();
    }

    public function getServiceUpdateSuccess()
    {
        return '';
    }

    public function getServiceInsertSuccess()
    {
        return '';
    }
}
