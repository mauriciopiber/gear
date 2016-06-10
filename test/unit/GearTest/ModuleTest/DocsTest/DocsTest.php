<?php
namespace GearTest\ModuleTest\DocsTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Service
 * @group Docs
 */
class DocsTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->docs = new \Gear\Module\Docs\Docs();
    }

    public function testCreateIndexDocs()
    {
        $result = $this->docs->createIndex();
        $this->assertTrue($result);
    }

    public function testCreateConfig()
    {
        $result = $this->docs->createConfig();
        $this->assertTrue($result);
    }

    public function testCreateReadme()
    {
        $result = $this->docs->createReadme();
        $this->assertTrue($result);
    }
}
