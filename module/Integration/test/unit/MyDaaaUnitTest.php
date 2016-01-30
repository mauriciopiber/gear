<?php
namespace IntegrationTest;

use GearBaseTest\AbstractTestCase;

class MyDaaaUnitTest extends AbstractTestCase
{
    public function testClassName()
    {
        $this->assertEquals('IntegrationTest', __NAMESPACE__);
        $this->assertEquals('IntegrationTest\MyDaaaUnitTest', __CLASS__);
        $this->assertEquals('testClassName', __FUNCTION__);
    }
}
