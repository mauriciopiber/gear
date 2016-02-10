<?php
namespace Gear\Mvc;

use GearBase\AbstractHydrator;
use Zend\InputFilter\InputFilter;

class UnitTestValues extends AbstractHydrator
{

    protected $insertArray;

    protected $insertAssert;

    protected $updateArray;

    protected $updateAssert;

    protected $insertSelect;

    public function getInputFilter()
    {
        $inputFilter = new InputFilter();

        return $inputFilter;
    }

    /**
     *
     * @return the unknown_type
     */
    public function getInsertArray()
    {
        return $this->insertArray;
    }

    /**
     *
     * @param unknown_type $insertArray
     */
    public function setInsertArray($insertArray)
    {
        $this->insertArray = $insertArray;
        return $this;
    }

    /**
     *
     * @return the unknown_type
     */
    public function getInsertAssert()
    {
        return $this->insertAssert;
    }

    /**
     *
     * @param unknown_type $insertAssert
     */
    public function setInsertAssert($insertAssert)
    {
        $this->insertAssert = $insertAssert;
        return $this;
    }

    /**
     *
     * @return the unknown_type
     */
    public function getUpdateArray()
    {
        return $this->updateArray;
    }

    /**
     *
     * @param unknown_type $updateArray
     */
    public function setUpdateArray($updateArray)
    {
        $this->updateArray = $updateArray;
        return $this;
    }

    /**
     *
     * @return the unknown_type
     */
    public function getUpdateAssert()
    {
        return $this->updateAssert;
    }

    /**
     *
     * @param unknown_type $updateAssert
     */
    public function setUpdateAssert($updateAssert)
    {
        $this->updateAssert = $updateAssert;
        return $this;
    }

    public function getInsertSelect()
    {
        return $this->insertSelect;
    }

    public function setInsertSelect($insertSelect)
    {
        $this->insertSelect = $insertSelect;
        return $this;
    }
}