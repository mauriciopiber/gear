<?php
namespace Gear\Mvc\Service;

interface ServiceTestColumnInterface
{
    const SET_UP = 'getServiceSetUp';

    const CREATE_MOCK = 'getServiceCreateMock';

    const CREATE_DATA = 'getServiceFixtureData';

    const UPDATE_MOCK = 'getServiceUpdateMock';

    const UPDATE_DATA = 'getServiceFixtureData';
}
