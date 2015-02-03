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

use Gear\ValueObject\Src;

class RepositoryService extends AbstractMvcService
{
    use \Gear\Common\RepositoryTestServiceTrait;

    protected $columns;

    protected $db;

    protected $template;

    protected $table;

    protected $customAbstract = false;

    public function hasAbstract()
    {
        if (is_file($this->getModule()->getRepositoryFolder().'/AbstractRepository.php')) {
            return true;
        } else {
            return false;
        }
    }

    public function getAbstract()
    {
        if (false == $this->customAbstract) {

            $this->classNameAbstract = 'AbstractRepository';
        }

        if (!$this->hasAbstract()) {

            $this->getRepositoryTestService()->createAbstract();

            $this->createFileFromTemplate(
                'template/src/repository/abstract.phtml',
                array(
                    'module' => $this->getConfig()->getModule(),
                    'className' => $this->classNameAbstract
                ),
                $this->classNameAbstract.'.php',
                $this->getModule()->getRepositoryFolder()
            );
        }
    }

    public function getAbstractFromSrc()
    {

        $this->getRepositoryTestService()->createAbstract();

        return $this->createFileFromTemplate(
            'template/src/repository/abstract.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'className' => $this->className
            ),
            $this->className.'.php',
            $this->getModule()->getRepositoryFolder()
        );
    }

    public function create(Src $src)
    {
       $this->src = $src;
       $this->className = $src->getName();

       if ($this->src->getAbstract() === true) {
           return $this->getAbstractFromSrc();
       }

       if (null != $this->src->getDb() && $this->src->getDb() instanceof \Gear\ValueObject\Db) {

           $this->db =  $src->getDb();
           $this->db->setColumns(\Zend\Json\Json::decode($db->getColumns()));
           $this->populateTableObject();

           $this->getEventManager()->trigger('createInstance', $this, array('instance' => $this->db));
           return $this->introspectFromTable();
       }



       return $this->createSingleSrc();
    }

    public function createSingleSrc()
    {
        $this->getAbstract();
        $this->getRepositoryTestService()->createFromSrc($this->src);

        return $this->createFileFromTemplate(
            'template/src/repository/src.repository.phtml',
            array(
                'class'   => $this->className,
                'module'  => $this->getConfig()->getModule()
            ),
            $this->className.'.php',
            $this->getModule()->getRepositoryFolder()
        );
    }

    public function introspectFromTable()
    {
        $this->getEventManager()->trigger('getInstance', $this);

        $this->db = $this->getInstance();
        $this->className = $this->db->getTable();


        $this->getRepositoryTestService()->introspectFromTable($this->getInstance());

        $this->db      = $this->getInstance();
        $this->table   = $this->db->getTableObject();
        $this->columns = $this->table->getColumns();
        $this->specialites = $this->getGearSchema()->getSpecialityArray($this->db);

        $this->useImageService();
        $this->calculateAliasesStack();
        $this->getAbstract();

        $this->createFileFromTemplate(
            $this->template,
            array(
                'specialityFields' => $this->specialites,
                'baseClass' => $this->str('class', $this->table->getName()),
                'baseClassCut' => $this->cut($this->str('class', $this->table->getName())),
                'class'   => $this->str('class', $this->table->getName()),
                'module'  => $this->getConfig()->getModule(),
                'aliase'  => $this->mainAliase,
                'map' => $this->getMap()
            ),
            $this->str('class', $this->table->getName()).'Repository.php',
            $this->getModule()->getRepositoryFolder()
        );
    }


   public function useImageService()
   {
       if (in_array('uploadimagem', $this->specialites)) {
           $this->template = 'template/src/repository/metaimagem.repository.phtml';
       } else {
           $this->template = 'template/src/repository/db.repository.phtml';
       }
   }

   public function calculateAliasesStack()
   {
       $this->aliasesStack = [***REMOVED***;

       $callable = function($a, $b) {
           return $a. substr($b, 0, 1);
       };

       $this->mainAliase = array_reduce(explode('_', $this->table->getName()), $callable);

       if (!in_array($this->mainAliase, $this->aliasesStack)) {
           $this->aliasesStack[***REMOVED*** = $this->mainAliase;
       }
   }

   public function getMap()
   {
       $mappingService = $this->getServiceLocator()->get('RepositoryService\MappingService');
       $mappingService->setAliaseStack($this->aliasesStack);
       return $mappingService->getRepositoryMapping();
   }


}
