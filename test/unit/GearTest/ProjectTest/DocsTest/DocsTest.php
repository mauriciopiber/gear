<?php
namespace GearTest\ProjectTest\DocsTest;

use GearBaseTest\AbstractTestCase;
use Gear\Project\Docs\DocsTrait;

/**
 * @group Service
 * @group Docs
 */
class DocsTest extends AbstractTestCase
{
    use DocsTrait;

    public function setUp()
    {
        parent::setUp();
        $this->docs = new \Gear\Project\Docs\Docs();
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
