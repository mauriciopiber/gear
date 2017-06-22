<?php
namespace Gear\Mvc\Service;

interface ServiceColumnInterface
{
    const CREATE_BEFORE = 'getServiceCreateBefore';

    const CREATE_AFTER = 'getServiceCreateAfter';

    const UPDATE_BEFORE = 'getServiceUpdateBefore';

    const UPDATE_AFTER = 'getServiceUpdateAfter';

    const DELETE = 'getServiceDelete';
}
