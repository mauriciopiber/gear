<?php
namespace GearTest\ServiceTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group testConfig
 * @author piber
 */
class ConfigServiceTest extends AbstractTestCase
{
    use \Gear\Service\ConfigServiceTrait;

    public function buildMocks()
    {
        $module = $this->getMockModuleStructure($this->testModuleName);
        $this->getConfigService()->setModule($module);

        $serviceLocator = $this->getMockServiceLocator($this->testConfig);
        $this->getConfigService()->setServiceLocator($serviceLocator);

        $console = $this->getMockConsole();
        $this->getConfigService()->setConsole($console);

        $request = $this->getMockRequestWithParams($this->testRequest);
        $this->getConfigService()->setRequest($request);


    }

    public function tearDown()
    {
        unset($this->testModuleName);
        unset($this->testRequest);
        unset($this->testConfig);
        unset($this->configService);
        parent::tearDown();
    }
    /**
     * @group works2
     */
    public function testAddConfig()
    {
        $this->testModuleName = 'ConfigTest';
        $this->testRequest =  [
            'key' => 'not-set',
            'value' => 'setting'
        ***REMOVED***;

        $this->testConfig = ['config' => ['set' => true***REMOVED******REMOVED***;
        $this->buildMocks();

        $add = $this->getConfigService()->add();

        $this->assertEquals(true, $add);

        $config = $this->getConfigService()->getConfig();
        $this->assertArrayHasKey('not-set', $config);

    }

    /**
     * @group works2
     */
    public function testAddConfigAlreadyExists()
    {
        $this->testModuleName = 'ConfigTest';
        $this->testRequest =  [
        'key' => 'not-set',
        'value' => 'setting'
            ***REMOVED***;

        $this->testConfig = ['config' => ['not-set' => true***REMOVED******REMOVED***;
        $this->buildMocks();

        $add = $this->getConfigService()->add();
        $this->assertEquals(false, $add);
    }

    /**
     * @group works2
     */
    public function testAddNoKeyNoValue()
    {
        $this->testModuleName = 'ConfigTest';
        $this->testConfig = ['config' => ['not-set' => true***REMOVED******REMOVED***;


        $this->testRequest =  [
            'key' => '',
            'value' => 'setting'
        ***REMOVED***;
        $this->buildMocks();

        $add = $this->getConfigService()->add();
        $this->assertEquals(false, $add);

        $this->testRequest =  [
            'key' => '',
            'value' => null
        ***REMOVED***;
        $this->buildMocks();

        $add = $this->getConfigService()->add();
        $this->assertEquals(false, $add);
    }

    public function testShow()
    {
        $request = $this->getMockRequestWithParams();
        $this->getConfigService()->setRequest($request);
        $add = $this->getConfigService()->listConfig();
    }

    public function testShowConfigNotExist()
    {
        $request = $this->getMockRequestWithParams();
        $this->getConfigService()->setRequest($request);
        $add = $this->getConfigService()->listConfig();
    }

    public function testUpdateConfigNotExist()
    {
        $request = $this->getMockRequestWithParams();
        $this->getConfigService()->setRequest($request);
        $add = $this->getConfigService()->update();
    }

    public function testUpdate()
    {
        $request = $this->getMockRequestWithParams();
        $this->getConfigService()->setRequest($request);
        $add = $this->getConfigService()->update();
    }

    public function testDeleteConfigNotExist()
    {
        $request = $this->getMockRequestWithParams();
        $this->getConfigService()->setRequest($request);
        $add = $this->getConfigService()->delete();
    }

    public function testDelete()
    {
        $request = $this->getMockRequestWithParams();
        $this->getConfigService()->setRequest($request);
        $add = $this->getConfigService()->delete();
    }

}
