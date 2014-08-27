<?php
namespace Gear\Model;

use Zend\Db\Adapter\Adapter;

class ControllerUnitGear extends MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getUse()
    {
        $buffer = '';
        $buffer = 'use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;'.PHP_EOL.PHP_EOL;
        return $buffer;
    }

    public function getClass($tableName)
    {
        $table = $this->toClass($tableName);
        $buffer = '';
        $buffer .= 'class '.$table.'ControllerTest extends \Application\Test\AbstractControllerTest'.PHP_EOL;
        $buffer .= '{'.PHP_EOL;
        return $buffer;
    }

    public function getFinalPath()
    {
        $module = $this->getConfig()->getModule();
        return $this->getLocal().'/tests/ModulesTests/'.$module.'Test/Controller/';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if(is_array($entities) && count($entities)>0) {
            foreach($entities as $i => $table) {
                $this->createController($table,array('crud'));
            }
        } else {
            return false;
        }
    }


    public function createIndexController($ms)
    {
        $controller = 'index';
    	$action = array('index');
    	return $this->createController($controller,$action);
    }

    public function setUp()
    {
        $bbb  = $this->powerLine(1,'public function setUp()');
        $bbb .= $this->powerLine(1,'{');
        $bbb .= $this->powerLine(2,'    parent::setUp();');
        $bbb .= $this->powerLine(2,'    $this->mockLogin();');
        $bbb .= $this->powerLine(1,'}',array(),true);
        return $bbb;
    }

    /**
     * Creates a single controllerTest
     */
    public function createController($controller,$action)
    {
        $module = $this->getModule();

        //var_dump($module);die();
        $buffer = '';
        $buffer .= $this->getNamespace($this->getModule().'Test\Controller');
        $buffer .= $this->getUse();
        $buffer .= $this->getClass($controller);
        $buffer .= $this->setUp();
        foreach($action as $i => $v)
        {
        	if($v=='index')
        	{
        		$buffer .= $this->getIndexMethod($this->getModule(),$controller);
        	}
        	elseif($v=='crud')
        	{
        	    $buffer .= $this->getAddMethod($this->getModule(),$controller).PHP_EOL;
        	    $buffer .= $this->getEditMethod($this->getModule(),$controller).PHP_EOL;
        	    $buffer .= $this->getListMethod($this->getModule(),$controller).PHP_EOL;
        	    $buffer .= $this->getViewMethod($this->getModule(),$controller);
        	    $buffer .= $this->getDelMethod($this->getModule(),$controller).PHP_EOL;
        	}
        }

        $buffer .= $this->getEndFile();
        //var_dump($this->getFinalPath());die();
        $this->mkPHP($this->getFinalPath(), $this->getFileName($controller).'ControllerTest', $buffer);
    }


    public function getBody()
    {
        $buffer = '';
        $buffer .= $this->getIndent(1).trim('protected $traceError = true;').PHP_EOL;
        $buffer .= $this->getIndent(1).trim('public function setUp()').PHP_EOL;
        $buffer .= $this->getIndent(1).trim('{').PHP_EOL;

        $buffer .= $this->getIndent(2).trim('    $serviceManagerGrabber = new \ModulesTests\Bootstrap();').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('    $this->entityManager = $serviceManagerGrabber->getEntityManager();').PHP_EOL;

        $buffer .= $this->getIndent(2).trim('    $this->setApplicationConfig(').PHP_EOL;
        $buffer .= $this->getIndent(3).trim('            include \'/var/www/html/'.$this->getConfig()->getProject().'/config/application.config.php\'').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('    );').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('    parent::setUp();').PHP_EOL;
        $buffer .= $this->getIndent(1).trim('}').PHP_EOL;
        return $buffer;
    }

    public function getIndexMethod($module,$controller,$response = 200)
    {
        $module = $this->str('class',$module);
        $url = $this->str('url',$this->getFileName($controller));
        $className = $this->str('class',$this->getFileName($controller));

        $buffer = '';
        $buffer .= $this->getIndent(1).'public function testIndexAction()'.PHP_EOL;
        $buffer .= $this->getIndent(1).'{'.PHP_EOL;
        $buffer .= $this->getIndent(2).trim('$this->dispatch(\'/'.$this->str('url',$this->getModule()).'\');').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('$this->assertResponseStatusCode(200);').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('$this->assertModuleName(\''.$this->getModule().'\');').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('$this->assertControllerName(\''.$this->getModule().'\Controller\\Index\');').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('$this->assertActionName(\'index\');').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('$this->assertControllerClass(\'IndexController\');').PHP_EOL;
        $buffer .= $this->getIndent(2).trim('$this->assertMatchedRouteName(\''.$this->str('url',$this->getModule()).'\');').PHP_EOL;
        $buffer .= $this->getIndent(1).'}'.PHP_EOL;
        return $buffer;
    }


    public function getAddMethod($module,$controller,$response = 200)
    {
        $moduleClass     = $this->str('class',$module);
        $moduleUrl       = $this->str('url',$this->getModule());
        $tableUrl        = $this->str('url',$this->getFileName($controller));
        $tableClass      = $this->str('class',$this->getFileName($controller));
        $tableVar        = $this->str('var',$this->getFileName($controller));
        $controllerUrl   = $tableUrl;
        $controllerClass = $tableClass;
        $controllerUline = $this->str('uline',$controller);

        $b  = $this->getIndent(1).trim('public function testAddAction()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->dispatch(\'/'.$moduleUrl.'/'.$tableUrl.'/'.$this->getConfig()->getActionName('add').'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertResponseStatusCode(200);').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertModuleName(\''.$moduleClass.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertControllerName(\''.$moduleClass.'\Controller\\'.$tableClass.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertActionName(\''.$this->getConfig()->getActionName('add').'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertControllerClass(\''.$tableClass.'Controller\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertMatchedRouteName(\''.$moduleUrl.'/'.$tableUrl.'/all\');').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).trim('public function testAddWithSlashAction()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->dispatch(\'/'.$moduleUrl.'/'.$tableUrl.'/'.$this->getConfig()->getActionName('add').'/\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertResponseStatusCode(200);').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertModuleName(\''.$moduleClass.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertControllerName(\''.$moduleClass.'\Controller\\'.$tableClass.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertActionName(\''.$this->getConfig()->getActionName('add').'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertControllerClass(\''.$tableClass.'Controller\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertMatchedRouteName(\''.$moduleUrl.'/'.$tableUrl.'/all\');').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;


        $b = $this->getI(1).trim(sprintf('public function testShowValidationIfPostEmpty()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('add').'\',\'POST\',array());',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('add').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;



        $b .= $this->getIndent(1).trim('public function testAddPostAction()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        $b .= $this->getIndent(2).trim('    $faker = \Faker\Factory::create(\'pt_BR\');').PHP_EOL;
        $faker = new \Gear\Model\FakerGear($this->getConfig());
        $b .= $faker->fakeArray(2,$this->getColumns($controllerUline));


        $b .= $this->getIndent(2).trim('    $this->dispatch(\'/'.$moduleUrl.'/'.$tableUrl.'/'.$this->getConfig()->getActionName('add').'\',\'POST\',$data);').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertResponseStatusCode(302);').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertModuleName(\''.$moduleClass.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertControllerName(\''.$moduleClass.'\Controller\\'.$tableClass.'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertActionName(\''.$this->getConfig()->getActionName('add').'\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertControllerClass(\''.$tableClass.'Controller\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->assertMatchedRouteName(\''.$moduleUrl.'/'.$tableUrl.'/all\');').PHP_EOL.PHP_EOL;


        $b .= $this->powerLine(2,'        $lastInsertId = $this->getLastInsertIDFromEntity(\'%s\');',array($tableClass),true);

        $b .= $this->powerLine(2, '$%sEntity = $this->getEntityManager()->getRepository(\'%s\Entity\%s\')->findOneBy(array(\'id%s\' => $lastInsertId));', array(
            $tableVar,
            $moduleClass,
            $tableClass,
            $tableClass
        ),true);


        $b .= $this->getDataAssertion($controller);

        $b .= $this->getIndent(2).trim('    return $data;').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

    	return $b;
    }

    public function getDataAssertion($controller,$entityPrefix = '')
    {
        $assertions = '';

        $columns = $this->getColumns($this->str('uline',$controller));

        foreach($columns as $i => $v) {
            if($v->pk || in_array($v->name,$this->getConfig()->getDbException())) {
                continue;
            } else {

                $columnDb = $this->str('var',$v->name);
                $columnGet = $this->str('class',$v->name);
                $tableEntity = $this->str('var',$controller);

                if($v->fk) {
                    if($controller == $v->fk) {
                        $assertions .= $this->powerLine(2,'$this->assertEquals($data[\'%s\'***REMOVED***,$%s'.$entityPrefix.'Entity->get%s()->getId%s());',array($columnDb,$tableEntity,$columnGet,$this->str('class',$v->table),false));
                    } else {
                        $assertions .= $this->powerLine(2,'$this->assertEquals($data[\'%s\'***REMOVED***,$%s'.$entityPrefix.'Entity->get%s()->get%s());',array($columnDb,$tableEntity,$columnGet,$columnGet),false);
                    }

                } else {
                    $assertions .= $this->powerLine(2,'$this->assertEquals($data[\'%s\'***REMOVED***,$%s'.$entityPrefix.'Entity->get%s());',array($columnDb,$tableEntity,$columnGet),false);
                }
            }
        }
        return $assertions;
    }



    public function getEditMethod($module,$controller,$response = 302)
    {

        $moduleUrl       = $this->str('url',$this->getModule());
        $moduleClass     = $this->str('class',$this->getModule());
        $controllerUrl   = $this->str('url',$controller);
        $controllerClass = $this->str('class',$controller);
        $controllerVar       = $this->str('var',$this->getFileName($controller));

        $b = $this->getI(1).trim(sprintf('public function testReturnToListIfAccessEditWithoutParamAndSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('edit').'\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('edit').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testReturnToListIfAccessEditWithSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('edit').'/\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('edit').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testReturnToListWhileEditWithFalseId()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('edit').'/987654321\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('edit').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('/**')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('* @depends testAddPostAction')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('*/')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('public function testAccessSucessfullUsingIdSwhowEdit(array $data)')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf(
            '$%sEntity = $this->entityManager->getRepository(\'%s\Entity\%s\')->findOneBy($data);',$controllerVar,$moduleClass,$controllerClass
            )
        ).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('edit').'/\'.$%sEntity->getId%s());',$moduleUrl,$controllerUrl,$controllerVar,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('edit').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;


        $b.= $this->getI(2).trim(sprintf('return $%sEntity;',$controllerVar)).PHP_EOL.PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('/**')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('* @depends testAccessSucessfullUsingIdSwhowEdit')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('*/')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('public function testEditReturnValidationIfPostEmpty($%sEntity)',$controllerVar)).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('edit').'/\'.$%sEntity->getId%s(),\'POST\',array());',$moduleUrl,$controllerUrl,$controllerVar,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('edit').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('return $%sEntity;',$controllerVar)).PHP_EOL;


        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('/**')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('* @depends testEditReturnValidationIfPostEmpty')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('*/')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('public function testEditSucessfulByPostAndReturnToList($%sEntity)',$controllerVar)).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b .= $this->getIndent(2).trim('    $faker = \Faker\Factory::create(\'pt_BR\');').PHP_EOL;
        $faker = new \Gear\Model\FakerGear($this->getConfig());
        $b .= $faker->fakeArray(2,$this->getColumns($this->str('uline',$controller)),'id'.$controllerClass,$controller);

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('edit').'/\'.$%sEntity->getId%s(),\'POST\',$data);',$moduleUrl,$controllerUrl,$controllerVar,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('edit').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;


        $b .= $this->powerLine(2, '$%sCompareEntity = $this->entityManager->getRepository(\'%s\Entity\%s\')->findOneBy(array(', array(
            $controllerVar,
            $moduleClass,
            $controllerClass
        ));
        $b.= $this->powerLine(3,'    \'id%s\' => $%sEntity->getId%s()',array($controllerClass,$controllerVar,$controllerClass));
        $b.= $this->powerLine(2,'));');

        $b.= $this->powerLine(2,'$this->getEntityManager()->refresh($%sCompareEntity);',array($controllerVar));

        $b .= $this->getDataAssertion($controller,'Compare');

        $b.= $this->getI(2).trim(sprintf('return $data;')).PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getListMethod($module,$controller,$response = 200)
    {
        $b = '';
        $columns = $this->getColumns($this->str('uline',$controller));

        $moduleUrl       = $this->str('url',$this->getModule());
        $moduleClass     = $this->str('class',$this->getModule());
        $controllerUrl   = $this->str('url',$controller);
        $controllerClass = $this->str('class',$controller);

        $b = $this->getI(1).trim(sprintf('public function testAccessEditWithoutParamAndSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testListWithSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'/\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;


        foreach($columns as $i => $v) {
            if(!in_array($v->name,$this->getConfig()->getDbException()) && $v->dataType != 'text') {
                $b.= $this->getI(1).trim(sprintf('public function testListOrdenationBy%sAsc()',$this->str('class',$v->name))).PHP_EOL;
                $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

                $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'/order_by/'.$this->str('var',$v->name).'/asc\');',$moduleUrl,$controllerUrl)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/list\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

                $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

                $b.= $this->getI(1).trim(sprintf('public function testListOrdenationBy%sDesc()',$this->str('class',$v->name))).PHP_EOL;
                $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

                $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'/order_by/'.$this->str('var',$v->name).'/desc\');',$moduleUrl,$controllerUrl)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
                $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/list\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

                $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;
                //var_dump($v);
            }

            if($v->dataType=='text' || $v->dataType=='varchar') {
                $like = true;
            }
        }

        $b.= $this->getI(1).trim(sprintf('public function testListIterateOverPagination()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('for($page = 0; $page < 5; $page++) {')).PHP_EOL;

        $b.= $this->getI(3).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'/page/\'.$page);',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(3).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(3).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(3).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(3).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
        $b.= $this->getI(3).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(3).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/list\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('}')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testListWithEmptyPostFilter()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'\',\'POST\',array());',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;


        if(isset($like)) {
            $b.= $this->getI(1).trim(sprintf('public function testListUsingLike()')).PHP_EOL;
            $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;
            $b.= $this->getI(2).trim('    $faker = \Faker\Factory::create(\'pt_BR\');').PHP_EOL;
            $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'\',\'POST\',array(\'like\' => $faker->sentence(1)));',$moduleUrl,$controllerUrl)).PHP_EOL;
            $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
            $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
            $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
            $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
            $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
            $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

            $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;
        }

        $b.= $this->getI(1).trim(sprintf('/**')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('* @depends testEditSucessfulByPostAndReturnToList')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('*/')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('public function testListWithUserFilter(array $data)',$controllerClass)).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('list').'\',\'POST\',$data);',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('list').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;


        return $b;

    }

    public function getDelMethod($module,$controller,$response = 302)
    {

        $moduleUrl       = $this->str('url',$this->getModule());
        $moduleClass     = $this->str('class',$this->getModule());
        $controllerUrl   = $this->str('url',$controller);
        $controllerClass = $this->str('class',$controller);
        $controllerVar   = $this->str('var',$controller);


        $b = $this->getI(1).trim(sprintf('public function testReturnToListIfAccessDelWithoutParamAndSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('del').'\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('del').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testReturnToListIfAccessDelWithSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('del').'/\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('del').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;


        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testReturnToListIfFalseId()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('del').'/987654321\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('del').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('/**')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('* @depends testEditReturnValidationIfPostEmpty')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('*/')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('public function testDelSucessfullUsingIdReturningToList($%sEntity)',$controllerVar)).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('del').'/\'.$%sEntity->getId%s());',$moduleUrl,$controllerUrl,$controllerVar,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('del').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;


        /* $b.= $this->getI(2).trim(sprintf('$loader = new \Doctrine\Common\DataFixtures\Loader;')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$path = realpath(__DIR__.\'/../../../../../../module/'.$moduleClass.'/src/'.$moduleClass.'/Fixture\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$loader->loadFromDirectory($path);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger($this->entityManager);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$executor = new \Doctrine\Common\DataFixtures\Executor\ORMExecutor($this->entityManager, $purger);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$executor->execute($loader->getFixtures());')).PHP_EOL; */

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;
        /*
        $module = $this->str('class',$module);
        $url = $this->str('url',$this->getFileName($controller));
        $className = $this->str('class',$this->getFileName($controller));

        $buffer = '';
        $buffer .= $this->getIndent(1).'public function testDelAction()'.PHP_EOL;
        $buffer .= $this->getIndent(1).'{'.PHP_EOL;
        $buffer .= $this->getBasicAssertion($url.'/del', $module, $className, 'del', 302,$url);
        $buffer .= $this->getIndent(1).'}'.PHP_EOL;
        return $buffer;
        */
        return $b;
    }

    public function getViewMethod($module,$controller,$response = 302)
    {
        $moduleUrl       = $this->str('url',$this->getModule());
        $moduleClass     = $this->str('class',$this->getModule());
        $controllerUrl   = $this->str('url',$controller);
        $controllerClass = $this->str('class',$controller);
        $controllerVar   = $this->str('var',$controller);

        $b = $this->getI(1).trim(sprintf('public function testReturnToListIfAccessViewWithoutParamAndSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('view').'\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('view').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testReturnToListIfAccessViewWithSlash()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('view').'/\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('view').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('public function testReturnToListIfPassFalseId()')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('view').'/987654321\');',$moduleUrl,$controllerUrl)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(302);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('view').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL.PHP_EOL;

        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;


        $b.= $this->getI(1).trim(sprintf('/**')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('* @depends testEditReturnValidationIfPostEmpty')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('*/')).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('public function testAccessSucessfullViewUsingId($%sEntity)',$controllerVar)).PHP_EOL;
        $b.= $this->getI(1).trim(sprintf('{')).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('$this->dispatch(\'/%s/%s/'.$this->getConfig()->getActionName('view').'/\'.$%sEntity->getId%s());',$moduleUrl,$controllerUrl,$controllerVar,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertResponseStatusCode(200);')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertModuleName(\'%s\');',$moduleClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerName(\'%s\Controller\%s\');',$moduleClass,$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertActionName(\''.$this->getConfig()->getActionName('view').'\');')).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertControllerClass(\'%sController\');',$controllerClass)).PHP_EOL;
        $b.= $this->getI(2).trim(sprintf('$this->assertMatchedRouteName(\'%s/%s/all\');',$moduleUrl,$controllerUrl)).PHP_EOL;

        $b.= $this->getI(2).trim(sprintf('return $%sEntity;',$controllerVar)).PHP_EOL.PHP_EOL;


        $b.= $this->getI(1).trim(sprintf('}')).PHP_EOL.PHP_EOL;
        /*
        $module = $this->str('class',$module);
        $url = $this->str('url',$this->getFileName($controller));
        $className = $this->str('class',$this->getFileName($controller));

        $buffer = '';
        $buffer .= $this->getIndent(1).'public function testViewAction()'.PHP_EOL;
        $buffer .= $this->getIndent(1).'{'.PHP_EOL;
        $buffer .= $this->getBasicAssertion($url.'/view', $module, $className, 'view', 302,$url);
        $buffer .= $this->getIndent(1).'}'.PHP_EOL;
        return $buffer;
        */
        return $b;
    }





}