<?php
namespace Gear\Column\DateTime;

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
    protected $mes = 12;

    protected $ano = 2020;

    protected $minuto = 0;

    protected $segundo = 2;

    protected $insertTime;

    protected $updateTime;

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
     * @deprecated Acho que não é utilizado.
     *
     * Pega o tempo de atualização para testes antigos
     *
     * @return \DateTime|unknown
     */
    public function getUpdateTime()
    {
        if ($this->updateTime == null) {
            $this->updateTime = new \DateTime();
        }
        return $this->updateTime;
    }

    /**
     * @deprecated Acho que não é mais utilizada.
     *
     * Insere uma data padrão pra ser utilizada nos testes
     *
     * @param \DateTime $updateTime Data
     *
     * @return \Gear\Column\DateTime\AbstractDateTime
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    /**
     * @deprecated Acho que não é utilizado.
     *
     * Pega o tempo de atualização para testes antigos
     *
     * @return \DateTime|unknown
     */
    public function getInsertTime()
    {
        if ($this->insertTime == null) {
            $this->insertTime = new \DateTime();
        }
        return $this->insertTime;
    }

    /**
     * @deprecated Acho que não é mais utilizada.
     *
     * Insere uma data padrão pra ser utilizada nos testes
     *
     * @param \DateTime $insertTime Data
     *
     * @return \Gear\Column\DateTime\AbstractDateTime
     */
    public function setInsertTime($insertTime)
    {
        $this->insertTime = $insertTime;
        return $this;
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


    /**
     * @TODO Descobrir a função
     *
     * {@inheritDoc}
     * @see \Gear\Column\AbstractColumn::getFixture()
     *
     * @param int $numberReference Número base.
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
}
