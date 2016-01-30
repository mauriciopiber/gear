<?php
namespace IntegrationTest\MyTest;

use GearBaseTest\AbstractTestCase;

class MyAaaaUnitTest extends AbstractTestCase
{
    public function testClassName()
    {
        $this->assertEquals('IntegrationTest\MyTest', __NAMESPACE__);
        $this->assertEquals('IntegrationTest\MyTest\MyAaaaUnitTest', __CLASS__);
        $this->assertEquals('testClassName', __FUNCTION__);
    }
}
