<?php
namespace GearTest\ContinuousIntegrationTest;

use GearBaseTest\AbstractTestCase;
use Gear\ContinuousIntegration\JenkinsTrait;

/**
 * @group Jenkins
 * @author piber
 *
 */
class JenkinsServiceTest extends AbstractTestCase
{
    use JenkinsTrait;


    public function testJenkinsUrl()
    {
        $expected = 'jenkins-gear.jenkins.com';
        $this->getJenkins()->setJenkinsUrl($expected);
        $this->assertEquals($expected, $this->getJenkins()->getJenkinsUrl());
    }

    public function testJenkinsWorkspace()
    {
        $expected = '/var/lib/jenkins';
        $this->getJenkins()->setJenkinsUrl($expected);
        $this->assertEquals($expected, $this->getJenkins()->getJenkinsUrl());
    }

    /**
     * @group jenkins2
     */
    public function testCreateJobOnJenkins()
    {
        $project = $this->getJenkins()->createJobProject();
    }

    /**
     * @expectedException Exception
     */
    public function testTemplate()
    {
        $this->assertEquals('config-module-codeception.xml', $this->getJenkins()->templateByName('module-codeception'));
        $this->assertEquals('config-module-phpunit.xml', $this->getJenkins()->templateByName('module-phpunit'));
        $this->assertEquals('config-project-codeception.xml', $this->getJenkins()->templateByName('project-codeception'));
        $this->assertNull($this->getJenkins()->templateByName(''));
        $this->assertNull($this->getJenkins()->templateByName(null));
        $this->assertNull($this->getJenkins()->templateByName('aleatorio'));
    }

    public function testTemplateLocation()
    {
        $this->assertNotNull($this->getJenkins()->getJobConfigFolder());
    }


    /**
     * @group jenkins-xml
     */
    public function testXmlTemplate()
    {
        $projectCodeception = $this->getJenkins()->jobConfigMap('project-codeception');

        $findXml = __DIR__.'/../../../ci/config-project-codeception.xml';
        $findXml = str_replace('Test', '', $findXml);
        $findXml = str_replace('test/unit', 'src', $findXml);

        $this->assertEquals(realpath($findXml), $projectCodeception);

    }

}
