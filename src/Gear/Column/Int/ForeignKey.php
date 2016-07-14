<?php
namespace Gear\Column\Int;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Int\Int;
use Gear\Column\Mvc\SearchFormInterface;

/**
 * Classe que cria as colunas associadas a outras colunas em N-1
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
class ForeignKey extends Int implements SearchFormInterface
{
    protected $constraint;

    protected $helperStack;

    protected $moduleName;

    /**
     *
     * @param ColumnObject     $column     Coluna
     * @param ConstraintObject $constraint Constraint
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     * @throws \Gear\Exception\InvalidForeignKeyException
     */
    public function __construct(ColumnObject $column, ConstraintObject $constraint)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }



        if ($constraint->getType() !== 'FOREIGN KEY'
            || !in_array($column->getName(), $constraint->getColumns())
        ) {
            throw new \Gear\Exception\InvalidForeignKeyException();
        }


        parent::__construct($column);

        $this->constraint = $constraint;
    }


    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número Base
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionSendKeys($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu escolho o valor "{$value}" na caixa para selecionar "{$attribute}"

EOS;
        return $view;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número Base
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($default = 30, $line = 1)
    {
        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo escolhido "{$value}" na caixa para selecionar "{$attribute}"

EOS;
        return $view;
    }


    /**
     * @param int $iterator Número Base
     *
     * {@inheritDoc}
     * @see \Gear\Column\Int\Int::getValue()
     *
     * @return string
     */
    public function getValue($iterator)
    {
        $schema = $this->getMetadata();

        $referencedTable = $this->constraint->getReferencedTableName();

        $this->columns = $schema->getColumns($referencedTable);

        foreach ($this->columns as $b) {
            if ($b->getDataType() == 'varchar') {
                $column = $b;
                break;
            }
        }

        if (!isset($column)) {
            throw new \Exception('Não conseguiu encontrar uma coluna válida para utilizar nas fixtures spec');
        }

        if ($iterator > 30) {
            $iterator = 30;
        }

        $text = sprintf('%d'.$this->str('label', $column->getName()), $iterator);

        return $text;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     *
     * @param int $iterator Número base
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => $this->getReference(\'%s-%d\'),',
            $this->str('var', $this->column->getName()),
            $this->str('url', $this->constraint->getReferencedTableName()),
            $iterator
        ).PHP_EOL;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     *
     * @param int $iterator Número Base
     *
     * @return string
     */
    public function getFixtureUser($iterator)
    {
        if ($iterator > 0 && $iterator <= 5) {
            $iteratorUser = 1;
        } elseif ($iterator > 5 && $iterator <= 10) {
            $iteratorUser = 2;
        } elseif ($iterator > 10 && $iterator <= 15) {
            $iteratorUser = 3;
        } elseif ($iterator > 15 && $iterator <= 20) {
            $iteratorUser = 4;
        } elseif ($iterator > 20 && $iterator <= 25) {
            $iteratorUser = 5;
        } else {
            $iteratorUser = 6;
        }

        return sprintf(
            '                \'%s\' => $this->getReference(\'usuariogear%d\'),',
            $this->str('var', $this->column->getName()),
            $iteratorUser
        ).PHP_EOL;
    }

    /*
     * Estudar qual a fonte disso
     *
     * @param int $number Número base.
     * {@inheritDoc}
     * @see \Gear\Column\Int\Int::getFixtureDefault()
     *
     * @return int

    public function getFixtureDefault($number)
    {

        return 1;
    }
    */

    /**
     * Nome da tabela reference à constraint.
     *
     * @return string
     */
    private function getReferencedTableName()
    {
        return $this->constraint->getReferencedTableName();
    }

    /**
     * Função usada em \Gear\Service\Mvc\ViewService\FormService::getViewValues
     *
     * @return string
     */
    public function getViewData()
    {
        $schema = $this->getMetadata();
        $referencedTable = $this->constraint->getReferencedTableName();

        $this->columns = $schema->getColumns($referencedTable);

        foreach ($this->columns as $b) {
            if ($b->getDataType() == 'varchar') {
                $get = $this->str('class', $b->getName());
                break;
            }
        }
        if (!isset($get)) {
            $get = $this->str('class', $this->column->getName());
        }

        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s->get%s()', $this->str('var', $this->column->getName()), $get)
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
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%d\','.PHP_EOL,
            $this->str('var', $this->column->getName()),
            $this->helperStack['insert'***REMOVED***
        );

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
        $insert = '            ';
        $insert .= sprintf(
            '\'%s\' => \'%d\','.PHP_EOL,
            $this->str('var', $this->column->getName()),
            $this->helperStack['insert'***REMOVED***
        );

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
        $insertAssert = '        ';

        $insertAssert .= sprintf(
            '$this->assertEquals(\'%s\', $resultSet->get%s()->getId%s());'.PHP_EOL,
            $this->helperStack['insert'***REMOVED***,
            $this->str('class', $this->column->getName()),
            $this->str('class', $this->getReferencedTableName())
        );

        return $insertAssert;
    }

    /**
     * Retorna a constraint da coluna
     *
     * @return ConstraintObject
     */
    public function getConstraint()
    {
        return $this->constraint;
    }

    /**
     * Adiciona ou substitui constraint da coluna
     *
     * @param ConstraintObject $constraint Constraint
     *
     * @return \Gear\Column\Int\ForeignKey
     */
    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;
        return $this;
    }

    /**
     * Pega o HelperStack da classe
     *
     * @return array
     */
    public function getHelperStack()
    {
        return $this->helperStack;
    }

    /**
     * Adiciona ou substitui o HelperStack da classe
     *
     * @param array $helperStack Array com os helpers.
     *
     * @return \Gear\Column\Int\ForeignKey
     */
    public function setHelperStack($helperStack)
    {
        $this->helperStack = $helperStack;
        return $this;
    }

    /**
     * Deve ser extraido daqui e usado na tabela
     *
     * @return ColumnObject
     */
    public function getReferencedTableValidColumnName()
    {
        $schema = $this->getMetadata();
        $referencedTable = $this->constraint->getReferencedTableName();

        $this->columns = $schema->getColumns($referencedTable);

        $validColumn = null;

        foreach ($this->columns as $b) {
            if ($b->getDataType() == 'varchar') {
                $validColumn = $this->str('class', $b->getName());
                break;
            }
        }

        return $validColumn;
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

        $module = $this->getModuleName();
        $entity = $this->str('class', $this->getReferencedTableName());

        $column = $this->getReferencedTableValidColumnName();

        if ($column === null) {
            $column = 'id.'.$this->str('class', $entity);
        }

        $property = $this->str('var', $column);


        $element = <<<EOS
        \${$var} = array(
            'name' => '$elementName',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'id' => '$elementName',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => '$label',
                'object_manager' => \$this->getEntityManager(),
                'target_class' => '{$module}\Entity\\$entity',
                'property' => '{$property}',
                'empty_option' => 'Escolher:'
            ),
        );
        \$this->add(\${$var});

EOS;
        return $element.PHP_EOL;
    }

    /**
     * Retorna a classe do Form Search em Gear\Mvc\Search\SearchService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\SearchFormInterface::getSearchFormElement()
     *
     * @return string
     */
    public function getSearchFormElement()
    {
        $var         = $this->getColumnVar($this->column);
        $label       = $this->str('label', $this->column->getName());
        $elementName = $this->str('var', $this->column->getName());

        $module = $this->getModuleName();

        $entity = $this->str('class', $this->getReferencedTableName());
        $entityFunction = $this->str('var', $this->getReferencedTableValidColumnName());

        $element = <<<EOS

        \${$var} = array(
            'name' => '$elementName',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => '$label',
                'object_manager' => \$this->getEntityManager(),
                'target_class' => '$module\Entity\\$entity',
                'property' => '$entityFunction',
                'empty_option' => 'Escolher:',
            ),
        );
        \$this->add(\${$var});

EOS;

        return $element;
    }

    /**
     * Retorna a classe do Form Search em Gear\Mvc\Search\SearchService
     *
     * {@inheritDoc}
     * @see \Gear\Column\Mvc\SearchFormInterface::getSearchViewElement()
     *
     * @return string
     */
    public function getSearchViewElement()
    {
        $elementName = $this->str('var', $this->column->getName());

        $element = <<<EOS

        <div class="col-lg-12">
            <div class="form-group">
                <?php \$this->formRow(\$form->get('$elementName')); ?>
            </div>
        </div>
EOS;
        return $element;
    }

    /**
     * Pega o nome do Módulo
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Adiciona ou substitui o nome do módulo
     *
     * @param string $moduleName Nome do Módulo
     *
     * @return \Gear\Column\Int\ForeignKey
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    /**
     * Cria o ítem para listagem em Gear\Mvc\View\ViewService
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getViewListRowElement()
     *
     * @return string
     */
    public function getViewListRowElement()
    {
        $elem = $this->str('var', $this->column->getName());

        $tableVar = $this->str('var', $this->column->getTableName());

        $enti = $this->str('var', $this->getReferencedTableValidColumnName());

        $php = "<span ng-bind=\"{$tableVar}.{$elem} != '' ? {$tableVar}.{$elem}.{$enti} : ''\"></span>";

        $element = <<<EOS

                         <td>
                             $php
                         </td>

EOS;

        return $element;
    }
}
