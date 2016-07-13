<?php
namespace Gear\Column;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\UniqueInterface;

/**
 *
 * Classe pai das colunas
 *
 * Classe que serve como base para o funcionamento das colunas
 *
 *
 * @category   Column
 * @package    Gear
 * @subpackage Column
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
abstract class AbstractColumn extends AbstractJsonService implements UniqueInterface
{

    protected $column;

    protected $serviceLocator;

    protected $uniqueConstraint;

    /**
     * @param \Zend\Db\Metadata\Object\ConstraintObject $uniqueConstraint Constraint Unique.
     *
     * {@inheritDoc}
     * @see \Gear\Column\UniqueInterface::setUniqueConstraint()
     *
     * @return $this
     */
    public function setUniqueConstraint($uniqueConstraint)
    {
        $this->uniqueConstraint = $uniqueConstraint;
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \Gear\Column\UniqueInterface::getUniqueConstraint()
     *
     * @return \Zend\Db\Metadata\Object\ConstraintObject
     */
    public function getUniqueConstraint()
    {
        return $this->uniqueConstraint;
    }


    /**
     * Padrão utilizado para criar Valores. Sempre retorna um valor para ser utilizado no sprintf.
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string Formato utilizado para Form/View
     */
    public function getValue($iterator)
    {
        unset($iterator);
        return '%02d%s';
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu entro com o valor "{$value}" no campo "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     * @param int $line    Número de linhas
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo o valor "{$value}" no campo "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     * @param int $line    Número de linhas
     *
     * @return string
     */
    public function getIntegrationActionList($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
    E eu vejo o campo "{$attribute}" com o valor "{$value}" na linha "{$line}"

EOS;
        return $view;
    }


    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número
     *
     * @return string
     */
    public function getIntegrationActionView($default = 30)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
    E eu vejo o atributo "{$attribute}" com o valor "{$value}"

EOS;
        return $view;
    }


    /**
     * Constroi o objeto Coluna.
     *
     * @param ColumnObject $column Coluna
     */
    public function __construct(ColumnObject $column)
    {
        $this->setColumn($column);
    }

    /**
     * Outra função
     *
     * @TODO Descobrir
     *
     * @param int $numberReference Numero básico.
     *
     * @return string
     */
    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getFixtureDefault($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }

    /**
     * Recebe uma coluna e devolve a variável válida
     *
     * @param ColumnObject $column Coluna a ter o var extraído
     *
     * @return string
     */
    public function getColumnVar($column)
    {
        if (strlen($column->getName()) > 18) {
            $var = $this->str('var', substr($column->getName(), 0, 15));
        } else {
            $var = $this->str('var', $column->getName());
        }
        return $var;
    }


    /**
     * Mais uma função utilizada para criar o banco
     * @TODO descobrir
     *
     * @param int $number Número basico.
     *
     * @return string
     */
    public function getFixtureDatabase($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
        );
    }

    /**
     * Retorna a coluna que está interpretando as regras.
     *
     * @return \Zend\Db\Metadata\Object\ColumnObject
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Informa qual coluna deverá interpretar as regras.
     *
     * @param ColumnObject $column Coluna Utilizada.
     *
     * @return \Gear\Column\AbstractColumn
     */
    public function setColumn(ColumnObject $column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Função principal usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     *
     * @param string $label Label que será utilizado.
     * @param string $value Valor que será utilizado.
     *
     * @return string
     */
    public function getViewColumnLayout($label, $value)
    {
        $value = <<<EOS
                        <tr>
                            <td>
                                <?php echo \$this->translate('{$label}');?>
                            </td>
                            <td>
                                <?php echo \$this->escapeHtml({$value});?>
                            </td>
                        </tr>

EOS;

        return $value;
    }

    /**
     * Função default que será chamado em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     * caso não esteja declarada a função nas classes filhas.
     *
     * @return string
     */
    public function getViewData()
    {
        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s', $this->str('var', $this->column->getName()))
        );
    }

    /**
     * @deprecated Deve ser removido na próxima versão
     *
     * @param unknown $base         Texto Basico.
     * @param string  $whitespace   Se utiliza espaço em branco.
     * @param string  $isPrimaryKey Se é primary_key da tabela.
     *
     * @return unknown|string
     */
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

        if (strlen($baseMessage) > $this->column->getCharacterMaximumLength() &&
            $this->column->getDataType() == 'varchar'
        ) {
            $baseMessage = substr($baseMessage, 0, $this->column->getCharacterMaximumLength());
        }
        return $baseMessage;
    }


    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     * Função default que será chamada caso não esteja declarada nenhuma função de fixture nas classes filhas.
     *
     * @param int $iterator Número da fixture
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \''.$this->getValue($iterator).'\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $this->str('label', $this->column->getName())
        ).PHP_EOL;
    }

    /**
     * Utilizado em testes e2e
     *
     * @param int $number Número específico do teste.
     *
     * @return string
     */
    public function getFixtureDefault($number)
    {
        return sprintf(
            '%s',
            sprintf('%s%02d', $this->str('var', $this->column->getName()), $number)
        );
    }

    /**
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     *
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
     * Usado nos testes unitários de Repository, Service,
     *  Controller para array de inserção de dados.
     *
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
     * Usado nos testes unitários de Repository, Service,
     * Controller para assert com os dados do array de inserção de dados.
     *
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
     * Função usada em \Gear\Service\Mvc\FormService::getFormInputValues
     *
     * @return string
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

    /**
     * Retorna html utilizado nos Forms em Gear\Mvc\View\ViewService
     *
     * @return string
     */
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

    /**
     * Retorna filtro para colunas únicas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterUniqueElement()
    {
        $elementName = $this->column->getName();
        $elementLabel = $this->str('label', $this->column->getName());

        $elementClass = $this->str('var-lenght', 'id'.$this->str('class', $this->column->getTableName()));

        $tableName  = $this->column->getTableName();
        $tableLabel = $this->str('label', $this->column->getTableName());

        $primaryKey = 'id_'.$this->str('uline', $this->column->getTableName());

        $required = ($this->column->isNullable()) ? 'false' : 'true';

        $element = <<<EOS
        \$this->add(
            array(
                'name' => '$elementName',
                'required' => $required,
                'filters'    => array(array('name' => 'StringTrim')),
                'validators' => array(
                    \$this->getNoRecordExistValidator(
                        '$tableLabel',
                        '$elementLabel',
                        '$tableName',
                        '$elementName',
                        '$primaryKey',
                        \${$elementClass}
                    )
                )
            )
        );

EOS;
        return $element;
    }

    /**
     * Retorna filtro básico para as colunas em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function filterElement()
    {
        $elementName = $this->str('var', $this->column->getName());

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

    /**
     * Formata o elemento utilizado para coluna em Gear\Mvc\Filter\FilterService
     *
     * @return string
     */
    public function getFilterFormElement()
    {
        if ($this->getUniqueConstraint() !== false) {
            return $this->filterUniqueElement();
        }
        return $this->filterElement();
    }

    /**
     * Formata o elemento utilizado para coluna em Gear\Mvc\View\ViewService
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $element = <<<EOS
                        <td>
                            <span ng-bind="{$tableVar}.{$elementName}"></span>
                        </td>

EOS;
        return $element;
    }
}
