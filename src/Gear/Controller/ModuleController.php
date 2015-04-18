<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ConsoleModel;

class ModuleController extends AbstractConsoleController
{
    use \Gear\Common\ModuleTrait;
    use \Gear\Common\BuildTrait;
    use \Gear\Common\EntityServiceTrait;
    use \Gear\Common\JsonServiceTrait;
    use \Gear\Service\FixtureServiceTrait;

    /**
     * Função responsável por criar um novo módulo dentro do projeto especificado
     * @throws \RuntimeException
     */
    public function createAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-create'));

        $module = $this->getModuleService();
        $module->create();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function fixtureAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-fixture'));

        $module = $this->getFixtureService();
        $module->importModule();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function deleteAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-delete'));

        $module = $this->getModuleService();
        $module->delete();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function lightAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-light'));

        $module = $this->getModuleService();
        $module->createLight();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function loadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-load'));

        $module = $this->getModuleService();
        $module->load();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function unloadAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-unload'));

        $module = $this->getModuleService();
        $module->unload();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function pushAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-push'));

        /* @var $module \Gear\Service\Module\ModuleService */
        $module = $this->getModuleService();
        $module->push();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function buildAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-build'));

        $this->getBuildService()->build();

        $this->getEventManager()->trigger('gear.pos', $this);
    }


    public function entityAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-entity'));

        $request = $this->getRequest();
        $prefix  = $request->getParam('prefix', false);
        $tables  = $request->getParam('entity', array());

        $entityService = $this->getEntityService();
        $entityService->setUpEntity(array('prefix' => $prefix, 'tables' => $tables));

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function entitiesAction()
    {

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-entities'));


        $request = $this->getRequest();
        $entityService = $this->getEntityService();
        $entityService->setUpEntities(array('prefix' => $request->getParam('prefix', false)));

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }

    public function jenkinsAction()
    {

        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-jenkins'));
/*
        $ch = curl_init();
$postData = array(
    'identity' => 'usuariogear1@gmail.com',
    'credential' => 'usuariogear1',
    'redirect_to' => 'http://pibernetwork.gear.dev/inicio',
    'testcookie' => '1'
);

curl_setopt_array($ch, array(
    CURLOPT_URL => 'http://pibernetwork.gear.dev/admin/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_FOLLOWLOCATION => true
));

$output = curl_exec($ch);
echo $output;

var_dump(curl_getinfo($ch));

if (!curl_exec($ch)) {
    // if curl_exec() returned false and thus failed
    echo 'An error has occurred: ' . curl_error($ch);
}
else {
    echo 'everything was successful';
}
 */
        $configFile = file_get_contents('http://modules.gear.dev:8080/job/gear-teste/config.xml');

        $search =  \GearBase\Module::getProjectFolder().'/module/Teste';
        $replace = \GearBase\Module::getProjectFolder().'/module/'.$this->getRequest()->getParam('module');


        if (strpos($configFile, \GearBase\Module::getProjectFolder().'/module/Teste') == false) {
            throw new \Exception('Config file is not valid for replace');
        }


        $config = str_replace($search, $replace, $configFile);
        var_dump($configFile);

        die();

        $this->getEventManager()->trigger('gear.pos', $this);

        return new ConsoleModel();
    }


    public function dumpAction()
    {
        $this->getEventManager()->trigger('gear.pre', $this, array('message' => 'module-dump'));


        $json = $this->getRequest()->getParam('json');
        $array = $this->getRequest()->getParam('array');

        if ($json === false && $array === false) {
            return 'Type not specified';
        }

        $module = $this->getJsonService();

        if ($json) {
            $dump = $module->dump('json')."\n";
        } elseif ($array) {
            $dump = $module->dump('array')."\n";
        }

        echo $dump;

        $this->getEventManager()->trigger('gear.pos', $this);


        return new ConsoleModel();

    }

}
