<?php
namespace Gear\Service\Mvc\ViewService;

use Gear\Service\AbstractJsonService;
use Gear\Common\SpecialityServiceTrait;

class TableService extends AbstractJsonService
{
    use SpecialityServiceTrait;

    public function getDbBodyRow()
    {
        $this->getEventManager()->trigger('getInstance', $this);

        $db = $this->getInstance();
        $columns = $db->getTableColumns();

        $text = '';
        foreach ($columns as $i => $v) {

            $text .= '            <td>'.PHP_EOL;

            if ($v->getDataType() == 'text' || null !== $this->getGearSchema()->getSpecialityByColumnName($v->getName(), $db->getTable())) {
                continue;
            }

            if ($db->isForeignKey($v)) {

                $db->setServiceLocator($this->getServiceLocator());
                $property = $this->str('class', $db->getFirstValidPropertyFromForeignKey($v));

                $text .= sprintf('                <?php echo ($this->object->get%s() !== null) ? $this->escapeHtml($this->object->get%s()->get%s()) : \'\'; ?>', $this->str('class', $v->getName()), $this->str('class', $v->getName()), $property).PHP_EOL;
            } elseif ($v->getDataType() == 'datetime') {
                $text .= sprintf('                <?php echo $this->escapeHtml($this->object->get%s()->format(\'d/m/Y H:i:s\')); ?>', $this->str('class', $v->getName())).PHP_EOL;
            } elseif ($v->getDataType() == 'time') {
                $text .= sprintf('                <?php echo $this->escapeHtml($this->object->get%s()->format(\'H:i:s\')); ?>', $this->str('class', $v->getName())).PHP_EOL;
            } elseif ($v->getDataType() == 'date') {
                $text .= sprintf('                <?php echo $this->escapeHtml($this->object->get%s()->format(\'d/m/Y\')); ?>', $this->str('class', $v->getName())).PHP_EOL;
            } elseif ($v->getDataType() == 'decimal') {
                $text .= sprintf('                <?php echo $this->escapeHtml($this->currencyFormat($this->object->get%s())); ?>', $this->str('class', $v->getName())).PHP_EOL;
            } elseif ($v->getDataType() != 'text') {
                $text .= sprintf('                <?php echo $this->escapeHtml($this->object->get%s()); ?>', $this->str('class', $v->getName())).PHP_EOL;
            }

            $text .= '            </td>'.PHP_EOL;
        }
        return $text;
    }

}
