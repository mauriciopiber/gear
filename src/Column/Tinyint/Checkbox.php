<?php
namespace Gear\Column\Tinyint;

use Gear\Column\Integer\AbstractCheckbox;

/**
 *
 * Classe que cria checkbox para colunas tinyint (boolean)
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
class Checkbox extends AbstractCheckbox
{
    /**
     * Instancia o checkbox
     *
     * @param ColumnObject $column Colunas
     *
     * @throws \Gear\Exception\InvalidDataTypeColumnException
     */
    public function __construct($column)
    {
        if ($column->getDataType() !== 'tinyint') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
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
        return ($iterator%2==0) ? 'Não' : 'Sim';
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     *
     * @param int $iterator Número utilizado para referência.
     *
     * @return string
     */
    public function getFixtureData($iterator)
    {
        if ($iterator%2==0) {
            $int = 0;
        } else {
            $int = 1;
        }

        return sprintf(
            '                \'%s\' => \'%d\',',
            $this->str('var', $this->column->getName()),
            $int
        ).PHP_EOL;
    }
}
