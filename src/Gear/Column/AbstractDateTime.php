<?php
namespace Gear\Column;

abstract class AbstractDateTime extends AbstractColumn
{

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
        return $this->updateTime;
    }

    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    public function getInsertTime()
    {
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

    public function getAcceptanceTestFillField($numberReference)
    {

        $module = $this->getModule()->getModuleName();

        $class = $this->str('class', $this->column->getTableName());

        $column = $this->str('var', $this->column->getName());

        $value = $this->getFixtureDefault($numberReference);

        return <<<EOS
        \$I->executeJS(
            sprintf('$("%s").val(\'%s\');', {$class}EditPage::\${$column}, '$value')
        );

EOS;
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