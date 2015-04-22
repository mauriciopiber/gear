<?php
namespace Gear\Service\Column;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Object\ColumnObject;

abstract class AbstractColumn extends AbstractJsonService
{

    protected $column;

    protected $serviceLocator;

    public function __construct(ColumnObject $column)
    {
        $this->setColumn($column);
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function setColumn(ColumnObject $column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Função principal usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewColumnLayout($label, $value)
    {
        return sprintf(
            '                <tr><td><?php echo $this->translate(\'%s\');?></td><td><?php echo $this->escapeHtml(%s);?></td></tr>%s',
            $label,
            $value,
            PHP_EOL
        );
    }

    /**
     * Função default que será chamado em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     * caso não esteja declarada a função nas classes filhas.
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s', $this->str('var', $this->column->getName()))
        );
    }


    public function getBaseMessage($base, $whitespace = false, $isPrimaryKey = false)
    {
        if ($whitespace) {
            $data = '%s %s';
        } else {
            $data = '%s%s';
        }

        if ($isPrimaryKey) {
            $baseMessage = $base;
        } else {
            $baseMessage = sprintf($data, $base, $this->str('label', $this->column->getName()));
        }

        if (strlen($baseMessage) > $this->column->getCharacterMaximumLength() && $this->column->getDataType() == 'varchar') {
            $baseMessage = substr($baseMessage, 0, $this->column->getCharacterMaximumLength());
        }
        return $baseMessage;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     * Função default que será chamada caso não esteja declarada nenhuma função de fixture nas classes filhas.
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%02d%s\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $this->str('label', $this->column->getName())
        ).PHP_EOL;
    }

    /**
     *
     * @return string
     */
    public function getFixtureDefault($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d',  $this->str('var', $this->column->getName()), $number)
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertArrayByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage('insert', $this->column);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',
EOS;
        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertSelectByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage('insert', $this->column);

        $insert = <<<EOS
            '$columnVar' => '$columnValue',
EOS;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para array de update dos dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateArrayByColumn()
    {
        $columnVar = $this->str('var', $this->column->getName());
        $columnValue = $this->getBaseMessage('update', $this->column);

        $update = <<<EOS
            '$columnVar' => '$columnValue',
EOS;
        return $update;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getBaseMessage('insert', $this->column);

        $insertAssert = <<<EOS
            \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());
EOS;
        return $insertAssert;
    }

    /**
     * Usado nos testes unitários de Repository, Service, Controller para assert com os dados do array de atualização de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getUpdateAssertByColumn()
    {
        $columnClass = $this->str('class', $this->column->getName());
        $columnValue = $this->getBaseMessage('update', $this->column);

        $updateAssert = <<<EOS
            \$this->assertEquals('$columnValue', \$resultSet->get$columnClass());
EOS;
        return $updateAssert;
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
        \${$var} = new Element('{$elementName}');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'type' => 'text',
            'class' => 'form-control'
        ));
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    public function getViewFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS
        <div class="form-group">
            <?php echo \$this->formRow(\$form->get('$elementName'));?>
        </div>

EOS;
        return $element;
    }

    public function getIdFormElement()
    {
        return $this->str('var', $this->column->getName());
    }

    public function getFilterFormElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $name = '';
        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
            )
        );

EOS;

        return $element;
    }

    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS

        <td>
            <?php echo \$this->escapeHtml(\$this->$elementName); ?>
        </td>

EOS;
        return $element;
    }
}
