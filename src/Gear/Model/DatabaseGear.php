<?php
namespace Gear\Model;
/**
 * @author piber
*/
class DatabaseGear extends MakeGear implements  \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    public $em;
    public $adapter;
    private $project;
    private $moduleType;
    private $roles;

    public function __construct()
    {

    }
    /**
     * Refactoring
     */

    public function getProjectMetadata()
    {
        $file = realpath(__DIR__.sprintf('/../../../../../metadata/%s/',$this->getConfig()->getProject())).'/metadata.json';
        $file = file_get_contents($file);
        try {
            $file = \Zend\Json\Json::decode($file);
        } catch (Exception $e) {
            echo "Exceção pega: ", $e->getMessage(), "\n";
        }

        return $file;
    }

    public function verifyProject()
    {
        $metadata = $this->getProjectMetadata();

        $projectEntity = $this->getEntityManager()
        ->getRepository('Manager\Entity\Project')
        ->findOneBy(
            array(
                'name' => $metadata->name
            )
        );

        if (!$projectEntity) {
            $projectEntity = new \Manager\Entity\Project();
            $projectEntity->setName($metadata->name);
            $projectEntity->setGit($metadata->git);
            $projectEntity->setVhost($metadata->vhost);
            $projectEntity->setCreated(new \DateTime());
            $this->getEntityManager()->persist($projectEntity);
            $this->getEntityManager()->flush();
        }

        return $projectEntity;
    }

    public function verifyModuleType()
    {
        $moduleType = $this->getEntityManager()->getRepository('Manager\Entity\ModuleType')->findOneBy(array(
            'name' => 'Administração'
        ));

        if ($moduleType==null) {
            $moduleType = new \Manager\Entity\ModuleType();
            $moduleType->setName('Administração');
            $moduleType->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($moduleType);
            $this->getEntityManager()->flush();
        }

        return $moduleType;
    }

    public function verifyRole($roleName)
    {
        $roleEntity = $this->getEntityManager()->getRepository('Manager\Entity\Role')->findOneBy(array('name' => $roleName));
        if ($roleEntity == null) {
            $roleEntity = new \Manager\Entity\Role();
            $roleEntity->setName($roleName);
            $roleEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($roleEntity);
            $this->getEntityManager()->flush();
        }

        return $roleEntity;
    }

    public function getModuleMetadata($moduleName)
    {
        $file = realpath(__DIR__.sprintf('/../../../../../metadata/%s/%s.json',$this->getConfig()->getProject(),$moduleName));
        $file = file_get_contents($file);
        try {
            $file = \Zend\Json\Json::decode($file);
        } catch (Exception $e) {
            echo "Exceção pega: ", $e->getMessage(), "\n";
        }

        return $file;
    }

    public function verifyController($moduleEntity, $controllerName, $controllerInvokable)
    {
        $controllerEntity = $this->getEntityManager()
            ->getRepository('Manager\Entity\Controller')
            ->findOneBy(
                array(
                    'name' => $controllerName,
                    'invokable' => $controllerInvokable,
                    'idModule' => $moduleEntity->getIdModule()
                )
            );

        if (!$controllerEntity) {
            $controllerEntity = new \Manager\Entity\Controller();
            $controllerEntity->setIdModule($moduleEntity);
            $controllerEntity->setName($controllerName);
            $controllerEntity->setInvokable(sprintf($controllerInvokable,$moduleEntity->getName()));
            $controllerEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($controllerEntity);
            $this->getEntityManager()->flush();
        }

        return $controllerEntity;
    }

    public function verifyAction($controllerEntity,$actionName)
    {
        $actionEntity = $this->getEntityManager()
            ->getRepository('Manager\Entity\Action')
            ->findOneBy(
                array(
                    'name' => $actionName,
                    'idController' => $controllerEntity->getIdController()
                )
            );
        if (!$actionEntity) {
            $actionEntity = new \Manager\Entity\Action();
            $actionEntity->setIdController($controllerEntity);
            $actionEntity->setName($actionName);
            $actionEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($actionEntity);
            $this->getEntityManager()->flush();
        }

        return $actionEntity;
    }

    public function verifyRule($controllerEntity,$actionEntity,$roleEntity)
    {
        $ruleEntity = $this->getEntityManager()
            ->getRepository('Manager\Entity\Rule')
            ->findOneBy(
                array(
                    'idAction' => $actionEntity->getIdAction(),
                    'idController' => $controllerEntity->getIdController(),
                    'idRole'       => $roleEntity->getIdRole()
                )
            );

        if (!$ruleEntity) {
            $ruleEntity = new \Manager\Entity\Rule();
            $ruleEntity->setIdController($controllerEntity);
            $ruleEntity->setIdAction($actionEntity);
            $ruleEntity->setIdRole($roleEntity);
            $ruleEntity->setCreated(new \DateTime('now'));
            $this->getEntityManager()->persist($ruleEntity);
            $this->getEntityManager()->flush();
        }

        return $ruleEntity;
    }

    public function clearRules()
    {
        $connection = $this->getEntityManager()->getConnection();

        $sql = 'DELETE FROM rule WHERE 1=1;';
        $connection->exec($sql);

        $sql = 'DELETE FROM action WHERE 1=1;';
        $connection->exec($sql);

        $sql = 'DELETE FROM controller WHERE 1=1;';
        $connection->exec($sql);

        $sql = 'DELETE FROM man_module WHERE 1=1;';
        $connection->exec($sql);
    }

    public function verifyModulesFromProjectMetadata()
    {
        $project = $this->getProjectMetadata();
        foreach ($project->modules as $v) {

            $moduleMeta = $this->getModuleMetadata($v);

            if (is_array($moduleMeta->$v)) {

                $moduleEntity = $this->verifyModule($v);

                if (!$moduleEntity) {
                    throw new \Exception('Não o foi possível verificar a existência do módulo '.$v);
                }

                $controllerKeys = (array) $moduleMeta->$v;
                foreach ($controllerKeys as $x => $y) {
                    $controllerEntity = $this->verifyController($moduleEntity, $y->name, $y->invokable);
                    foreach ((array) $y->action as $a => $b) {

                        $actionEntity = $this->verifyAction($controllerEntity,$a);
                        $roleEntity = $this->verifyRole($b);
                        $rule = $this->verifyRule($controllerEntity, $actionEntity, $roleEntity);
                        continue;

                    }

                }
            }
        }
    }

    public function rule()
    {
        $this->verifyModulesFromProjectMetadata();
    }

    public function verifyModule($moduleName)
    {
        $module = $this->getEntityManager()->getRepository('Manager\Entity\Module')->findOneBy(array('name' => $moduleName));

        if (!$module) {
            $module = new \Manager\Entity\Module();
            $module->setName($moduleName);
            $module->setCreated(new \DateTime());
            $module->setUpdated(new \DateTime());
            $this->getEntityManager()->persist($module);
            $this->getEntityManager()->flush();
        }

        return $module;
    }

    /**
     * End Refactoring
     */

    public function dropi18n($i18nPrefix)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $connection = $this->getEntityManager()->getConnection();
        //$schema->getColum
        foreach ($schema->getTables() as $i => $v) {

            if ($v->getName()==$i18nPrefix) {
                continue;
            }
            if (strpos($v->getName(),$i18nPrefix) !== false) {
                $sqlSelect    = $this->getSQLSelectI18nData($v,$i18nPrefix);

                $dataToBackup = $this->getBackupData($sqlSelect);

                $sqlAlterTable = $this->getSQLAlterTable($v,$sqlSelect['data'***REMOVED***,$i18nPrefix);

                $connection->query($sqlAlterTable);

                $sqlUpdadeBackup = $this->getSQLUpdate($v,$dataToBackup,$i18nPrefix);

                $connection->query($sqlUpdadeBackup);

                $sqlDropI18n = $this->getSQLDrop($v);

                $connection->query($sqlDropI18n);
            }

            foreach ($schema->getColumns($v->getName()) as $a => $b) {

                if (strpos($b->getName(),$i18nPrefix)) {
                    $this->dropTableColumn($v->getName(),$b->getName());
                }
                //
            }
        }
    }

    public function executeSql($sql)
    {
        $connection = $this->getEntityManager()->getConnection();

        return $connection->query($sql);
    }

    public function dropTableFK($table,$column)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $fk = $schema->getConstraints($table);

        foreach ($fk as $i => $b) {

            if ($b->getType()=='FOREIGN KEY') {
                $columns = $b->getColumns();
                $target = array_pop($columns);
                if ($target==$column) {

                    $sql = 'ALTER TABLE '.$table.' DROP FOREIGN KEY '.$b->getName();
                    $this->executeSql($sql);
                    //var_dump($b);
                }
            }
        }
    }

    public function dropTableColumn($table,$column)
    {
        $this->dropTableFK($table,$column);
        $sql = 'ALTER TABLE '.$table.' DROP COLUMN '.$column;

        return $this->executeSql($sql);

    }

    public function getSQLUpdate($table,$data,$i18nPrefix)
    {
        $primaryKey  = $this->getTargetPrimaryKey($table->getName(), $i18nPrefix);
        $sqlUpdate = '';
        foreach ($data as $c => $x) {

            $sqlUpdate .= 'UPDATE '.str_replace('_'.$i18nPrefix, '', $table->getName()).' SET ';

            $iterator = 0;

            foreach ($x as $l => $s) {
                $iterator += 1;
                if ($l == $primaryKey) {
                    continue;
                } else {
                    $sqlUpdate .= ''.$l.' = "'.htmlspecialchars($s).'"';

                    if ($iterator < (count($x))) {
                        $sqlUpdate .= ',';
                    }
                }
            }
            $sqlUpdate .= ' WHERE '.$primaryKey.' = '.$x[$primaryKey***REMOVED***.';';

        }
        //var_dump($sqlUpdate);
        return $sqlUpdate;

    }

    public function getTargetTable($table_i18n,$prefix)
    {
        return str_replace('_'.$prefix, '', $table_i18n);
    }

    public function getTargetPrimaryKey($table_i18n,$prefix)
    {
        return 'id_'.str_replace('_'.$prefix, '', $table_i18n);
    }

    public function getTableAlias($table)
    {
        return strtoupper(substr($table, 0,1));
    }

    /**
     *
     * @param  unknown $tableObject
     * @param  unknown $i18nPrefix
     * @return array   [SQL,DataConvertida***REMOVED***
     */
    public function getSQLSelectI18nData($tableObject,$i18nPrefix)
    {
        $primaryKey  = $this->getTargetPrimaryKey($tableObject->getName(), $i18nPrefix);

        $tpx         = $this->getTableAlias($tableObject->getName());

        $sql = 'SELECT '.$tpx.'.'.$primaryKey.',';

        $convert = array($primaryKey);
        $columns = $tableObject->getColumns();

        $cc = count($columns);
        foreach ($columns as $a => $b) {

            if (in_array($b->getDataType(),array('text','varchar'))) {
                $convert[***REMOVED*** = $b->getName();
            }
            $sql .= $tpx.'.'.$b->getName();

            if ($a < ($cc-1)) {
                $sql .= ', ';
            }
        }
        //var_dump($convert);
        $sql .= ' FROM '.$tableObject->getName().' '.$tpx.' WHERE '.$tpx.'.id_idioma = 1;';
//echo $sql."\n";
        return array('sql' => $sql,'data' => $convert);
    }

    public function getBackupData($sqlSelect)
    {
        $connection = $this->getEntityManager()->getConnection();

        $dataset = $connection->query($sqlSelect['sql'***REMOVED***);

        $dataToInsert = [***REMOVED***;

        while ($row = $dataset->fetch()) {
            $entity = array();
            foreach ($sqlSelect['data'***REMOVED*** as $m => $n) {
                $entity[$n***REMOVED*** = $row[$n***REMOVED***;
            }
            $dataToInsert[***REMOVED*** = $entity;
        }

        return $dataToInsert;

    }

    public function getSQLAlterTable($table,$columns,$i18nPrefix)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $targetTable = $this->getTargetTable($table->getName(), $i18nPrefix);

        $sqlChangeTable = 'ALTER TABLE '.$targetTable.' ';

        unset($columns[0***REMOVED***);

        foreach ($columns as $a => $b) {

            $column = $schema->getColumn($b, $table->getName());

            $sqlChangeTable .= 'ADD COLUMN '.$column->getName().' ';

            $sqlChangeTable .= ($column->getDataType()=='varchar') ? $column->getDataType().'('.$column->getCharacterMaximumLength().')' : $column->getDataType();

            $sqlChangeTable .= ($column->isNullable()) ? ' NULL' : ' NOT NULL';

            if ($a < (count($columns))) {
                $sqlChangeTable .= ', ';
            } else {
                $sqlChangeTable .= ';';
            }

        }

        return $sqlChangeTable;

    }

    public function getSQLDrop($table)
    {
        return 'DROP TABLE '.$table->getName().';';
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $service = $this->getServiceLocator();
            $em = $service->get('doctrine.entitymanager.orm_default');
            $this->em = $em;
        }

        return $this->em;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->sm;
    }

    public function getPrimaryKey($table)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        foreach ($schema->getConstraints($table->getName()) as $i => $v) {

            if ($v->getType()=='PRIMARY KEY') {
                return $v;
            }
        }

        return null;
    }

    public function getForeignKey($table)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $foreign = [***REMOVED***;
        foreach ($schema->getConstraints($table->getName()) as $i => $v) {

            if ($v->getType()=='FOREIGN KEY') {
                $foreign[***REMOVED*** = $v;
            }
        }

        return $foreign;
    }

    public function getTablesFromPrefix($prefix)
    {
        //var_dump($prefix);die();
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $tablesPrefixed = array();
        foreach ($schema->getTables() as $i => $v) {

            if ($prefix == false || strpos($v->getName(),$prefix.'_') !== false) {
                $tablesPrefixed[***REMOVED*** = $v;
            }
        }//die();

        return $tablesPrefixed;
    }

    public function setCreated($column)
    {
        //var_dump($column);die();
        $connection = $this->getEntityManager()->getConnection();
        $sql = 'ALTER TABLE '.$column->getName().' ADD COLUMN created datetime not null';
        $connection->query($sql);
        //echo $sql;
        //$connection->query();
    }

    public function setUpdated($column)
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = 'ALTER TABLE '.$column->getName().' ADD COLUMN updated datetime null';
        $connection->query($sql);
    }

    public function checkTableCreatedUpdated($tables)
    {
        foreach ($tables as $a => $b) {

            $created = null;
            $updated = null;

            foreach ($b->getColumns() as $i => $v) {

                if ($v->getName()=='created') {
                    $created = true;
                    continue;
                } elseif ($v->getName()=='updated') {
                    $updated = true;
                    continue;
                }
                //echo $v->getName()."\n";
                //
            }

            if ($created==null) {
                echo 'Necessário criar campo created na tabela '.$b->getName()."\n";
                $this->setCreated($b);
            }
            if ($updated==null) {
                echo 'Necessário criar campo updated na tabela '.$b->getName()."\n";
                $this->setUpdated($b);
            }
        }
    }

    public function checkPrimaryKey($fixFirstId,$prefix)
    {
        foreach ($fixFirstId as $i => $v) {

            if ($prefix) {
                $table_name = str_replace($prefix.'_','',$v->getName());
            } else {
                $table_name = $v->getName();
            }
            $fk = $this->getFKAllTables($v);
            foreach ($fk as $a => $b) {
                $this->dropFK($b);
            }

            $this->alterPrimaryKey($v,$table_name);

            foreach ($fk as $a => $b) {
                $this->createFK($b,$table_name);
            }
        }

        return true;
    }

    public function checkNormalization($prefix,$exclude = false)
    {

        $sql = $this->getServiceLocator()->get('sql_gear');

        $connection = $this->getEntityManager()->getConnection();
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $tables = $this->getTablesFromPrefix($prefix);

        $fixFirstId = [***REMOVED***;

        foreach ($tables as $i => $v) {

            if ($prefix) {
                $table_name = str_replace($prefix.'_','',$v->getName());
            } else {
                $table_name = $v->getName();
            }

            $primary_key = $this->getPrimaryKey($v);
            $columns = $primary_key->getColumns();

            if ('id_'.$table_name != array_pop($columns)) {
                $fixFirstId[***REMOVED*** = $v;
            }
        }

        $this->checkPrimaryKey($fixFirstId,$prefix);

        $this->checkTableCreatedUpdated($tables);

              /**
         *    /**
         * Função de normalização de Primary Key.
         *
         * verificar se tem Foreign Key.
         * Se tiver foreign key em outra tabela. Salvar foreign_key
         * deletar foreign key
         * criar campo pk_temp na tabela
         * definir primary key como pk_temp
         * renomear campo Primary Key para nome normalizado.
         * definir Primary Key na ID novamente.
         * deletar pk_temp
         * definir foreign key salvo novamente.
         */
    }

    public function alterPrimaryKey($primary_key,$id_table_name)
    {
        $columns = $this->getPrimaryKey($primary_key);
        $pk = $columns->getColumns();
        //var_dump($columns);die();
        echo 'ALTER TABLE '.$primary_key->getName().' CHANGE '.array_pop($pk).' id_'.$id_table_name.' INT NOT NULL AUTO_INCREMENT;'
        ."\n";

    }

    public function dropFK($foreign_key)
    {
        echo 'ALTER TABLE '.$foreign_key->getTableName().' DROP FOREIGN KEY '.$foreign_key->getName().';'."\n";
    }

    public function createFK($foreign_key,$reference)
    {

        $fk = $foreign_key->getColumns();
        $getIdForeign = array_pop($fk);

        echo  'ALTER TABLE '.$foreign_key->getTableName().' '
             .'ADD CONSTRAINT '.$foreign_key->getName().' FOREIGN KEY ('.$getIdForeign.') '
             .'REFERENCES '.$foreign_key->getReferencedTableName().'(id_'.$reference.') '
             .'ON UPDATE '.$foreign_key->getUpdateRule().' '
             .'ON DELETE '.$foreign_key->getDeleteRule().';'
             ."\n";
    }

    public function getFKAllTables($table)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $schema = new \Gear\Model\Schema($adapter->driver);

        $pk = $this->getPrimaryKey($table);

        $allFK = [***REMOVED***;

        //var_dump($pk);
        foreach ($schema->getTables() as $i => $v) {
            $foreign = $this->getForeignKey($v);
            foreach ($foreign as $a => $b) {
                if ($b->getReferencedTableName() == $table->getName()) {
                    $allFK[***REMOVED*** = $b;
                }
            }
        }

        return $allFK;
    }

    /**
     * Function
     */
    public function insertController($module,$controllerName)
    {
        //var_dump($this->getEntityManager()->getRepository('\Manager\Entity\Module')->findOneBy(array('name' => $module)));
        $em = $this->getEntityManager();
        $controller = new \UserControl\Entity\Controller();
        //if ($module == null) {
        $controller->setName($controllerName);
        //} else {
        //    $controller->setName($module.'\Controller\\'.$controller);
        //}
        $controller->setCreatedDate(new \DateTime('now'));
        $controller->setUpdatedDate(new \DateTime('now'));
        $controller->setIdModule($this->getEntityManager()->getRepository('\Manager\Entity\Module')->findOneBy(array('name' => $module)));

        $em->persist($controller);
        ///
        $em->flush();

    }

    public function generateDefaultAcl()
    {

        $project = array('Gear');

        $modules = array(
            'ZfcUser',
            'Gear'
        );

        $controllers = array(
            array('ZfcUser','zfcuser'),
            array('Gear','gear'),
            array('UserControl','usercontrol_controller'),
            array('UserControl','usercontrol_action'),
            array('UserControl','usercontrol_role'),
            array('UserControl','usercontrol_rule'),
        );

        $actions = array(
            array('zfcuser','index','roles' => 'user'),
            array('zfcuser','login','roles' => 'guest'),
            array('zfcuser','logout','roles' => 'user'),
            array('zfcuser','register','roles' => 'guest'),
            array('zfcuser','authenticate','roles' => 'guest'),
            array('zfcuser','changepassword','roles' => 'user'),
            array('zfcuser','changeemail','roles' => 'user'),
            array('gear','index','roles' => 'user'),
            array('gear','mount-gear','roles' => 'user'),
        );

    }

    /**
     * Função responsável por minerar as tabelas do banco de dados 1 e enviando para o banco de dados 2
     * @param Object $tables
     */
    public function mineTables($tables)
    {

    }

    /**
     * Função responsável por minerar as as colunas tabelas do banco de dados 1 e enviando para o banco de dados 2
     * @param Object $tables
     */
    public function mineColumns($tables)
    {
        foreach ($tables as $i => $table) {

            $crud = $this->getEntityManager()->getRepository('Manager\Entity\Crud')->findOneBy(array('name' => $table->getName()));

            //var_dump($tableEntity);
            $columns = $table->getColumns();
            foreach ($columns as $a => $column) {
                $fieldType = $this->getEntityManager()->getRepository('Manager\Entity\FieldType')->findOneBy(array('name' => $column->getDataType()));
                $field = new \Manager\Entity\Field();
                $field->setIdFieldType($fieldType);
                $field->setIdCrud($crud);
                $field->setName($column->getName());
                $this->getEntityManager()->persist($field);
                $this->getEntityManager()->flush();

            }
        }

    }

    /**
     * Função responsável por minerar as restrições das tabelas do banco de dados 1 e enviando para o banco de dados 2
     * @param Object $tables
     */
    public function mineConstraints($tables)
    {
        $rules = new \Manager\Entity\Rules();

        foreach ($tables as $i => $table) {
            $constraints = $table->getConstraints();

            foreach ($constraints as $c => $constraint) {
                $rules = new \Manager\Entity\Rules();

                $columns = $constraint->getColumns();
                $columns = array_pop($columns);

                $field = $this->getEntityManager()->getRepository('Manager\Entity\Field')->findOneBy(array('name' => $columns));

                $rules->setIdCrud($field->getIdCrud());
                $rules->setIdField($field);

                $rulesType = $this->getEntityManager()->getRepository('Manager\Entity\RulesType')->findOneBy(array('name' => $constraint->getType()));

                $rules->setIdRulesType($rulesType);

                if ($rulesType->getIdRulesType()=='2') {
                    $tableReference = $constraint->getReferencedTableName();

                    $rules->setIdCrudReference($this->getEntityManager()->getRepository('Manager\Entity\Crud')->findOneBy(array('name' => $tableReference)));

                    $columnsReference = $constraint->getReferencedColumns();
                    $columnsReference = array_pop($columnsReference);

                    $rules->setIdFieldReference($this->getEntityManager()->getRepository('Manager\Entity\Field')->findOneBy(array('name' => $columnsReference)));

                    $update = $this->getEntityManager()->getRepository('Manager\Entity\ReferenceType')->findOneBy(array('name' => $constraint->getUpdateRule()));
                    $rules->setIdUpdReferenceType($update);

                    $delete = $this->getEntityManager()->getRepository('Manager\Entity\ReferenceType')->findOneBy(array('name' => $constraint->getDeleteRule()));
                    $rules->setIdDelReferenceType($delete);

                }
                $this->getEntityManager()->persist($rules);
                $this->getEntityManager()->flush();
                //var_dump($rules);
            }
        }

    }

    public function generate()
    {
        /**
            A geração será feita em 3 etapas distintas.
            1 - CRUD
            2 - FIELD
            3 - CONSTRAINT
         */
        $schema = new \Gear\Model\Schema($this->getAdapter());
        $tables = $schema->getTables();

         $em = $this->getEntityManager();
        //echo date('Y-m-d H:i:s');
        $project = new \Manager\Entity\Project();
        $project->setName('Gear2');

        $em->persist($project);
        $em->flush();
        //var_dump($project);

        $module = new \Manager\Entity\Module();
        $module->setIdProject($project);
        $module->setName('Manager2');

        $em->persist($module);
        $em->flush();

        $this->mineTables($tables);
        $this->mineColumns($tables);
        $this->mineConstraints($tables);

    }

    public function getEm()
    {
        return $this->em;
    }

    public function setEm($em)
    {
        $this->em = $em;

        return $this;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject(\Manager\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    public function getModuleType()
    {
        return $this->moduleType;
    }

    public function setModuleType($moduleType)
    {
        $this->moduleType = $moduleType;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
