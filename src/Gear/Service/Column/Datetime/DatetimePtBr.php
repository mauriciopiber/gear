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
        return date('d/m/Y H:i:s');
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
            \${$var} = new Element\DateTime('{$elementName}Pre');
            \${$var}->setAttributes(array(
                'name' => '{$var}Pre',
                'id' => '{$var}Pre',
                'type' => 'datetime',
                'step' => 'any',
                'class' => 'form-control datetime-pt-br'
            ));
            \${$var}->setFormat('d/m/Y H:i:s');
            \${$var}->setLabel('$label de');
            \$this->add(\${$var});

            \${$var} = new Element\DateTime('{$elementName}Pos');
            \${$var}->setAttributes(array(
                'name' => '{$var}Pos',
                'id' => '{$var}Pos',
                'type' => 'datetime',
                'step' => 'any',
                'class' => 'form-control datetime-pt-br'
            ));
            \${$var}->setFormat('d/m/Y H:i:s');
            \${$var}->setLabel('até');
            \$this->add(\${$var});

EOS;
        return $element;
    }

    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        <td>
            <?php echo (\$this->$elementName !== null) ? \$this->escapeHtml(\$this->$elementName->format('d/m/Y H:i:s')) : ''; ?>
        </td>

EOS;
        return $element;
    }
}
