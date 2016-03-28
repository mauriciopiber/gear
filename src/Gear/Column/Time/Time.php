<?php
namespace Gear\Column\Time;

use Gear\Column\Datetime\AbstractDateTime;

class Time extends AbstractDateTime
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'time') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    public function getFixtureDefault($number = null)
    {
        unset($number);

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 01:01:01');
        return $date->format('H:i:s');
    }

    public function getFixtureDefaultDb()
    {
        return date('H:i:s');
    }


    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        $minuto = 0;
        $segundo = 2;

        if ($iterator > 23) {
            $hora = 30 - $iterator;
            $segundo += 1;
        } else {
            $hora = $iterator;
        }



        $time = sprintf('%02d:%02d:%02d', $hora, $minuto, $segundo);

        return sprintf(
            '                \'%s\' => \DateTime::createFromFormat(\'H:i:s\', \'%s\'),',
            $this->str('var', $this->column->getName()),
            $time
        ).PHP_EOL;
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s->format(\'H:i:s\')', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para array de inserção de dados.
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
            $date->format('H:i:s')
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para array de inserção de dados.
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
            $date->format('H:i:s')
        ).PHP_EOL;

        return $insert;
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     * Controller para assert com os dados do array de inserção de dados.
     * @param array $this->column Colunas válidas.
     * @return string Texto para inserir no template
     */
    public function getInsertAssertByColumn()
    {
        $date = \DateTime::createFromFormat(
            $this->getDateTimeGlobalFormat(),
            $this->getInsertTime()->format($this->getDateTimeGlobalFormat())
        );

        $insertAssert = '        ';
        $insertAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->format(\'%s\'));',
            $date->format($this->getTimeGlobalFormat()),
            $this->str('class', $this->column->getName()),
            $this->getTimeGlobalFormat()
        ).PHP_EOL;

        return $insertAssert;
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
        \${$var} = new Element\Time('$elementName');
        \${$var}->setAttributes(array(
            'name' => '$elementName',
            'id' => '$elementName',
            'step' => 'any',
            'class' => 'form-control time'
        ));
        \${$var}->setLabel('$label');
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $php = "<?php echo (\$this->$elementName !== null) ? \$this->escapeHtml("
             . "\$this->{$elementName}->format('H:i:s')) : ''; ?>";


        $element = <<<EOS
        <td>
            $php
        </td>

EOS;
        return $element;
    }
}