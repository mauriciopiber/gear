<?php
namespace Gear\Util\Vector;

use Gear\Util\Vector\ArrayService;

interface ArrayServiceAwareInterface
{
    /**
     * @param  Config $config
     * @return mixed
     */
    public function setArrayService(ArrayService $arrayService);

    /**
     * @return mixed
     */
    public function getArrayService();
}
