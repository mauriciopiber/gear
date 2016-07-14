<?php
namespace Gear\Column;

use Zend\Db\Metadata\Object\ConstraintObject;

/**
 *
 * Interface para colunas que utilizam valores Únicos no banco de dados.
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
interface UniqueInterface
{
    /**
     * Retorna a constraint da coluna
     *
     * @return ConstraintObject
     */
    public function getUniqueConstraint();

    /**
     * Adiciona ou substitui a Constraint da Coluna
     *
     * @param ConstraintObject $uniqueConstraint Constraint do tipo Unique.
     *
     * @return void
     */
    public function setUniqueConstraint(ConstraintObject $uniqueConstraint);
}
