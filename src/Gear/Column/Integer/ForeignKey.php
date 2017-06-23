<?php
namespace Gear\Column\Integer;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Column\Integer\Integer;

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
class ForeignKey extends Integer
{
    protected $constraint;

    protected $helperStack;

    protected $moduleName;

    public static $mvcFeatureNullTemplate = 'E eu vejo escolhido "Escolher:" na caixa para selecionar "%s"';

    /**
     *
     * @param ColumnObject     $column     Coluna
     * @param ConstraintObject $constraint Constraint
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     * @throws \Gear\Exception\InvalidForeignKeyException
     */
    public function __construct(ColumnObject $column, ConstraintObject $constraint, $referencedColumn)
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
        $this->referencedColumn = $referencedColumn;
    }

    public function getReferencedColumn()
    {
        return $this->referencedColumn;
    }

    public function getEntityDataProvider()
    {
        return sprintf('                $%s', $this->str('var', $this->getColumn()->getName()));
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
     * Gera os valores utilizados nos testes unitários, para enviar requisições.
     *
     * @param unknown $iterator
     * @return string
     */
    public function getInputData($iterator)
    {
        $ndnt = str_repeat(' ', 4*3);

        $name = $this->str('var', $this->column->getName());

        if ($iterator > 30) {
            $iterator = ($iterator%30);
            if ($iterator == 0) {
                $iterator == 1;
            }
        }

        return $ndnt.sprintf(self::$mvcArrayTemplate, $name, $iterator).PHP_EOL;
    }

    /**
     * Cria código para verificação da exibição da coluna em spec feature.
     *
     * @param int $default Número Base
     * @param int $line    Linha
     *
     * @return string
     */
    public function getIntegrationActionExpectValue($data)
    {
        $default = isset($data['default'***REMOVED***) ? $data['default'***REMOVED*** : 30;
        $line = isset($data['line'***REMOVED***) ? $data['line'***REMOVED*** : 1;

        $value = sprintf($this->getValue($default), $default, $this->str('label', $this->column->getName()));

        $attribute = $this->str('label', $this->column->getName());

        $view = <<<EOS
      E eu vejo escolhido "{$value}" na caixa para selecionar "{$attribute}"

EOS;
        return $view;
    }

    public function getEntityMock()
    {

        $refTable = $this->constraint->getReferencedTableName();

        $mock = '        ';

        $columnName = $this->str('class', $refTable).$this->str('class', $this->getColumn()->getName());

        $mock .= sprintf('$%s = ', $this->str('var', $this->getColumn()->getName()));

        $mockModule = (in_array($refTable, ['user', 'User'***REMOVED***))
            ? 'GearAdmin'
            : $this->getModule()->getModuleName();


        $template = <<<EOS
        \$%s = \$this->prophesize('%s\Entity\%s')->reveal();

EOS;

        return sprintf(
            $template,
            $this->str('var', $this->getColumn()->getName()),
            $mockModule,
            $this->str('class', $refTable)
        );
    }

    /**
     * Gera o valor válido associado ao $iterator
     *
     * @param int $iterator Número base.
     *
     * @return number
     */
    public function getValidForeignKeyId($iterator)
    {
        if ($iterator > 30) {
            $iterator = ($iterator%30);

            if ($iterator == 0) {
                $iterator = 1;
            }
        }

        return $iterator;
    }

    public function getValueDatabase($iterator)
    {
        $iterator = $this->getValidForeignKeyId($iterator);
        $text = sprintf('%d', $iterator);

        return $text;
    }

    /**
     * @param int $iterator Número Base
     *
     * {@inheritDoc}
     * @see \Gear\Column\Integer\Integer::getValue()
     *
     * @return string
     */
    public function getValue($iterator)
    {
        $iterator = $this->getValidForeignKeyId($iterator);

        $text = sprintf('%d'.$this->str('label', $this->referencedColumn), $iterator);

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
        $template = <<<EOS
                '%s' =>
                    \$this->getReference('%s-%d'),
EOS;

        return sprintf(
            $template,
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
        /*
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
        */

        $method = $this->str('class', $this->referencedColumn);
        //}

        return $this->getViewColumnLayout(
            $this->str('label', $this->column->getName()),
            sprintf('$this->%s->get%s()', $this->str('var', $this->column->getName()), $method)
        );
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
     * @return \Gear\Column\Integer\ForeignKey
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
     * @return \Gear\Column\Integer\ForeignKey
     */
    public function setHelperStack($helperStack)
    {
        $this->helperStack = $helperStack;
        return $this;
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

        $property = $this->str('var', $this->referencedColumn);


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

        $entityFunction = $this->str('var', $this->referencedColumn);

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
     * @return \Gear\Column\Integer\ForeignKey
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

        $enti = $this->str('var', $this->referencedColumn);

        $php = "<span ng-bind=\"{$tableVar}.{$elem} != '' ? {$tableVar}.{$elem}.{$enti} : ''\"></span>";

        $element = <<<EOS
                         <td>
                             $php
                         </td>

EOS;

        return $element;
    }
}
