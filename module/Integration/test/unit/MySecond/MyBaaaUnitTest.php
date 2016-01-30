<?php
namespace IntegrationTest\MySecond;

use GearBaseTest\AbstractTestCase;

class MyBaaaUnitTest extends AbstractTestCase
{
    public function testClassName()
    {
        $this->assertEquals('IntegrationTest\MySecond', __NAMESPACE__);
        $this->assertEquals('IntegrationTest\MySecond\MyBaaaUnitTest', __CLASS__);
        $this->assertEquals('testClassName', __FUNCTION__);
    }
}
