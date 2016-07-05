<?php
/**
 *
 * @author piber
 * Um serviço é o ítem mais importante do DDD.
 * Um serviço precisa ser testado com TDD.
 * Um serviço não possui interface então não precisa ser testado com codeception.
 * Um serviço pode extender outro serviço.
 * Um serviço precisa ser adicionado ao invokables do Module.php ao final do processo.
 *
 */
namespace Gear\Mvc\Entity;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Object\TableObject;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Src\SrcServiceTrait;

class EntityService extends AbstractJsonService
{
    use SrcServiceTrait;
    use SchemaServiceTrait;
    use \Gear\Script\ScriptServiceTrait;
    use \Gear\Mvc\Entity\EntityTestServiceTrait;
    use \Gear\Mvc\Config\ServiceManagerTrait;

    protected $doctrineService;

    protected $tableName;

    protected $tableColumns;

    protected $mockColumns;

    public function getMetadata()
    {
        return $this->getServiceLocator()->get('Gear\Factory\Metadata');
    }

    public function create($src)
    {
        $this->src = $src;

        if ($this->src->getDb() !== null && $this->src->getDb()->getTableObject() instanceof TableObject) {
            $this->tableName = $src->getDb()->getTable();
            $this->tableClass = $this->str('class', $this->tableName);
            $this->setUpEntity(array('tables' => $this->tableName));
            $this->getEntityTestService()->create($this->src);
            $this->fixSnifferErrors();
            $this->replaceUserEntity();
            return true;
        }


        throw new \Gear\Exception\InvalidArgumentException('Src for Entity need a valid --db=');

    }

    public function introspectFromTable(\GearJson\Db\Db $dbTable)
    {
        $this->loadTable($dbTable);

        $this->db = $dbTable;
        $this->tableName = $this->db->getTableObject()->getName();

        $this->tableClass = $this->str('class', $this->tableName);


        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();
        $this->excludeEntities();

        $this->fixSnifferErrors();

        $this->replaceUserEntity();


        //aqui na puta que pariu, vo quebrar tudo essa porra.

        $this->getEntityTestService()->introspectFromTable($this->db);

        if ($this->getTableService()->verifyTableAssociation($this->str('class', $dbTable->getTable()))) {
            if (!is_file($this->getModule()->getEntityFolder().'/UploadImage.php')) {
                $uploadImage = $this->getTableService()->getTableObject('upload_image');



                //$this->getTable('upload_image');

/*                 $db = new \GearJson\Db\Db(
                    ['table' => 'UploadImage'***REMOVED***
                ); */

                $src = $this->getSrcService()->create(
                    $this->getModule()->getModuleName(),
                    'UploadImage',
                    'Entity',
                    null,
                    null,
                    null,
                    'invokables',
                    false,
                    'UploadImage'
                );

                $src->getDb()->setTable('UploadImage');
                $src->getDb()->setTableObject($uploadImage);
                $this->create($src);
                $this->getServiceManager()->create($src);
            }
        }
        return true;
    }

