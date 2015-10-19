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

    /**
     * @group xml
     */

    public function testAttributesFromProjectCodeceptionTemplate()
    {
        $projectCodeception = $this->getJenkins()->jobConfigMap('project');
        $xml = simplexml_load_file($projectCodeception);


        //or this, should be stdClass
        $xmlObj = json_decode(json_encode((array) $xml), 1);

        $this->assertArrayHasKey('authToken', $xmlObj);
        $this->assertEquals('MyRandomPass', $xmlObj['authToken'***REMOVED***);

        $gitDefault = 'git@bitbucket.org:mauriciopiber/gear-pibernetwork.git';

        $this->assertEquals($gitDefault, $xmlObj['scm'***REMOVED***['userRemoteConfigs'***REMOVED***['hudson.plugins.git.UserRemoteConfig'***REMOVED***['url'***REMOVED***);

        $installCommand = '$WORKSPACE/gear_help.sh install';
        $this->assertEquals($installCommand, $xmlObj['builders'***REMOVED***['hudson.tasks.Shell'***REMOVED***['command'***REMOVED***);

        $publishers = $xmlObj['publishers'***REMOVED***;

        //var_dump($publishers);die();

        //phploc
        $this->assertArrayHasKey('hudson.plugins.plot.PlotPublisher', $publishers);

        //codeception
        $this->assertArrayHasKey('org.jenkinsci.plugins.cloverphp.CloverPHPPublisher', $publishers);
        $this->assertArrayHasKey('hudson.tasks.junit.JUnitResultArchiver', $publishers);
        $this->assertArrayHasKey('xunit', $publishers);

        //phpdox
        $this->assertArrayHasKey('htmlpublisher.HtmlPublisher', $publishers);

        //pdepend
        $this->assertArrayHasKey('hudson.plugins.jdepend.JDependRecorder', $publishers);

        //phpcs, phpmd, phpcpd
        $this->assertArrayHasKey('hudson.plugins.violations.ViolationsPublisher', $publishers);

        //email
        $this->assertArrayHasKey('hudson.tasks.Mailer', $publishers);



    }

}
