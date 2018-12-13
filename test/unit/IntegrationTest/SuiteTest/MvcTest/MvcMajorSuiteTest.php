<?php
namespace GearTest\IntegrationTest\SuiteTest\MvcTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * @group MajorSuite
 * @group Suite
 */
class MvcMajorSuiteTest extends TestCase
{
    public function testMvcMajorSuite()
    {
        $this->constraints = [['null'***REMOVED***, null, ['unique'***REMOVED***, ['null', 'unique'***REMOVED******REMOVED***;
        $this->tableAssoc = [null, ['upload_image'***REMOVED******REMOVED***;
        $this->usertypes = ['all', 'low-strict', 'strict'***REMOVED***;
        $this->columns = ['complete', 'basic'***REMOVED***;
        $this->longname = true;

        $this->mvcMajorSuite = new MvcMajorSuite(
            'mvc-complete',
            $this->columns,
            $this->usertypes,
            $this->constraints,
            $this->tableAssoc
        );
        $this->assertEquals('mvc', $this->mvcMajorSuite->getSuite());
        $this->assertEquals('mvc-complete', $this->mvcMajorSuite->getSuperType());
        $this->assertEquals('mvc/mvc-complete', $this->mvcMajorSuite->getLocationKey());
        $this->assertEquals($this->columns, $this->mvcMajorSuite->getColumns());
        $this->assertEquals($this->usertypes, $this->mvcMajorSuite->getUserTypes());
        $this->assertEquals($this->tableAssoc, $this->mvcMajorSuite->getTableAssocs());
        $this->assertEquals($this->constraints, $this->mvcMajorSuite->getConstraints());

        $data = $this->mvcMajorSuite->getTables();
        $this->assertCount(48, $data);
    }
}
