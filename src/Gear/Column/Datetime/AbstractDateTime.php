<?php
namespace Gear\Column\Datetime;

use Gear\Column\AbstractColumn;

/**
 *
 * Classe abstrata para todas Colunas relacionadas a Data.
 *
 * Date
 * DateTime
 * DatePtBr
 * DateTimePtBr
 * Time
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
abstract class AbstractDateTime extends AbstractColumn
{
    protected $minuto = 0;

    const DATETIME_GLOBAL_FORMAT = 'Y-m-d H:i:s';

    const DATETIME_PTBR_FORMAT = 'd/m/Y H:i:s';

    const DATE_PTBR_FORMAT = 'd/m/Y';

    const DATE_GLOBAL_FORMAT = 'Y-m-d';

    const TIME_GLOBAL_FORMAT = 'H:i:s';

    /**
     * Cria a Coluna
     *
     * @param ColumnObject $column Coluna
     */
    public function __construct($column)
    {
        parent::__construct($column);
    }

    /**
     * Retorna um horário válido para ser utilizado em relação ao $iterator
     */
    public function getValidHour($iterator)
    {
        $hora = ($iterator > 23) ? ($iterator%24) : $iterator;

        return $hora;
    }

    /**
     * Retorna os secondos dos times padrão
     *
     * @param int $iterator Número base
     */
    public function getValidSecond($iterator)
    {
        if ($iterator > 60) {
            return ($iterator%60);
        }

        return $iterator;
    }

    /**
     * Retorna um dia válido para ser utilizado em relação ao $iterator
     *
     * @param int $iterator Número Base
     *
     * @return int
     */
    public function getValidDay($iterator)
    {
        $dia = ($iterator > 30) ? ($iterator%30) : $iterator;

        if ($dia == 0) {
            $dia = 01;
        }

        return $dia;
    }

    /**
     * Retorna um ano válido para ser utilizado em relação ao $iterator
     *
     * @param int $iterator Número Base
     *
     * @return int
     */
    public function getValidYear($iterator)
    {
        if ($iterator > 20) {
            $iterator = ($iterator%23);
        }

        return 2000+$iterator;
    }

    /**
     * Retorna um mês válido para ser utilizado em relação ao $iterator
     *
     * @param int $iterator Número Base
     *
     * @return int
     */
    public function getValidMonth($iterator)
    {
        if ($iterator > 12) {
            $iterator = ($iterator%12);
            if ($iterator == 0) {
                $iterator = 1;
            }
        }

        return $iterator;
    }

    /**
     * Retorna o formato Global para DateTime
     *
     * @return string
     */
    public function getDateTimeGlobalFormat()
    {
        return self::DATETIME_GLOBAL_FORMAT;
    }

    /**
     * Retorna o formato Global para DateTimePtBr
     *
     * @return string
     */
    public function getDateTimePTBRFormat()
    {
        return self::DATETIME_PTBR_FORMAT;
    }

    /**
     * Retorna o formato Global para DatePtBr
     *
     * @return string
     */
    public function getDatePTBRFormat()
    {
        return self::DATE_PTBR_FORMAT;
    }

    /**
     * Retorna o formato Global para Date.
     *
     * @return string
     */
    public function getDateGlobalFormat()
    {
        return self::DATE_GLOBAL_FORMAT;
    }

    /**
     * Retorna o formato Global para Time.
     *
     * @return string
     */
    public function getTimeGlobalFormat()
    {
        return self::TIME_GLOBAL_FORMAT;
    }
}
