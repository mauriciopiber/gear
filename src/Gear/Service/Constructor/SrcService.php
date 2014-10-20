<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

class SrcService extends AbstractJsonService
{

    protected $srcFactory;

    protected $srcValueObject;

    public function setSrcValueObject($srcValueObject)
    {
        $this->srcValueObject = $srcValueObject;

        return $this;
    }

    public function getSrcValueObject()
    {
        if (isset($this->srcValueObject)) {
            return $this->srcValueObject;
        } else {
            return null;
        }
    }

    public function getSrcFactory()
    {
        if (!isset($this->srcFactory)) {
            $this->srcFactory = $this->getServiceLocator()->get('srcFactory');
        }

        return $this->srcFactory;
    }

    public function factory()
    {
        $factory = $this->getSrcFactory();

        return $factory->factory($this->getSrcValueObject());
    }
}
