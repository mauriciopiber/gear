<?php
namespace GearTest;

trait ControllerScopeTrait
{
    public function getControllerScope($srcType)
    {
        return [
            [
                new \GearJson\Controller\Controller([
                    'name' => sprintf('Basic%s', $srcType),
                    'object' => sprintf('MyModule\\Controller\\Basic%s', $srcType)
                ***REMOVED***),
                'basic'
            ***REMOVED***

        ***REMOVED***;
    }
}
