<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;
use Gear\Hydrator\Strategy\ActionIntoControllerStrategy;

abstract class AbstractHydrator
{

    public function __construct($data = array())
    {
        $input = $this->getInputFilter();
        $input->setData($data);

        if ($input->isValid()) {
            $this->hydrate($data);
        } else {

            throw new \InvalidArgumentException(sprintf('%s', print_r($data, true)));
        }
    }

    abstract function getInputFilter();

    public function extract()
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('actions', new ActionIntoControllerStrategy);
        return $hydrator->extract($this);
    }

    public function hydrate(array $data)
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('actions', new ActionIntoControllerStrategy);
        $hydrator->hydrate($data, $this);
    }
}
