<?php
namespace Gear\Service;

use Zend\View\Model\ViewModel;
use Gear\Service\AbstractService;

class VersionService extends AbstractService
{

    public function increment($versionToIncrement)
    {
        $versions = explode('.', $versionToIncrement);
        $last = end($versions);
        $lastTo = $last + 1;
        end($versions);         // move the internal pointer to the end of the array
        $key = key($versions);

        $versions[$key***REMOVED*** = $lastTo;
        $version = implode('.', $versions);

        return $version;
    }

}