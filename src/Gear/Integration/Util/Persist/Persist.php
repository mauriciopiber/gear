<?php
namespace Gear\Integration\Util\Persist;

use Gear\Integration\Util\Location\LocationTrait;
use Gear\Integration\Util\Location\Location;
use Gear\Integration\Suite\AbstractMajorSuite;
use Gear\Integration\Suite\AbstractMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Util/Persist
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class Persist
{
    use LocationTrait;

    /**
     * Constructor
     *
     * @param Location $location Location
     *
     * @return \Gear\Integration\Util\Persist\Persist
     */
    public function __construct(Location $location)
    {
        $this->location = $location;

        return $this;
    }

    public function saveMajor(AbstractMajorSuite $suite, $name, $data)
    {
        $location = $this->location->getLocation($suite::SUITE);

        if ($suite::SUITE !== $suite->getSuperType()) {
            $location .= '/'.$suite->getSuperType();
        }

        $path =  sprintf('%s/%s', $location, $name);
        return file_put_contents($path, $data);
    }

    public function saveMinor(AbstractMinorSuite $suite, $name, $data)
    {
        if (empty($suite->getLocationKey())) {
            throw new \Exception('Location key not found');
        }
        $majorSuite = $suite->getMajorSuite();
        $template = $this->location->getLocation($majorSuite::SUITE).'/'.$suite->getLocationKey();

        $path =  sprintf('%s/%s', $template, $name);

        return file_put_contents($path, $data);
    }

    public function save($suite, $name, $data)
    {

        if ($suite instanceof AbstractMajorSuite) {

            return $this->saveMajor($suite, $name, $data);

        }

        if ($suite instanceof AbstractMinorSuite) {
            return $this->saveMinor($suite, $name, $data);
        }

        throw new \Exception('Type not found to save integration.');

    }
}
