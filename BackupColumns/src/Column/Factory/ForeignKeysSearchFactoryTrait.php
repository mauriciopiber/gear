<?php
namespace Column\Factory;

use Column\Factory\ForeignKeysSearchFactory;

trait ForeignKeysSearchFactoryTrait
{
    protected $foreignKeysSearchFactory;

    public function getForeignKeysSearchFactory()
    {
        if (!isset($this->foreignKeysSearchFactory)) {
            $serviceName = 'Column\Form\Search\ForeignKeysSearchForm';
            $this->foreignKeysSearchFactory = $this->getServiceLocator()->get($serviceName);
        }
        return $this->foreignKeysSearchFactory;
    }

    public function setForeignKeysSearchFactory(ForeignKeysSearchFactory $foreignKeysSearchFactory)
    {
        $this->foreignKeysSearchFactory = $foreignKeysSearchFactory;
        return $this;
    }
}
