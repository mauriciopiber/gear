<?php
namespace Gear\Model;
/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class FakerGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function create()
    {
        return '$faker = \Faker\Factory::create(\'pt_BR\');';
    }

    public function getProviderFixture($module,$columns,$fixture = true,$exclude = true)
    {
        $b = '';
        foreach($this->setProvider($module,$columns,$fixture,$exclude) as $i => $v) {
            $b .= $this->getIndent(2).trim($v).PHP_EOL;
        }
        return $b;
    }

    public function getReference()
    {

    }

    public function setFixture($table,$total = 2)
    {
        $b = $this->getIndent(2).trim($this->create()).PHP_EOL.PHP_EOL;

        $b .= $this->getProviderFixture($this->getModule(),$table->getColumnsFix(),true);

        for($c = 0; $c < $total; $c++) {

            $b .= $this->getIndent(2).trim('$'.$table->getVar().' = new \\'.$this->getModule().'\Entity\\'.$table->getEntity().'();').PHP_EOL;

            foreach($this->setData($this->getModule(),$table->getColumnsFix()) as $i => $v) {

                $b .= $this->getIndent(2).trim($v).PHP_EOL;
            }
            foreach($table->getColumnsFix() as $i => $v) {
                if(!$v->pk) {
                    if(!$v->fk) {

                        if($v->ts) {
                            $b .= $this->getIndent(2).trim('$'.$table->getVar().'->set'.$v->name.'(new \DateTime(\'now\'));').PHP_EOL;
                        } else {
                            $b .= $this->getIndent(2).trim('$'.$table->getVar().'->set'.$v->name.'($'.$this->toVar($v->name).');').PHP_EOL;
                        }


                    } else {
                        $b .= $this->getIndent(2).trim('$'.$table->getVar().'->set'.$v->name.'($this->getReference(\''.$this->str('url',$this->getFileName($v->fk)).'-'.rand(0,9).'\'));').PHP_EOL;
                    }
                }
            }
            $b .= PHP_EOL;
            $b .= $this->getIndent(2).trim('$manager->persist($'.$table->getVar().');').PHP_EOL;
            $b .= $this->getIndent(2).trim('$manager->flush();').PHP_EOL;

            $b .= $this->getIndent(2).trim('$this->addReference(\''.$table->getUrl().'-'.$c.'\', $'.$table->getVar().');').PHP_EOL;
            $b .= PHP_EOL;
        }

        return $b;
    }

    public function setData($module,$columns)
    {
        $data = array();

        foreach($columns as $i => $v) {
            switch($v->dataType) {
            	case 'int':
            	    if($v->pk == false && $v->fk == false) {
                        $data[***REMOVED*** = $this->addIntData($v);
            	    }
            	    break;
            	case 'varchar':
            	    $data[***REMOVED*** = $this->addVarcharData($v);
            	    break;
            	case 'text':
            	    $data[***REMOVED*** = $this->addTextData($v);
            	    break;
            	case 'datetime':
            	case 'timestamp':
            	    $data[***REMOVED*** = $this->addDateData($v);
            	    break;
            	case 'date':
            	    $data[***REMOVED*** = $this->addDate($v);
            	    break;
            	case 'decimal':
            		$data[***REMOVED*** = $this->addDecimal($v);
            }
        }
        return $data;
    }

    public function getFakeData($v) {
        $data = '';
        switch($v->dataType) {
        	case 'int':
        	    if($v->pk == false && $v->fk == false) {
        	        $data = $this->getIntFake($v);
        	    } else if($v->fk) {
        	       $data = $this->getRandomEntityFake($v);
        	    }
        	    break;
        	case 'varchar':
        	    $data = $this->getVarcharFake($v);
        	    break;
        	case 'text':
        	    $data = $this->getTextFake($v);
        	    break;
        	case 'datetime':
        	case 'timestamp':
        	    $data = $this->getDateTimeFake($v);
        	    break;
        	case 'date':
        	    $data = $this->getDateFake($v);
        	    break;
        	case 'decimal':
        	    $data  = $this->getDecimalFake($v);
        	    break;
        	default:
        	    $data = '';
        	    break;
        }
        return $data;
    }

    public function getRandomEntityFake($column) {

        return '$this->getSingleFixture(\''.$this->str('class',$column->fk).'\')->getId'.$this->str('class',$column->fk).'()';
        //var_dump($column);die();
    }

    public function getDateFake($column)
    {
        return 'new \DateTime($faker->date(\'Y-m-d\', \'now\'))';
    }

    public function getTextFake($column)
    {
        return '$faker->text(300)';
    }

    public function getIntFake($column)
    {
        return '$faker->randomDigitNotNull()';
    }

    public function getVarcharFake($column)
    {
        $managerGear = new \Gear\Model\ManagerGear($this->getConfig());
        //var_dump($column->name);
        //var_dump($column->table);
        //$speciality = $managerGear->getSpeciality($column->table, $column->name);
        $speciality = '';
        //var_dump($speciality);
        switch($speciality) {
        	case 'Hexadecimal':
        	    $faker = "str_replace('#','',".'$faker->hexcolor())';
        	    break;
        	case 'default':
        	default:
                $faker = '$faker->sentence(4)';
        	    break;
        }

        return $faker;
    }

    public function getDateTimeFake($column)
    {
        return '$faker->dateTimeThisYear()';
    }

    public function getDecimalFake($column)
    {
        return '$faker->randomFloat(2, 0, 200000)';
    }

    public function addDate($column)
    {
        return '$'.$this->toVar($column->name).' = new \DateTime($faker->date(\'Y-m-d\', \'now\'));';
    }

    public function addTextData($column)
    {
        return '$'.$this->toVar($column->name).' = $faker->text(300);';
    }

    public function addIntData($column)
    {
        return '$'.$this->toVar($column->name).' = $faker->randomDigitNotNull();';
    }

    public function addVarcharData($column)
    {
        return '$'.$this->toVar($column->name).' = $faker->sentence(4);';
    }

    public function addDateData($column)
    {
        return '';// '$'.$this->toVar($column->name).' = $faker->dateTimeThisYear();';
    }

    public function addDecimal($column)
    {
    	return '$'.$this->toVar($column->name).' = $faker->randomFloat(2, $min = 0, $max = 200000);';
    }

    public function setProvider($module,$columns,$fixture = false)
    {
        $exclude = array();
        $providers = array();

        foreach($columns as $i => $v) {
            switch($v->dataType) {
            	case 'int':
            	    if($v->pk == true) {
            	    	continue;
            	    } elseif($v->fk !== false) {
            	        if(!in_array($v->fk,$exclude)){
            	            $exclude[***REMOVED*** = $v->name;
            	            if($fixture == false) {
            	                $providers[***REMOVED*** = $this->addEntityProvider($module,$v->name,$v->fk);
            	            } else {
            	                continue;
            	                $providers[***REMOVED*** = $this->addReferenceProvider($module,$v->name,$v->fk);
            	            }
            	        }
            	    } elseif(!in_array('int',$exclude)) {
            	        $exclude[***REMOVED*** = 'int';
            	        $providers[***REMOVED*** = $this->addIntProvider();
            	    }
            	    break;
            	case 'varchar':
            	case 'text'   :
            	    if(!in_array('varchar',$exclude)) {
                        $exclude[***REMOVED*** = 'varchar';
                        $providers[***REMOVED*** = $this->addCharProvider();
            	    }
            	    break;
            	case 'datetime':
            	case 'timestamp':
            	case 'date':
            	    if(!in_array('datetime',$exclude)) {
            	        $exclude[***REMOVED*** = 'datetime';
            	        $providers[***REMOVED*** = $this->addDateTimeProvider();
            	    }
            }
        }
        return $providers;

    }

    public function addIntProvider()
    {
        //return 'int';
    }

    public function addEntityProvider($module,$name,$entity)
    {
        //var_dump($entity);die();
    	return  '$'.$this->toVar($name).' = new \\'.$module.'\Entity\\'.$this->underlineToClass($entity).'();';
    }

    public function addReferenceProvider($module,$name,$entity)
    {
        //die('caiu');
        //var_dump($entity);die();

        return  '$'.$this->toVar($name).' = $this->getReference(\''.$this->str('url',$this->getFileName($entity)).'-'.rand(0,9).'\');';
    }

    public function addDateTimeProvider()
    {
    	return '$faker->addProvider(new \Faker\Provider\DateTime($faker));';
    }

    public function addCharProvider()
    {
        return '$faker->addProvider(new \Faker\Provider\Lorem($faker));';
    }

    public function fakeArray($indent,$table,$pkName = null,$tableName = null)
    {
        $dataToFake = [***REMOVED***;
        $pk = null;

        foreach($table as $i => $v) {
            if(!in_array($v->name,$this->getConfig()->getFixtureException()) && !$v->pk) {
                $dataToFake[***REMOVED*** = $v;
            } elseif($v->pk) {
                $pk = $v;
            }
        }
        $b = '';
        /*
        foreach($dataToFake as $i => $v) {
            if($v->fk !== false) {

                $varTable = $this->str('var',$v->fk);
                $tableClass = $this->str('class',$v->fk);
                $moduleClass = $this->str('class',$this->getModule());
                $b .= $this->getIndent($indent).trim(sprintf('$%sEntity = $this->entityManager->getRepository(\'%s\Entity\%s\')->findOne();',$varTable,$moduleClass,$tableClass)).PHP_EOL;
                //var_dump($v);die();
            }
        }
*/
        $b .= $this->getIndent($indent).trim('$data = array(').PHP_EOL;

        if($pkName && $pk) {
            $controllerVar = $this->str('var',$tableName);
            $b .= $this->getI($indent+1).trim(sprintf('\'%s\' => $%sEntity->getId%s(),',$pkName,$controllerVar,$this->str('class',$tableName))).PHP_EOL;
        }

        foreach($dataToFake as $i => $v) {
            $b .= $this->getIndent($indent+1).trim('\''.$this->str('var',$v->name).'\' => '.$this->getFakeData($v).',').PHP_EOL;
        }

        $b .= $this->getIndent($indent).trim(');').PHP_EOL;

        return $b;
    }

    public function getProvider($module,$columns,$fixture = false)
    {
        $b = '';
        foreach($this->setProvider($module,$columns,$fixture) as $i => $v) {
            $b .= $this->getIndent(2).trim($v).PHP_EOL;
        }
        return $b;
    }

    public function setRandomValues($module,$table,$columns)
    {
        $b  = $this->getIndent(2).trim($this->create()).PHP_EOL;
        $b .= $this->getIndent(2).trim($this->getProvider($module,$columns)).PHP_EOL;

        $b .= PHP_EOL;

        foreach($this->setData($module,$columns) as $i => $v) {

            $b .= $this->getIndent(2).trim($v).PHP_EOL;
        }
        $b .= PHP_EOL;

        foreach($columns as $i => $v) {
            if(!$v->pk) {
                $b .= $this->getIndent(2).trim('$'.$table.'Entity->set'.$v->name.'($'.$this->toVar($v->name).');').PHP_EOL;
            }
        }
        $b .= PHP_EOL;

        return $b;

    }
}