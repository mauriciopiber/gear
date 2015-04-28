<?php
namespace Gear\Service\Column\Datetime;

use Gear\Service\Column\Datetime;
use Gear\Service\Column\AbstractDateTime;
use Gear\Service\Column\SearchFormInterface;

class DatetimePtBr extends Datetime implements SearchFormInterface
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'datetime') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    public function getFixtureDefault($number)
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 01:01:01');
        return $date->format('d/m/Y H:i:s');
    }

    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getFixtureDatabase($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }

    /**
     *
     * @return string
     */
    public function getFixtureDatabase($number)
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 01:01:01');
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s->format(\'d/m/Y H:i:s\')', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->getInsertTime()->format('Y-m-d H:i:s'));

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $date->format('d/m/Y H:i:s')
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->getInsertTime()->format('Y-m-d H:i:s'));

        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => new \DateTime(\'%s\'),',
            $this->str('var', $this->column->getName()),
            $date->format($this->getDateTimeGlobalFormat())
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->getUpdateTime()->format('Y-m-d H:i:s'));

        $update = '            ';
        $update .= sprintf(
            '\'%s\' => \'%s\',',
            $this->str('var', $this->column->getName()),
            $date->format('d/m/Y H:i:s')
        ).PHP_EOL;

        return $update;
    }

    /**
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     */
    public function getFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var} = new Element\DateTime('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '{$elementName}',
            'id' => '{$elementName}',
            'type' => 'datetime',
            'step' => 'any',
            'class' => 'form-control datetime-pt-br'
        ));
        \${$var}->setFormat('d/m/Y H:i:s');
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    public function getSearchFormElement()
    {

        $var         = $this->getColumnVar($this->column);
        $elementName = $this->str('var', $this->column->getName());
        $label       = $this->str('label', $this->column->getName());

        $element = <<<EOS
        \${$var}Pre = new Element\DateTime('{$elementName}Pre');
        \${$var}Pre->setAttributes(array(
            'name' => '{$elementName}Pre',
            'id' => '{$elementName}Pre',
            'type' => 'datetime',
            'step' => 'any',
            'class' => 'form-control datetime-pt-br'
        ));
        \${$var}Pre->setFormat('d/m/Y H:i:s');
        \${$var}Pre->setLabel('$label de');
        \$this->add(\${$var}Pre);

        \${$var}Pos = new Element\DateTime('{$elementName}Pos');
        \${$var}Pos->setAttributes(array(
            'name' => '{$elementName}Pos',
            'id' => '{$elementName}Pos',
            'type' => 'datetime',
            'step' => 'any',
            'class' => 'form-control datetime-pt-br'
        ));
        \${$var}Pos->setFormat('d/m/Y H:i:s');
        \${$var}Pos->setLabel('até');
        \$this->add(\${$var}Pos);

EOS;
        return $element;
    }

    public function getSearchViewElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
    <div class="col-lg-12">
        <div class="form-group">
             <?php echo \$this->formRow(\$form->get('{$elementName}Pre'));?>
        </div>
        <div class="form-group">
             <?php echo \$this->formRow(\$form->get('{$elementName}Pos'));?>
        </div>
    </div>

EOS;
        return $element;
    }

    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        <td>
            <?php echo (\$this->$elementName !== null) ? \$this->escapeHtml(\$this->{$elementName}->format('d/m/Y H:i:s')) : ''; ?>
        </td>

EOS;
        return $element;
    }
}
