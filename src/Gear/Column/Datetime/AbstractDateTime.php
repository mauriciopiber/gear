<?php
namespace Gear\Column\DateTime;

use Gear\Column\AbstractColumn;

abstract class AbstractDateTime extends AbstractColumn
{
    protected $mes = 12;

    protected $ano = 2020;

    protected $insertTime;

    protected $updateTime;

    const DATETIME_GLOBAL_FORMAT = 'Y-m-d H:i:s';

    const DATETIME_PTBR_FORMAT = 'd/m/Y H:i:s';

    const DATE_PTBR_FORMAT = 'd/m/Y';

    const DATE_GLOBAL_FORMAT = 'Y-m-d';

    const TIME_GLOBAL_FORMAT = 'H:i:s';

    public function __construct($column)
    {
        parent::__construct($column);
    }

    public function getUpdateTime()
    {
        if ($this->updateTime == null) {
            $this->updateTime = new \DateTime();
        }
        return $this->updateTime;
    }

    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    public function getInsertTime()
    {
        if ($this->insertTime == null) {
            $this->insertTime = new \DateTime();
        }
        return $this->insertTime;
    }

    public function setInsertTime($insertTime)
    {
        $this->insertTime = $insertTime;
        return $this;
    }

    public function getDateTimeGlobalFormat()
    {
        return self::DATETIME_GLOBAL_FORMAT;
    }

    public function getDateTimePTBRFormat()
    {
        return self::DATETIME_PTBR_FORMAT;
    }

    public function getDatePTBRFormat()
    {
        return self::DATE_PTBR_FORMAT;
    }

    public function getDateGlobalFormat()
    {
        return self::DATE_GLOBAL_FORMAT;
    }

    public function getTimeGlobalFormat()
    {
        return self::TIME_GLOBAL_FORMAT;
    }


    public function getFixture($numberReference)
    {
        $name = $this->str('uline', $this->column->getName());
        $value = $this->getFixtureDefault($numberReference);

        return <<<EOS
                '$name' => '$value',

EOS;
    }
}
