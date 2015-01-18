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

class RepositoryService extends AbstractJsonService
{
    protected $columns;

    protected $db;

    protected $template;

    protected $table;

    public function getLocation()
    {
        return $this->getModule()->getSrcModuleFolder().'/Repository';
    }

    public function hasAbstract()
    {
        if (is_file($this->getLocation().'/AbstractRepository.php')) {
            return true;
        } else {
            return false;
        }
   }

   public function getAbstract()
   {
       if (!$this->hasAbstract()) {
           $this->createFileFromTemplate(
               'template/src/repository/abstract.phtml',
               array(
                   'module' => $this->getConfig()->getModule()
               ),
               'AbstractRepository.php',
               $this->getModule()->getRepositoryFolder()
           );

           $this->createFileFromTemplate(
               'template/test/unit/repository/abstract.phtml',
               array(
                   'module' => $this->getConfig()->getModule()
               ),
               'AbstractRepositoryTest.php',
               $this->getModule()->getTestRepositoryFolder()
           );
       }
   }

    public function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

   public function create($src)
   {
       $className = ($this->endsWith($src->getName(), 'Repository')) ? $src->getName() : $src->getName().'Repository';

       $this->getAbstract();

       $this->createFileFromTemplate(
           'template/test/unit/repository/src.repository.phtml',
           array(
               'serviceNameUline' => $this->str('var', $src->getName()),
               'serviceNameClass'   => $className,
               'module'  => $this->getConfig()->getModule()
           ),
           $src->getName().'Test.php',
           $this->getModule()->getTestRepositoryFolder()
       );

       $this->createFileFromTemplate(
           'template/src/repository/src.repository.phtml',
           array(
               'class'   => $src->getName(),
               'module'  => $this->getConfig()->getModule()
           ),
           $src->getName().'.php',
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

   public function introspectFromTable()
   {
       $this->getEventManager()->trigger('getInstance', $this);

       $this->db      = $this->getInstance();
       $this->table   = $this->db->getTableObject();
       $this->columns = $this->table ->getColumns();
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

   public function getMap()
   {
       $mappingService = $this->getServiceLocator()->get('RepositoryService\MappingService');
       $mappingService->setAliaseStack($this->aliasesStack);
       return $mappingService->getRepositoryMapping();
   }


}
