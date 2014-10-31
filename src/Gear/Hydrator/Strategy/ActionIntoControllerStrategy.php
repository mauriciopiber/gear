<?php
namespace Gear\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;

class ActionIntoControllerStrategy extends DefaultStrategy
{
  /**
   * {@inheritdoc}
   */
  public function hydrate($value)
  {

      var_dump($value);
      return $value;
  }

  public function extract($value)
  {

      var_dump($value);

      return $value;

  }
}