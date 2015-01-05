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
    protected $entityTestService;

    protected $doctrineService;

    public function getDoctrineService()
    {
        if (!isset($this->doctrineService)) {
            $this->doctrineService = $this->getServiceLocator()->get('doctrineService');
        }
        return $this->doctrineService;
    }

    public function getEntityTestService()
    {
        return $this->entityTestService;
    }

    public function setEntityTestService($entityTestService)
    {
        $this->entityTestService = $entityTestService;
        return $this;
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

    public function create($src)
    {
        $class = $src->getName();



        $table = $src->getDb();


        $this->setUpEntity(array('tables' => $table));

        $metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');


        $columns = $metadata->getColumns($this->str('uline', $table));

        $assertNull = [***REMOVED***;

        foreach ($columns as $column) {
            $assertNull[***REMOVED*** = sprintf('$this->assertNull($entity->get%s());', $this->str('class', $column->getName()));
        }

        //$excludeList = \Gear\ValueObject\Db::excludeList();


        //var_dump($columns);

        //assert get return null.

        $this->createFileFromTemplate(
            'template/test/unit/entity/src.entity.phtml',
            array(
                'serviceNameUline' => $this->str('var', $class),
                'serviceNameClass'   => $class,
                'module'  => $this->getConfig()->getModule(),
                'assertNull' => $assertNull
            ),
            $class.'Test.php',
            $this->getModule()->getTestEntityFolder()
        );
        /*



        //change driver to accept just from doctrine generate entities.

        $this->createFileFromTemplate(
            'template/src/entity/src.entity.phtml',
            array(
                'class'   => $class,
                'module'  => $this->getConfig()->getModule()
            ),
            $class.'.php',
            $this->getModule()->getEntityFolder()
        );*/
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
                unlink($entityFullPath.'~');
            }

        }


    }

    public function introspectFromTable(\Zend\Db\Metadata\Object\TableObject $dbTable)
    {
        $doctrineService = $this->getDoctrineService();

        $scriptService = $this->getScriptService();
        $scriptService->run($doctrineService->getOrmConvertMapping());
        $scriptService->run($doctrineService->getOrmGenerateEntities());

        $this->excludeMapping();
        $this->excludeEntities();

        return true;
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
