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
       }
   }

   public function create($src)
   {

       $this->getAbstract();

       $this->createFileFromTemplate(
           'template/test/unit/repository/src.repository.phtml',
           array(
               'serviceNameUline' => $this->str('var', $src->getName()),
               'serviceNameClass'   => $src->getName(),
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

}
