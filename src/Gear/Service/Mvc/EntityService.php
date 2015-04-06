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
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class EntityService extends AbstractJsonService
{

    use \Gear\Service\Module\ScriptServiceTrait;

    use \Gear\Common\EntityTestServiceTrait;

    protected $doctrineService;

    protected $tableName;

    protected $tableColumns;

    protected $mockColumns;

    public function getMetadata()
    {
        return $this->getServiceLocator()->get('Gear\Factory\Metadata');;
    }

    public function introspectFromTable(\Zend\Db\Metadata\Object\TableObject $dbTable)
    {
        $this->tableName = $dbTable->getName();

        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();
        $this->excludeEntities();
        $this->replaceUserEntity();
        $this->fixSnifferErrors();


        //aqui na puta que pariu, vo quebrar tudo essa porra.

        $this->getEntityTestService()->createUnitTest($this->tableName);

        return true;
    }

    public function replaceUserEntity()
    {
        $entityFolder = $this->getModule()->getEntityFolder();

        foreach (glob($entityFolder.'/*') as $i => $fileName) {

            $fileContents = file_get_contents($fileName);

            $userNamespace = sprintf('\%s\Entity\User', $this->getModule()->getModuleName());
            $fixNamespace = '\Security\Entity\User';

            $userName = sprintf('%s\Entity\User', $this->getModule()->getModuleName());
            $fixName  = 'Security\Entity\User';


            $fileContents = str_replace($userNamespace, $fixNamespace, $fileContents);
            $fileContents = str_replace($userName, $fixName, $fileContents);

            file_put_contents($fileName, $fileContents);
        }
    }


    /**
     * Função responsável por limpar o último caractere onde há espaço sobrando
     * e também mudar a exibição da descrição inicial do ORM para multilinhas.
     */
    public function fixSnifferErrors()
    {
        $entityFolder = $this->getModule()->getEntityFolder();

        foreach (glob($entityFolder.'/*') as $i => $fileName) {

            if (!is_file($fileName)) {
                throw new \Exception(sprintf('Entity %s not created succesful, check errors', $entityName));
            }

            $this->file = file_get_contents($fileName);

            $handle = fopen($fileName, "r");
            if ($handle) {

                $lineNumber = 0;

                while (($line = fgets($handle)) !== false) {

                    $lineNumber += 1;

                    $pattern = '/ * @ORM\\\\Table/';

                    if (preg_match($pattern, $line, $match) && strlen($line) > 120) {
                        $this->breakDoctrineTableNotation($line, $lineNumber);
                    }


                    $pattern = '/     \* @return [a-zA-Z\\\***REMOVED****\s$/';
                    if (preg_match($pattern, $line, $match)) {
                        $this->breakEmptyChar($line, $lineNumber);
                    }
                }

                fclose($handle);
            } else {
                // error opening the file.
            }


            file_put_contents($fileName, $this->file);
        }


        return true;
    }

    public function breakEmptyChar($line, $lineNumber)
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

EOL;

        return $notation;
    }

    public function breakDoctrineTableNotation($line, $lineNumber)
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

    public function replace($toReplace, $replace)
    {
        $this->file = str_replace($toReplace, $replace, $this->file);
        return true;
    }





    public function create($src)
    {
        $class = $src->getName();
        $this->tableName = $src->getDb()->getTable();
        $this->setUpEntity(array('tables' => $this->tableName));
        $this->getEntityTestService()->createUnitTest($this->tableName);
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
        $dbs = $this->getGearSchema()->__extractObject('db');

        $names = [***REMOVED***;

        if (count($dbs) > 0) {
            foreach ($dbs as $table) {
                $names[***REMOVED*** = $table->getTable();
            }
        }

        $srcs = $this->getGearSchema()->__extractObject('src');

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


        foreach (glob($ymlFiles.'/*') as $i => $v) {

            $entity = explode('/',$v);
            if (end($entity)!==$this->getConfig()->getModule()) {
                 $this->getDirService()->rmDir($v);
            }

        }
    }

    public function excludeEntities($names = array())
    {
        $names = array_merge($this->getNames(), $names);

        $entitys = $this->getModule()->getEntityFolder();

        foreach (glob($entitys.'/*.php') as $i => $entityFullPath) {

            $entity = explode('/',$entityFullPath);
            $name = explode('.',end($entity));

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


    public function setUpEntities($data)
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
