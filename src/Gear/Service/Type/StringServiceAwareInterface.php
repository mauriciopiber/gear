<?php
namespace Gear\Service\Type;

use Gear\Service\Type\StringService;

interface StringServiceAwareInterface
{
    /**
     * @param $writerService
     * @return mixed
     */
    public function setStringService(StringService $stringService);

    /**
     * @return mixed
     */
    public function getStringService();

    /**
     * @return string String formatada
     */
    public function str($type, $message);
}
