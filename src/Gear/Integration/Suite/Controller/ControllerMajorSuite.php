<?php
namespace Gear\Integration\Suite\Controller;

use Gear\Integration\Suite\AbstractMajorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/Controller
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerMajorSuite extends AbstractMajorSuite
{
    const SUITE = 'controller';

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\Controller\ControllerMajorSuite
     */
    public function __construct()
    {
        return $this;
    }

    public function getSuite()
    {
        return self::SUITE;
    }

    public function getSuperType()
    {
        return self::SUITE;
    }
}
