<?php
namespace Gear\Creator\Codes\CodeTest\FactoryCode;

use Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Creator/Codes/CodeTest/FactoryCode
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait FactoryCodeTestTrait
{
    protected $factoryCodeTest;

    /**
     * Get Factory Code Test
     *
     * @return Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest
     */
    public function getFactoryCodeTest()
    {
        if (!isset($this->factoryCodeTest)) {
            $this->factoryCodeTest = $this->getServiceLocator()->get(FactoryCodeTest::class);
        }
        return $this->factoryCodeTest;
    }

    /**
     * Set Factory Code Test
     *
     * @param FactoryCodeTest $factoryCodeTest Factory Code Test
     *
     * @return \Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest
     */
    public function setFactoryCodeTest(
        FactoryCodeTest $factoryCodeTest
    ) {
        $this->factoryCodeTest = $factoryCodeTest;
        return $this;
    }
}
