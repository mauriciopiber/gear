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


   public function introspectFromTable($db)
   {
       $table = $db->getTableObject();

       $this->getAbstract();

       $columns = $table->getColumns();

       $attributes = [***REMOVED***;

       foreach ($columns as $column) {

           if ($db->isPrimaryKey($column)) {
               continue;
           }

           if ($db->isForeignKey($column)) {
               $value = sprintf(
                   PHP_EOL.'            '.
                   '$this->getEntityManager()->getRepository(\'%s\\Entity\\%s\')->findOneBy(array())'.
                   PHP_EOL.'        ',
                   $this->getConfig()->getModule(),
                   $this->str('class', $db->getForeignKeyReferencedTable($column))
               );
           } elseif ($column->getDataType() == 'datetime') {
               $value = 'new \DateTime(\'now\')';
           } elseif ($column->isNullable()) {
               $value = 'null';
           } elseif ($column->getName() == 'id_lixeira') {
               $value = '0';
           }
           else {
               $value = '\'\'';
           }


           $attributes[***REMOVED*** = array(
               'set' => $this->str('class', $column->getName()),
               'value' => $value
           );
       }


       $attribute = $this->getTemplateService()->render('template/src/repository/entityAttributes.phtml', array('columns' => $attributes));

       $specialityField = $this->getGearSchema()->getSpecialityArray($db);

       if (in_array('metaimagem', $specialityField)) {
           $template = 'template/src/repository/metaimagem.repository.phtml';
       } else {
           $template = 'template/src/repository/db.repository.phtml';
       }



       $this->createFileFromTemplate(
           $template,
           array(
               'specialityFields' => $specialityField,
               'baseClass' => $this->str('class', $table->getName()),
               'attribute' => $attribute,
               'class'   => $this->str('class', $table->getName()),
               'module'  => $this->getConfig()->getModule()
           ),
           $this->str('class', $table->getName()).'Repository.php',
           $this->getModule()->getRepositoryFolder()
       );
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

}
