<?php
namespace Gear\Creator\Codes\Code\FactoryCode;

use Gear\Creator\Codes\Code\FactoryCode\FactoryCode;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Creator/Codes/Code/FactoryCode
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait FactoryCodeTrait
{
    protected $factoryCode;

    /**
     * Get Factory Code
     *
     * @return Gear\Creator\Codes\Code\FactoryCode\FactoryCode
     */
    public function getFactoryCode()
    {
        return $this->factoryCode;
    }

    /**
     * Set Factory Code
     *
     * @param FactoryCode $factoryCode Factory Code
     *
     * @return \Gear\Creator\Codes\Code\FactoryCode\FactoryCode
     */
    public function setFactoryCode(
        FactoryCode $factoryCode
    ) {
        $this->factoryCode = $factoryCode;
        return $this;
    }
}