    public function replaceUserEntity()
    {
        $entityFolder = $this->getModule()->getEntityFolder();

        foreach (glob($entityFolder.'/*') as $fileName) {
            var_dump($fileName);
            //var_dump($fileName);

            $this->file = file_get_contents($fileName);
            $userNamespace = sprintf('\%s\Entity\User', $this->getModule()->getModuleName());
            $fixNamespace = '\GearAdmin\Entity\User';

            $userName = sprintf('%s\Entity\User', $this->getModule()->getModuleName());
            $fixName  = 'GearAdmin\Entity\User';


            $this->file = str_replace($userNamespace, $fixNamespace, $this->file);
            $this->file = str_replace($userName, $fixName, $this->file);


            $this->replaceCreatedAt();
            $this->replaceCreatedBy();
            $this->replaceUpdatedAt();
            $this->replaceUpdatedBy();

            if (strpos('use \GearBase\Entity\LogTrait;', $this->file) === false) {
                preg_match('/class [a-zA-Z***REMOVED****\n{/', $this->file, $match, PREG_OFFSET_CAPTURE);

                $strToInsert = PHP_EOL.'    use \GearBase\Entity\LogTrait;'.PHP_EOL;

                $this->file = substr($this->file, 0, ($match[0***REMOVED***[1***REMOVED***+strlen($match[0***REMOVED***[0***REMOVED***)))
                  . $strToInsert
                  . substr($this->file, ($match[0***REMOVED***[1***REMOVED***+strlen($match[0***REMOVED***[0***REMOVED***)));
            }

            file_put_contents($fileName, $this->file);
        }
    }

    public function replaceCreatedAt()
    {

        $attribute = <<<EOS

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private \$created;

EOS;

        $attributeNotNull = <<<EOS

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private \$created;

EOS;

        $setter    = <<<EOS

    /**
     * Set created
     *
     * @param \DateTime \$created
     *
     * @return $this->tableClass
     */
    public function setCreated(\$created)
    {
        \$this->created = \$created;

        return \$this;
    }

EOS;
        $getter    = <<<EOS

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return \$this->created;
    }

EOS;

        $this->replace($attributeNotNull, '');
        $this->replace($attribute, '');
        $this->replace($setter, '');
        $this->replace($getter, '');
    }

    public function replaceCreatedBy()
    {
        $attribute = <<<EOS

    /**
     * @var \GearAdmin\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="GearAdmin\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id_user")
     * })
     */
    private \$createdBy;

EOS;
        $setter    = <<<EOS

    /**
     * Set createdBy
     *
     * @param \GearAdmin\Entity\User \$createdBy
     *
     * @return $this->tableClass
     */
    public function setCreatedBy(\GearAdmin\Entity\User \$createdBy = null)
    {
        \$this->createdBy = \$createdBy;

        return \$this;
    }

EOS;
        $getter    = <<<EOS

    /**
     * Get createdBy
     *
     * @return \GearAdmin\Entity\User
     */
    public function getCreatedBy()
    {
        return \$this->createdBy;
    }

EOS;
        $this->replace($attribute, '');
        $this->replace($setter, '');
        $this->replace($getter, '');
    }

    public function replaceUpdatedAt()
    {
        $attribute = <<<EOS

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private \$updated;

EOS;
        $setter    = <<<EOS

    /**
     * Set updated
     *
     * @param \DateTime \$updated
     *
     * @return $this->tableClass
     */
    public function setUpdated(\$updated)
    {
        \$this->updated = \$updated;

        return \$this;
    }

EOS;
        $getter    = <<<EOS

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return \$this->updated;
    }

EOS;

        $this->replace($attribute, '');
        $this->replace($setter, '');
        $this->replace($getter, '');
    }

    public function replaceUpdatedBy()
    {
        $attribute = <<<EOS

    /**
     * @var \GearAdmin\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="GearAdmin\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="id_user")
     * })
     */
    private \$updatedBy;

EOS;
        $setter    = <<<EOS

    /**
     * Set updatedBy
     *
     * @param \GearAdmin\Entity\User \$updatedBy
     *
     * @return $this->tableClass
     */
    public function setUpdatedBy(\GearAdmin\Entity\User \$updatedBy = null)
    {
        \$this->updatedBy = \$updatedBy;

        return \$this;
    }

EOS;
        $getter    = <<<EOS

    /**
     * Get updatedBy
     *
     * @return \GearAdmin\Entity\User
     */
    public function getUpdatedBy()
    {
        return \$this->updatedBy;
    }

EOS;



        $this->replace($attribute, '');
        $this->replace($setter, '');
        $this->replace($getter, '');
    }


    /**
     * Função responsável por limpar o último caractere onde há espaço sobrando
     * e também mudar a exibição da descrição inicial do ORM para multilinhas.
     */
    public function fixSnifferErrors()
    {
        $entityFolder = $this->getModule()->getEntityFolder();

        foreach (glob($entityFolder.'/*') as $fileName) {
            if (!is_file($fileName)) {
                throw new \Exception(sprintf('Entity %s not created succesful, check errors', fileName));
            }

            $this->file = file_get_contents($fileName);

            $handle = fopen($fileName, "r");
            if ($handle) {
                $lineNumber = 0;

                while (($line = fgets($handle)) !== false) {
                    $lineNumber += 1;

                    //pega validação no caso do nome da tabela estar expressa em uma só linha.
                    $pattern = '/ * @ORM\\\\Table/';
                    if (preg_match($pattern, $line, $match) && strlen($line) > 120) {
                        $this->breakDoctrineTableNotation($line, $lineNumber);
                        continue;
                    }


                    //limpa última linha em branco
                    $pattern = '/     \* @return [a-zA-Z\\\***REMOVED****\s$/';
                    if (preg_match($pattern, $line, $match)) {
                        $this->breakEmptyChar($line, $lineNumber);
                        continue;
                    }

                    if (strlen($line) > 120) {
                        //se for declaração de Join Column

                        $pattern = '/    public function [a-zA-Z***REMOVED****/';

                        if (preg_match($pattern, $line, $match)) {
                            $this->breakLongFunctionName($line, $lineNumber);
                            //$this->breakFunctionParenteses($lineNumber+1);
                        }

                        $pattern = '/     \*   @ORM\\\\JoinColumn/';

                        if (preg_match($pattern, $line, $match)) {
                            $this->breakLongORMJoinColumn($line, $lineNumber);
                        }

                        //se fsor declaração de função.
                    }
                }

                fclose($handle);
            } else {
                // error opening the file.
            }


            $this->persistEntity($fileName);
        }


        return true;
    }

    public function breakLongFunctionName($line)
    {

        $pieces = explode('(', $line);

        $method = trim($pieces[0***REMOVED***);

        $shortParts = explode(' ', $pieces[1***REMOVED***);



        $last = trim(str_replace(')', '', $shortParts[3***REMOVED***));

        $functionCall = <<<EOS
    $method(
        {$shortParts[0***REMOVED***} {$shortParts[1***REMOVED***} {$shortParts[2***REMOVED***} {$last}
    ) {
EOS;

        $this->replace($line.'    {', $functionCall);
    }


    public function breakLongORMJoinColumn($line)
    {
        $pieces = explode('"', $line);


        $functionCall = <<<EOS
     *   @ORM\JoinColumn(
     *       name="{$pieces[1***REMOVED***}",
     *       referencedColumnName="{$pieces[3***REMOVED***}"
     *   )
EOS;
        $this->replace($line, $functionCall);
    }

    /**
     * Função responsável por substituir entidade no disco.
     * @param String $fileName
     * @return boolean
     */
    public function persistEntity($fileName)
    {
        return file_put_contents($fileName, $this->file);
    }

    /**
     * Função utilizada pra substituir o texto na memória
     * @param string $toReplace
     * @param string $replace
     * @return boolean
     */
    public function replace($toReplace, $replace)
    {
        $this->file = str_replace($toReplace, $replace, $this->file);
        return true;
    }

    public function breakEmptyChar($line)
    {
        $lineTrim = rtrim($line).PHP_EOL;
        $this->replace($line, $lineTrim);
        return true;
    }

    public function transformNotation($tableName, $indexes)
    {
        $tableIndexes = '';
        foreach ($indexes as $number => $index) {
            if ($number+1 >= count($indexes)) {
                $singleIndex = <<<EOL
 *         $index

EOL;
            } else {
                $singleIndex = <<<EOL
 *         $index,

EOL;
            }

            $tableIndexes .= $singleIndex;
        }


        $notation = <<<EOL
 * @ORM\Table(
 *     name="$tableName",
 *     indexes={
$tableIndexes *     }
 * )
 * @SuppressWarnings(PHPMD)

EOL;

        return $notation;
    }

    public function breakDoctrineTableNotation($line)
    {
        $pattern = '/ * @ORM\\\\Table\(name=[\'"***REMOVED***(\w*)[\'"***REMOVED***/';

        if (!preg_match($pattern, $line, $match)) {
            throw new \Exception('Entity as not created sucessful');
        }

        $tableDirty = array_pop($match);
        $tableDirty = str_replace(' * @ORM\\Table(name="', '', $tableDirty);
        $tableName = str_replace('"', '', $tableDirty);

        $pattern = '/@ORM\\\\Index\(name=[\'"***REMOVED***(\w*)[\'"***REMOVED***, columns={[\'"***REMOVED***(\w*)[\'"***REMOVED***}\)/';

        if (preg_match_all($pattern, $line, $matches)) {
            $indexes = $matches[0***REMOVED***;
            if (count($indexes)>0) {
                $notation = $this->transformNotation($tableName, $indexes);
                $this->replace($line, $notation);
                return true;
            }
        }

        return false;
    }

    public function getDoctrineService()
    {
        if (!isset($this->doctrineService)) {
            $this->doctrineService = $this->getServiceLocator()->get('doctrineService');
        }
        return $this->doctrineService;
    }

    /**
     * @todo Verifica se existe src no json. Se já existe, exibe mensagem e retorna.
     * Se não existe, salva src.
     * Gera a nova entidade.
     * Verifica se é necessário remover as entidades atuais.
     */
    public function createFromTable($table)
    {
        $this->getDoctrineService()->createFromTable($table);
    }

    /**
     * @todo Verifica toda metatada e tenta inserir no src do json. Se já existe, exibe mensagem e retorna.
     * Se não existe, salva src.
     * Gera a nova entidade.
     * Verifica se é necessário remover as entidades atuais.
     */
    public function createFromMetadata()
    {
        $this->getDoctrineService()->createFromMetadata();
    }

    public function getTables()
    {
        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        return $metadata->getTables();
    }

    public function getNames()
    {
        $dbs = $this->getSchemaService()->__extractObject('db');

        $names = [***REMOVED***;

        if (count($dbs) > 0) {
            foreach ($dbs as $table) {
                $names[***REMOVED*** = $table->getTable();
            }
        }

        $srcs = $this->getSchemaService()->__extractObject('src');

        foreach ($srcs as $src) {
            if ($src->getType() == 'Entity') {
                $names[***REMOVED*** = $src->getName();
            }
        }



        return $names;
    }

    public function excludeMapping()
    {
        $ymlFiles = $this->getModule()->getSrcFolder();


        foreach (glob($ymlFiles.'/*') as $v) {
            $entity = explode('/', $v);
            if (end($entity)!==$this->getModule()->getModuleName()) {
                 $this->getDirService()->rmDir($v);
            }
        }
    }

    public function excludeEntities($names = array())
    {
        $names = array_merge($this->getNames(), $names);

        $entitys = $this->getModule()->getEntityFolder();

        foreach (glob($entitys.'/*.php') as $entityFullPath) {
            $entity = explode('/', $entityFullPath);
            $name = explode('.', end($entity));

            if (!in_array($name[0***REMOVED***, $names)) {
                unlink($entityFullPath);
                if (is_file($entityFullPath.'~')) {
                    unlink($entityFullPath.'~');
                }
            } else {
                if (is_file($entityFullPath.'~')) {
                    unlink($entityFullPath.'~');
                }
            }
        }


    }

    /**
     * @deprecated Não existirá mais o comando setUpEntities. Será removido na versão 1.0.0
     *
     * @return boolean
     */
    public function setUpEntities()
    {
        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();

        echo $scriptService->run($doctrineService->getOrmValidateSchema());
        echo $scriptService->run($doctrineService->getOrmConvertMapping());
        echo $scriptService->run($doctrineService->getOrmGenerateEntities());
        echo $scriptService->run($doctrineService->getOrmValidateSchema());

        //criar o mapping
        //criar as entidades
        //criar de todo banco
        //limpar lixo
        return true;
    }

    /**
     * @deprecated Não existirá mais o comando setUpEntity, será removido na versão 1.0.0
     *
     * @param unknown $data
     * @return boolean
     */
    public function setUpEntity($data)
    {

        if (is_string($data['tables'***REMOVED***)) {
            $tables = explode(',', $data['tables'***REMOVED***);
        } elseif (is_array($data['tables'***REMOVED***)) {
            $tables = $data['tables'***REMOVED***;
        }

        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());


        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();

        $this->excludeEntities($tables);
        return true;
    }
}
