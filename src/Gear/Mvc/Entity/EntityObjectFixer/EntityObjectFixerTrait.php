<?php
namespace Gear\Mvc\Entity\EntityObjectFixer;

use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerFactory;

trait EntityObjectFixerTrait
{
    protected $entityObjectFixer;

    /**
     * Get Entity Object Fixer
     *
     * @return Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer
     */
    public function getEntityObjectFixer()
    {
        if (!isset($this->entityObjectFixer)) {
            $name = 'Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer';
            $this->entityObjectFixer = $this->getServiceLocator()->get($name);
        }
        return $this->entityObjectFixer;
    }

    /**
     * Set Entity Object Fixer
     *
     * @param EntityObjectFixer $entityObjectFixer Entity Object Fixer
     *
     * @return \Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer
     */
    public function setEntityObjectFixer(
        EntityObjectFixer $entityObjectFixer
    ) {
        $this->entityObjectFixer = $entityObjectFixer;
        return $this;
    }
}
