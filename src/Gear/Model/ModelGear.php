<?php
namespace Gear\Model;
class ModelGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Model';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();

        if (is_array($entities) && count($entities)>0) {
            foreach ($entities as $i => $table) {
                $this->createModel($this->str('uline',$table));
            }
        } else {
            return false;
        }
    }

    public function createModel($table)
    {

        $module = $this->getModule();
        $path   = $this->getFinalPath();

        $class = $this->str('class', $table);
        $columns = $this->getColumns($table);

        $b = '';
        $b .= $this->getNamespace($module.'\\Model');
        $b .= $this->getUse();
        $b .= $this->getClass($this->getFileName($this->str('class', $table)));

        if ($this->checkImage($table)) {
            $b .= $this->insertFunctionId($module, $table, $columns);
            //$b .= $this->updateFunctionId($module,$table,$columns);
            //$b .= $this->deleteFunctionId($table);

        } else {
            $b .= $this->insertFunction($module, $table, $columns);
        }
        $b .= $this->updateFunction($module,$table,$columns);
        $b .= $this->deleteFunction($table);

        $b .= $this->getQueryAndCountFunction($module,$table,$columns);
        $b .= $this->getAliase($table);
        $b .= $this->getLike($module,$table,$columns);
        $b .= $this->getOrderFactory($module,$table,$columns);
        $b .= $this->selectByIdFunction($module,$table,$columns);
        $b .= $this->exportEntity($module,$table,$columns);

        $b .= $this->getEndFile();
        //die();
        $this->mkPHP($path, $this->getFileName($table).'Model',$b);
    }

    public function getAliase($table)
    {
        $b  = $this->getIndent(1).trim('public function getAliase()').PHP_EOL;
        $b  .= $this->getIndent(1).trim('{').PHP_EOL;
        $b  .= $this->getIndent(2).trim('    return \''.$this->getAliasTable($this->str('uline',$table)).'\';').PHP_EOL;
        $b  .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getOrderFactory($module,$table,$columns)
    {
        $b  = $this->getIndent(1).trim('public function getOrderFactory($order)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        $selectedColumns = [***REMOVED***;

        foreach ($columns as $i => $v) {
            if ($v->pk) {
                $default = $v;
            }
            if (!in_array($v->name,$this->getConfig()->getDBException())) {
                $selectedColumns[***REMOVED*** = $v;
            }
        }

        if (count($selectedColumns)>0) {

            $b .= $this->getIndent(2).trim('    switch ($order) {').PHP_EOL;

            foreach ($selectedColumns as $i => $v) {

                $b .= $this->getIndent(3).trim('case \''.$this->str('var', $v->name).'\':').PHP_EOL;

                if ($this->str('uline',$v->table) == $this->str('uline',$table)) {

                    if ($v->fk != false && $this->str('uline',$table) != $this->str('uline',$v->fk)) {

                        $columnSafe = $this->getSafeColumn($v->fk);

                        if ($columnSafe==null) {
                            throw new \Exception('Não foi possível encontrar a coluna segura pra relacionar com a tabela principal nas ordenações de listagem');
                        } else {
                            $b .= $this->getIndent(4).trim('    $alias =\''.$this->getAliasTable($table,$v->fk).'.'.$this->str('var',$columnSafe).'\';').PHP_EOL;
                        }
                        //
                    } else {
                        $b .= $this->getIndent(4).trim('    $alias =\''.$this->getAliasTable($table).'.'.$this->str('var',$v->name).'\';').PHP_EOL;
                    }
                }
                $b .= $this->getIndent(4).trim('    break;').PHP_EOL;
            }

            if (isset($default)) {
                $b .= $this->getIndent(3).trim('default:').PHP_EOL;
                $b .= $this->getIndent(4).trim('    $alias =\''.$this->getAliasTable($table).'.'.$this->str('var',$default->name).'\';').PHP_EOL;
                $b .= $this->getIndent(4).trim('    break;').PHP_EOL;

            }

            $b .= $this->getIndent(2).trim('    }').PHP_EOL;
        } else {
            $b .= $this->powerLine(2,'    $alias =\''.$this->getAliasTable($table).'.'.$this->str('var',$default->name).'\';');
        }

        $b .= $this->getIndent(2).trim('    return $alias;').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL;

        return $b;
    }

    public function filterFields($columns,array $dataType)
    {
        $filtered = array();
        foreach ($columns as $i => $v) {
            if (in_array($v->dataType,$dataType)) {
                $filtered[***REMOVED*** = $v;
            }
        }

        return $filtered;
    }

    public function getLike($module,$table,$columns)
    {

        $text = $this->filterFields($columns, array('varchar','text'));

        if ($this->getConfig()->getPrefix() == '') {
            $alias = $this->getAliasTable($this->str('uline',$table));
        } else {
            $alias = $this->getAliasTable($this->str('uline',$this->getFileName($table)));
        }

        //var_dump($this->getAliasTable($this->str('uline',$this->getFileName($table))));die();

        $like = '';
        if (count($text)>0) {

            $b  = $this->getIndent(1).trim('public function getLike($value)').PHP_EOL;
            $b .= $this->getIndent(1).trim('{').PHP_EOL;
            $b .= $this->getIndent(2).trim('    return ').PHP_EOL;

           foreach ($text as $i => $v) {
               //if($this->str('uline',$v->table) == $th
               if (strlen($like)>0) {
                   $like = '.\''.$alias.'.'.$this->str('var',$v->name).' like \\\'\'.$value.\'\\\'';
               } else {
                    $like .=  '\''.$alias.'.'.$this->str('var',$v->name).' like \\\'\'.$value.\'\\\'';
                }
                if ($i+1 < count($text)) {
                    $like .= ' OR \'';
                } else {
                    $like .= '\';';
                }
                $b  .= $this->getIndent(3).trim($like).PHP_EOL;

            }
        } else {
            $b  = $this->getIndent(1).trim('public function getLike()').PHP_EOL;
            $b .= $this->getIndent(1).trim('{').PHP_EOL;
            $b .= $this->getIndent(2).trim('    return ').PHP_EOL;
            $b .= $this->getIndent(2).trim('\'\';').PHP_EOL;
        }
         $b  .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

         return $b;

    }

    public function getUse()
    {
        $b = 'use Zend\ServiceManager\ServiceLocatorAwareInterface;'.PHP_EOL;
        $b .= 'use Application\Model\AbstractModel;'.PHP_EOL;
        $b .= PHP_EOL;

        return $b;
    }

    public function getClass($className)
    {
        return 'class '.$className.'Model extends AbstractModel implements ServiceLocatorAwareInterface'.PHP_EOL.'{'.PHP_EOL.PHP_EOL;
    }

    //public function

    public function insertFunction($module,$table,$columns)
    {
        $var = $this->toVar($table);

        $b  = $this->getIndent(1).trim('public function insert($data)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$entityManager = $this->getEntityManager();').PHP_EOL;

        $b .= $this->getIndent(2).trim('$'.$this->toVar($table).' = new \\'.$module.'\Entity\\'.$this->strBuilder('class',$table).'();').PHP_EOL;
        foreach ($columns as $i => $v) {
            if (!$v->pk && !$v->ts) {
                if ($v->fk) {
                    $newClass = preg_replace('/^.{2}/', '', $v->name);
                    $sql = $this->powerline(2, '$%s->set%s(',array($var,$v->name));
                    $sql .= $this->powerLine(3,'$entityManager->getRepository(\'%s\Entity\%s\')->find($data[\'%s\'***REMOVED***)',array($module,$this->strBuilder('class',$v->fk),$this->toVar($v->name)));
                    $sql .= $this->powerLine(2,');');
                    $b .= $sql;
                } elseif ($v->dataType=='datetime') {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'(new \DateTime($data[\''.$this->toVar($v->name).'\'***REMOVED***));').PHP_EOL;
                } else {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'($data[\''.$this->toVar($v->name).'\'***REMOVED***);').PHP_EOL;
                }
            } elseif ($v->ts) {
                $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'(new \DateTime(\'now\'));').PHP_EOL;
            }
        }
        $b .= $this->getIndent(2).trim('$entityManager->persist($'.$this->toVar($table).');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$entityManager->flush();').PHP_EOL;

        $b .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;

        return $b;
    }

    public function insertFunctionId($module,$table,$columns)
    {
        $var = $this->toVar($table);

        $b  = $this->getIndent(1).trim('public function preInsert()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;

        $b .= $this->getIndent(2).trim('$entityManager = $this->getEntityManager();').PHP_EOL;

        $b .= $this->getIndent(2).trim('$'.$this->toVar($table).' = new \\'.$module.'\Entity\\'.$this->strBuilder('class',$table).'();').PHP_EOL;

        foreach ($columns as $i => $v) {

            /*
            if (!$v->ts && $v->null==false && !$v->pk) {
                if ($v->fk) {
                    $newClass = preg_replace('/^.{2}/', '', $v->name);
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'($entityManager->getRepository(\''.$module.'\Entity\\'.$this->strBuilder('class',$v->fk).'\')->find($data[\''.$this->toVar($v->name).'\'***REMOVED***));').PHP_EOL;
                } elseif ($v->dataType=='datetime') {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'(new \DateTime($data[\''.$this->toVar($v->name).'\'***REMOVED***));').PHP_EOL;
                } else {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'($data[\''.$this->toVar($v->name).'\'***REMOVED***);').PHP_EOL;
                }
            }*/
        }

        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).trim('public function insert($data)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$entityManager = $this->getEntityManager();').PHP_EOL;

        $b .= $this->getIndent(2).trim('$'.$this->toVar($table).' = new \\'.$module.'\Entity\\'.$this->strBuilder('class',$table).'();').PHP_EOL;
        foreach ($columns as $i => $v) {
            if (!$v->pk && !$v->ts) {
                if ($v->fk) {
                    $newClass = preg_replace('/^.{2}/', '', $v->name);
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'($entityManager->getRepository(\''.$module.'\Entity\\'.$this->strBuilder('class',$v->fk).'\')->find($data[\''.$this->toVar($v->name).'\'***REMOVED***));').PHP_EOL;
                } elseif ($v->dataType=='datetime') {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'(new \DateTime($data[\''.$this->toVar($v->name).'\'***REMOVED***));').PHP_EOL;
                } else {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'($data[\''.$this->toVar($v->name).'\'***REMOVED***);').PHP_EOL;
                }
            } elseif ($v->ts) {
                $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'(new \DateTime(\'now\'));').PHP_EOL;
            }
        }
        $b .= $this->getIndent(2).trim('$entityManager->persist($'.$this->toVar($table).');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$entityManager->flush();').PHP_EOL;

        $b .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;

        return $b;
    }

    public function updateFunction($module,$table,$columns)
    {
        $var = $this->toVar($table);

        $b  = $this->getIndent(1).'public function update($data)'.PHP_EOL;
        $b .= $this->getIndent(1).'{'.PHP_EOL;
        $b .= $this->getIndent(2).trim('$entityManager = $this->getEntityManager();').PHP_EOL;

        $b .= $this->getIndent(2).trim('$'.$var.' = $entityManager->getRepository(\''.$module.'\Entity\\'.$this->strBuilder('class',$table).'\')->find($data[\'id'.$this->getFileName($this->str('class',$table)).'\'***REMOVED***);').PHP_EOL;

        //$b .= $this->getIndent(1).trim('$'.$this->toVar($table).' = new \\'.$module.'\Entity\\'.$table.'();').PHP_EOL;
        foreach ($columns as $i => $v) {
            if (!$v->pk && !$v->ts) {
                if ($v->fk) {
                    $newClass = preg_replace('/^.{2}/', '', $v->name);
                    $sql = $this->powerline(2, '$%s->set%s(',array($var,$v->name));
                    $sql .= $this->powerLine(3,'$entityManager->getRepository(\'%s\Entity\%s\')->find($data[\'%s\'***REMOVED***)',array($module,$this->strBuilder('class',$v->fk),$this->toVar($v->name)));
                    $sql .= $this->powerLine(2,');');
                    $b .= $sql;
                } elseif ($v->dataType=='datetime') {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'(new \DateTime($data[\''.$this->toVar($v->name).'\'***REMOVED***));').PHP_EOL;
                } else {
                    $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'($data[\''.$this->toVar($v->name).'\'***REMOVED***);').PHP_EOL;
                }
            } elseif ($v->ts) {
                $b .= $this->getIndent(2).trim('$'.$var.'->set'.$v->name.'(new \DateTime(\'now\'));').PHP_EOL;
            }
        }
        $b .= $this->getIndent(2).trim('$entityManager->persist($'.$this->toVar($table).');').PHP_EOL;
        $b .= $this->getIndent(2).trim('$entityManager->flush();').PHP_EOL;
        $b .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;

        return $b;
    }

    public function deleteFunction($table)
    {
        $var = $this->toVar($table);
        $class = $this->str('class',$table);

        $b  = $this->getIndent(1).'public function delete($id'.$class.')'.PHP_EOL;
        $b .= $this->getIndent(1).'{'.PHP_EOL;
        $b .= $this->getIndent(2).trim('    $'.$var.' = $this->selectById($id'.$class.');').PHP_EOL;
        $b .= $this->getIndent(2).trim('    if ($'.$var.') {').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $entityManager = $this->getEntityManager();').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $entityManager->remove($'.$var.');').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $entityManager->flush();').PHP_EOL;
        $b .= $this->getIndent(3).trim('        return true;').PHP_EOL;
        $b .= $this->getIndent(2).trim('    } else {').PHP_EOL;
        $b .= $this->getIndent(3).trim('        return false;').PHP_EOL;
        $b .= $this->getIndent(2).trim('    }').PHP_EOL;
        $b .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;

        return $b;
    }

    public function getAliasTable($tableName,$tableReferencedName = null)
    {
        if (!empty($tableName)) {
            if ($this->getConfig()->getPrefix() == '') {
                $columns = $this->getColumns($tableName);
                $alias = $this->getAlias($columns);
                //var_dump($alias);die();
                if ($tableReferencedName==null) {
                    return $alias['from_alias'***REMOVED***;
                } else {
                    foreach ($alias['toAlias'***REMOVED*** as $a => $b) {
                        if ($b->fk == $tableReferencedName) {
                            $alias = $b->alias;
                        }
                    }

                    return $alias;
                }
            }
        }
    }

    public function getAlias($columns)
    {

        $from_alias  = '';
        $from_column = '';
        $toAlias     = array();
        $tablesAlias = array();
        foreach ($columns as $i => $v) {
            if ($v->pk || $v->fk) {
                for ($b = 2; $b < strlen($v->name); $b++) {
                    if (!in_array(strtolower($v->name[$b***REMOVED***),$tablesAlias)) {
                        $v->alias = strtolower($v->name[$b***REMOVED***);
                        $toAlias[***REMOVED*** = $v;
                        if ($v->pk) {
                            $from_column = $this->str('var',$v->name);
                            $from_alias = $v->alias;
                        }
                        $tablesAlias[***REMOVED*** = $v->alias;
                        break;
                    } else {
                        continue;
                    }
                }
            }
        }

        return array(
            'from_alias'  => $from_alias,
            'from_column' => $from_column,
            'tablesAlias'  => $tablesAlias,
            'toAlias'     => $toAlias,
        );
    }

    public function getQueryAndCountFunction($module,$table,$columns)
    {

        $dataAlias = $this->getAlias($columns);
        $from_alias  = $dataAlias['from_alias'***REMOVED***;
        $from_column = $dataAlias['from_column'***REMOVED***;
        $toAlias     = $dataAlias['toAlias'***REMOVED***;
        $tablesAlias = $dataAlias['tablesAlias'***REMOVED***;

        $createSql = 'SELECT ';

        if (count($toAlias)>0) {
            foreach ($toAlias as $i => $v) {
                $createSql .= $v->alias;
                if (isset($toAlias[$i+1***REMOVED***)) {
                    $createSql .= ',';
                }
            }
        }

        //var_dump($toAlias);die();
        //$createSql .= $sqlAlias;
        $createSql .= ' FROM '.$module.'\Entity\\'.$this->toClass($table).' '.$from_alias;

        if (count($toAlias)>0) {
            foreach ($toAlias as $i => $v) {
                if ($v->fk) {

                    $join = ($v->nl) ? 'LEFT JOIN' : 'JOIN';

                    $createSql .= ' '.$join.' '.$from_alias.'.'.$this->str('var',$v->name).' '.$v->alias;

                }
            }
        }

        $createCountSql = '
            SELECT COUNT('.$from_alias.'.'.$from_column.')'
         .' FROM '.$module.'\Entity\\'.$this->toClass($table).' '.$from_alias;

        if (count($toAlias)>0) {
            foreach ($toAlias as $i => $v) {
                if ($v->fk) {
                    $createCountSql .= ' JOIN '.$from_alias.'.'.$this->str('var',$v->name).' '.$v->alias;

                }
            }
        }

        $b  = $this->getIndent(1).'public function getQueryCount()'.PHP_EOL;
        $b .= $this->getIndent(1).'{'.PHP_EOL;
        $b .= $this->getIndent(2).trim('return \''.$createCountSql.'\';').PHP_EOL;
        $b .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).'public function getQuery()'.PHP_EOL;
        $b .= $this->getIndent(1).'{'.PHP_EOL;
        $b .= $this->getIndent(2).trim('return \''.$createSql.'\';').PHP_EOL;
        $b .= $this->getIndent(1).'}'.PHP_EOL.PHP_EOL;

        return $b;
    }

    public function selectByIdFunction($module,$table,$columns)
    {
        $class = $this->str('class',$table);
        $b  = $this->getIndent(1).trim('public function selectById($id'.$class.')').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $this->getEntityManager()->getRepository(\'\\'.$module.'\Entity\\'.$this->strBuilder('class',$table).'\')->find($id'.$class.');').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        return $b;
    }

    public function exportEntity($module,$table,$columns)
    {
        $class = $this->str('class',$table);
        $b  = $this->getIndent(1).trim('public function exportEntity($id'.$class.')').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('    $'.$this->str('var',$table).' = $this->selectById($id'.$class.');').PHP_EOL;

        $b .= $this->getIndent(2).trim(sprintf('if (isset($%s)) {',$this->str('var',$table))).PHP_EOL;

        $b .= $this->getIndent(3).trim('    return array(').PHP_EOL;

        foreach ($columns as $i => $v) {
            if (!$v->ts) {
                $b .= $this->getIndent(4).trim('       \''.$this->str('var',$v->name).'\'   => $'.$this->str('var',$table).'->get'.$this->str('class',$v->name).'(),').PHP_EOL;
            }
        }
        $b .= $this->getIndent(3).trim('   );').PHP_EOL;

        $b .= $this->getIndent(2).trim('} else {').PHP_EOL;
        $b .= $this->getIndent(3).trim('    return null;').PHP_EOL;

        $b .= $this->getIndent(2).trim('}').PHP_EOL;

        $b .= $this->getIndent(1).trim('}').PHP_EOL;

        return $b;
    }

}
