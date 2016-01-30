<?php
namespace IntegrationTest;

use GearBaseTest\AbstractTestCase;

class MyCaaaUnitTest extends AbstractTestCase
{
    public function testClassName()
    {
        $this->assertEquals('IntegrationTest', __NAMESPACE__);
        $this->assertEquals('IntegrationTest\MyCaaaUnitTest', __CLASS__);
        $this->assertEquals('testClassName', __FUNCTION__);
    }
}
