<?php

namespace Gear\Model;

/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class FixtureGear extends MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Fixture';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if (is_array($entities) && count($entities)>0) {
            foreach ($entities as $i => $table) {
                $this->createFixture(new \Gear\Model\Table($this->getConfig(),$table));
            }
        } else {
            return false;
        }
    }

    public function getUse()
    {
        return $this->getIndent(0).trim('use Doctrine\Common\Persistence\ObjectManager;').PHP_EOL
             . $this->getIndent(0).trim('use Doctrine\Common\DataFixtures\OrderedFixtureInterface;').PHP_EOL
             . $this->getIndent(0).trim('use Doctrine\Common\DataFixtures\AbstractFixture;').PHP_EOL
             . PHP_EOL;

    }

    public function getClass($tableName)
    {
        return  'class '.$tableName.'Fixture extends AbstractFixture implements OrderedFixtureInterface'.PHP_EOL
                . '{'.PHP_EOL;
                //. PHP_EOL;

    }

    public function getLoad($tableName)
    {
        return
                $this->getIndent(1).trim('/**').PHP_EOL
              . $this->getIndent(1).trim('  * @SuppressWarnings(PHPMD.ExcessiveMethodLength)').PHP_EOL
              . $this->getIndent(1).trim('  */').PHP_EOL
              . $this->getIndent(1).trim('public function load(ObjectManager $manager)').PHP_EOL
              . $this->getIndent(1).trim('{').PHP_EOL;
    }

    public function getEndLoad()
    {
        return $this->getIndent(1).trim('}').PHP_EOL;
    }

    public function createFixture(\Gear\Model\Table $table)
    {
        //$module  = $this->getModule();

        //$class   = $this->str('class',$table);
        //$schema  = new Schema($this->getAdapter());
        //$columns = $schema->getColumns($table);

        $b  = $this->getNamespace($this->getModule().'\\Fixture');
        $b .= $this->getUse();
        $b .= $this->getClass($table->getClass());
        $b .= $this->getLoad($table->getName());
        $b .= $this->getObjects($table,10);
        $b .= $this->getEndLoad();
        $b .= $this->getOrder($table);
        $b .= $this->getEndFile();
        $this->mkPHP($this->getFinalPath(), $this->getFileName($table->getName()).'Fixture',$b);

    }

    //função recursiva pra encontrar o máximo de profundidade de uma tabela mysql.

    /**
     *   Pega foreign keys da tabela

     */

    public function getMaxDeep($tableName)
    {

    }

    public function getOrder($table)
    {
        $schema = new \Gear\Model\Schema($this->getConfig()->getDriver());

        //var_dump(($table->getName()));

        $foreign_num = $schema->getTableForeignKeys($table->getName());

        if (count($foreign_num) == 0) {
            //var_dump($table->getName());
            //var_dump($foreign_num);
            $count = 1;
        } elseif (count($foreign_num) > 0) {
            $max = 2;
            foreach ($foreign_num as $i => $v) {
                $deep_foreign = $schema->getTableForeignKeys($v->getReferencedTableName());
                if (count($deep_foreign)>0) {
                    $max++;
                    foreach ($deep_foreign as $x => $y) {
                        $deepest = $schema->getTableForeignKeys($y->getReferencedTableName());
                        if (count($deepest)>0) {
                            $max++;
                            foreach ($deepest as $u => $p) {
                                $deepestever = $schema->getTableForeignKeys($y->getReferencedTableName());
                                if (count($deepestever)>0) {
                                    $max++;
                                    foreach ($deepestever as $g => $h) {

                                        $lastdeep = $schema->getTableForeignKeys($y->getReferencedTableName());
                                        if (count($lastdeep)>0) {
                                            $max++;
                                        }

                                    }
                                }
                            }

                        }
                    }
                    //$deepest = $schema->
                }
                //var_dump($v->getReferencedTableName());die();

            }
            ///get the maximum deep of entity
            $count = $max;
        }
        //var_dump($count);

        //$count = count($schema->getTableForeignKeys($table->getName()))==0 ? 1 : 2;


        //var_dump($schema->getTableForeignKeys($table->getName()));die();
        return $this->getIndent(1).trim('public function getOrder()').PHP_EOL
             . $this->getIndent(1).trim('{').PHP_EOL
             . $this->getIndent(2).trim('return \''.$count.'\';').PHP_EOL
             . $this->getIndent(1).trim('}').PHP_EOL;

    }

    public function getObjects($table,$total = 10)
    {
        $faker = new \Gear\Model\FakerGear($this->getConfig());
        $b = '';

        $b .= $faker->setFixture($table,$total);
        $b .= PHP_EOL;

        return $b;
    }
}
