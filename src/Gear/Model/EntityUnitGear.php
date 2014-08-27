<?php
namespace Gear\Model;
class EntityUnitGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if(is_array($entities) && count($entities)>0) {
            foreach($entities as $i => $table) {
                $this->createEntity($this->getModule(), $table,$this->getLocal().'/tests/ModulesTests/'.$this->getModule().'Test/Entity');
            }
        } else {
            return false;
        }
    }

    public function createEntity($module,$table,$path)
    {
        $module = $this->str('class',$module);
        $class  = $this->str('class',$table);


        $columns = $this->getColumns($table,$this->getConfig()->getPrefix());

        $b = '';
        $b .= $this->getNamespace($module.'Test\Entity');
        $b .= $this->getUse();
        $b .= $this->getClass($class);
        $b .= $this->getSetUp();
        $b .= $this->createNewEntity($module,$table);
        $b .= $this->entityFieldsReturnEmpty($module,$table,$columns);
        $b .= $this->setEntityValuesSuccessful($module,$table,$columns);
        $b .= $this->setEntityValuesNullAfterPopulated($module,$table,$columns);
        $b .= $this->getEndFile();

        //die($path);
        return $this->mkPHP($path, $class.'EntityTest',$b);
    }

    public function getUse()
    {
        return '';
    }

    public function getClass($className)
    {
        return 'class '.$className.'EntityTest extends \PHPUnit_Framework_TestCase'.PHP_EOL.'{'.PHP_EOL;
    }

    public function getSetUp()
    {
        $b = '';
        $b .= $this->getIndent(1).trim("public function setUp()").PHP_EOL;
        $b .= $this->getIndent(1).trim("{").PHP_EOL;
        $b .= $this->getIndent(2).trim('$bootstrap = new \ModulesTests\Bootstrap();').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->entityManager = $bootstrap->getEntityManager();').PHP_EOL;
        $b .= $this->getIndent(2).trim("    parent::setUp();").PHP_EOL;
        $b .= $this->getIndent(1).trim("}").PHP_EOL.PHP_EOL;
        return $b;
    }

    public function createNewEntity($module,$table)
    {
        $var = $this->toVar($table);
//var_dump($var);die();
        $b = '';
        $b .= $this->getIndent(1).trim('public function testCreateNewEntity()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$'.$var.'Entity = new \\'.$module.'\Entity\\'.$this->underlineToClass($table).'();').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->assertInstanceOf(\'\\'.$module.'\Entity\\'.$this->underlineToClass($table).'\', $'.$var.'Entity);').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$var.'Entity;').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function entityFieldsReturnEmpty($module,$table,$columns)
    {
        $var = $this->toVar($table);

        $b = '';
        $b .= $this->getIndent(1).trim('/**').PHP_EOL;
        $b .= $this->getIndent(1).trim(' * @depends testCreateNewEntity').PHP_EOL;
        $b .= $this->getIndent(1).trim(' */').PHP_EOL;
        $b .= $this->getIndent(1).trim('public function testEntityFieldsReturnEmpty(\\'.$module.'\Entity\\'.$this->underlineToClass($table).' $'.$var.')').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        foreach($columns as $i => $v) {
            //if(!$v->pk) {
                $b .= $this->getIndent(2).trim('$this->assertNull($'.$var.'->get'.$v->name.'());').PHP_EOL;
            //}
        }
        $b .= $this->getIndent(2).trim('return $'.$var.';').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function setEntityValuesSuccessful($module,$table,$columns)
    {
        $var = $this->toVar($table);

        $b = '';
        $b .= $this->getIndent(1).trim('/**').PHP_EOL;
        $b .= $this->getIndent(1).trim(' * @depends testEntityFieldsReturnEmpty').PHP_EOL;
        $b .= $this->getIndent(1).trim(' */').PHP_EOL;
        $b .= $this->getIndent(1).trim('public function testSetEntityValuesSuccessful(\\'.$module.'\Entity\\'.$this->underlineToClass($var).' $'.$var.'Entity)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        $faker = new \Gear\Model\FakerGear($this->getConfig());

        $b .= $faker->setRandomValues($module,$var,$columns);

        foreach($columns as $i => $v) {
            if(!$v->pk) {
                $b .= $this->getIndent(2).trim('$this->assertEquals($'.$var.'Entity->get'.$v->name.'(), $'.$this->toVar($v->name).');').PHP_EOL;
            }
        }
        $b .= PHP_EOL;
        $b .= $this->getIndent(2).trim('return $'.$var.'Entity;').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;
        return $b;
    }

    public function setEntityValuesNullAfterPopulated($module,$table,$columns)
    {
        $var = $this->toVar($table);

        $b = '';
        $b .= $this->getIndent(1).trim('/**').PHP_EOL;
        $b .= $this->getIndent(1).trim(' * @depends testSetEntityValuesSuccessful').PHP_EOL;
        $b .= $this->getIndent(1).trim(' */').PHP_EOL;
        $b .= $this->getIndent(1).trim('public function testSetEntityValuesNullAfterPopulated(\\'.$module.'\Entity\\'.$this->underlineToClass($table).' $'.$var.'Entity)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        foreach($columns as $i => $v) {
            if(!$v->pk) {
                $b .= $this->getIndent(2).trim('$'.$var.'Entity->set'.$v->name.'(null);').PHP_EOL;
            }
        }

        foreach($columns as $i => $v) {
            $b .= $this->getIndent(2).trim('$this->assertNull($'.$var.'Entity->get'.$v->name.'());').PHP_EOL;
        }

        $b .= $this->getIndent(1).trim('}').PHP_EOL;
        return $b;
    }


}