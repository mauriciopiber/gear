<?php

namespace Gear\Model;
use Zend\Db\Adapter\Adapter;


class LogicUnitGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/tests/ModulesTests/'.$this->getModule().'Test/Logic';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();

        if(is_array($entities) && count($entities)>0) {
            foreach($entities as $i => $table) {
                $this->createLogic($table);
            }
        } else {
            return false;
        }
    }

    public function createLogic($table)
    {
        $module = $this->getModule();
        $path   = $this->getFinalPath();

        $class = $this->str('class',$table);
        //$schema = new Schema($this->getAdapter());
        //$columns = $schema->getColumns($table);

        $b = '';
        $b .= $this->getNamespace($module.'Test\Logic');
        $b .= $this->getUse();
        $b .= $this->getClass($class);

        $b .= $this->setUp();
        $b .= $this->serviceLocator();

        /*
        $b .= $this->canListAll();
        $b .= $this->canFilterAll();
        //$b .= $this->canPaginateAll();
        $b .= $this->canOrderAll();
        $b .= $this->canInsertItem();
        $b .= $this->canUpdateItem();
        $b .= $this->canDeleteItem();
        $b .= $this->canFindById();
        $b .= $this->canQueryAll();
        $b .= $this->canQUeryOne();
        */
        $b .= $this->canLogic();
        $b .= $this->getEndFile();
        $this->mkPHP($path, $this->getFileName($table).'LogicTest',$b);
    }

    public function getUse()
    {
    	return 'use Zend\ServiceManager\ServiceLocatorAwareInterface;'.PHP_EOL.PHP_EOL;
    }

    public function getClass($className)
    {
        return 'class '.$className.'LogicTest extends \PHPUnit_Framework_TestCase implements ServiceLocatorAwareInterface'.PHP_EOL.'{'.PHP_EOL;
    }

    public function setUp()
    {
        $b  = $this->getIndent(1).trim('public function setUp()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->sm = \\'.$this->getModule().'Test\Bootstrap::getServiceManager();').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $this->em = $this->sm->get(\'doctrine.entitymanager.orm_default\');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    parent::setUp();').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canLogic()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testLogic()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL;
        return $b;
    }
    /*

    public function canListAll()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanListAll()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canFilterAll()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanFilterAll()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }


    public function canOrderAll()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanOrderAll()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canInsertItem()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanInsertItem()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canUpdateItem()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanUpdateItem()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canDeleteItem()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanDeleteItem()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canFindById()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanFindById()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canQueryAll()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanQueryAll()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function canQueryOne()
    {
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCanQueryOne()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertTrue(true);').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL;
        return $b;
    }
    */
}